<?php

require_once 'view/View.php';
require_once 'model/PictureModel.php';
require_once 'lib/session.php';
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
		
		$pictureModel = new PictureModel();
		$pictureModel->createNewEntry($title, $targetfile, $categoryID, $userID);
		header("Location:index.php?page=1");
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
		$page = 1;
		if( isset( $_GET["page"])) {
			$page = $_GET["page"];
		}
		$picID = 1;
		if( isset($_GET["picID"])) {
			$picID = $_GET["picID"];
		}
		$category = -1;
		if( isset( $_GET["category"] ) ) {
			$category = $_GET["category"];
		}
		
		$pictureModel = new PictureModel();
		if( $picID == 1) {
			$row = $pictureModel->readAll(1);
			$row = $row[0];
			$picID = $row->picID;
		}
		else {
			$row = $pictureModel->getByPrimaryKey($picID, "*");
		}
		
		$nextPic = $pictureModel->getNextPicture( $picID );
		$lastPic = $pictureModel->getLastPicture( $picID );
		
		$contentView = new View("view/main_content.php");
		$this->setSessionVarsToView($contentView);
		$contentView->data = $row;
		$contentView->last = $lastPic;
		$contentView->next = $nextPic;
		$contentView->display();
	}
	
	
	
	
}
  