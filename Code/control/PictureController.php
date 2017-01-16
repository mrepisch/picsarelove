<?php

require_once 'view/View.php';
require_once 'model/PictureModel.php';
require_once 'lib/session.php';
require_once 'lib/Validator.php';
require_once 'model/CategoryModel.php';
class PictureController {
	
	private function setSessionVarsToView($view) {
		$session = new SessionManager();
		$session->sessionLoad();
		$view->isLogdin = $session->getIsLogdin();
		$view->userName = $session->username;
	}
	
	function upload() {
		$targetdir = 'pictures/';
		$newFileName = $targetdir . uniqid() .".". pathinfo($_FILES['picture']['name'],PATHINFO_EXTENSION);
		$targetfile = $_FILES['picture']['name'] = $newFileName;
		echo $newFileName;
		if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetfile)) {
		} else {
		}
		$session = new SessionManager();
		$session->sessionLoad();
		$title = $_POST["title"];
		$categoryID = $_POST["category"];
		$userID = $session->userId;
		
		if(Validator::validateCategory($categoryID)) {
			$pictureModel = new PictureModel();
			$pictureModel->createNewEntry($title, $targetfile, $categoryID, $userID);
			header("Location:index.php?cont=Picture&action=show");
		} else {
			header("Location:index.php?cont=Picture&action=displayForm&noCat=true");
		}

	}
	
	function displayForm() {
		$session = new SessionManager();
		$session->sessionLoad();
		$categorys = new CategoryModel();
		$rows = $categorys->readAll();
		$view = new View("view/uploadPic.php");
		$view->rows = $rows;
		$view->isLogdin = $session->getIsLogdin();
		$view->userName = $session->username;
		$view->display();
	}
	
	function show() {
		$picID = 1;
		if( isset($_GET["picID"])) {
			$picID = $_GET["picID"];
		}
		$category = -1;
		if( isset( $_GET["category"] ) ) {
			$category = $_GET["category"];
		}
		
		$pictureModel = new PictureModel();
		if( $picID == 1 && $category == -1 ) {
			$row = $pictureModel->readAll(1);
			if( !empty($row)){
				$row = $row[0];
				$picID = $row->picID;
			}
		}
		else {
			$row = $pictureModel->getByPrimaryKey($picID, "*");
		}
		if( $picID == "random" ){
			$row = $pictureModel->readAll();
			$randomInt = rand(0, count($row) - 1);
			
			$row = $row[$randomInt];
			$picID = $row->picID;

		}
		if( $category == -1){
			$nextPic = $pictureModel->getNextPicture( $picID );
			$lastPic = $pictureModel->getLastPicture( $picID );
			
			$contentView = new View("view/main_content.php");
			$this->setSessionVarsToView($contentView);
			$contentView->data = $row;
			$contentView->categoryID = $category;
			$contentView->last = $lastPic;
			$contentView->next = $nextPic;
			if( !empty($row)){
				$contentView->display();
			}
			else{
				$contentView->display(true,false);
			}
		}
		else {
			$index = 0;
			$counter = 0;
			$rows = $pictureModel->getByCategory($category);
			$contentView = new View("view/main_content.php");
			$this->setSessionVarsToView($contentView);
			if( !empty($rows)){
				

				$contentView->categoryID = $category;
				echo $picID. " PICTUREID";
				if( $picID == 1){
					//echo"SHIT";
					$contentView->data = $rows[0];
				}
				else {

					foreach( $rows as $row){
						if( $row->picID == $picID ){
							$contentView->data = $row;
							$index = $counter;
						}
						$counter ++;
					}
				}

				$rowCount = count($rows);
				echo $rowCount;
				if( $index == 0){
					$contentView->last = $rows[$rowCount - 1];
				}
				else{
					$contentView->last = $rows[$index - 1];
				}
				if( $index >= $rowCount - 1){
					$contentView->next = $rows[0];
				}
				else{
					$contentView->next = $rows[$index + 1];	
				}
				$contentView->categoryID = $category;	
				$contentView->display();
			}
			else {
				$contentView->display(true,false);
			}
		}
		
	}
	
	
	
	
}
  