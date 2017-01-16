<?php

require_once 'view/View.php';
require_once 'model/PictureModel.php';
require_once 'lib/session.php';
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
		$view = new View("view/uploadPic.php");
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
		
		$pictureModel = new PictureModel();
		$row = $pictureModel->getByPrimaryKey($picID, "*");
		$contentView = new View("view/main_content.php");
		$this->setSessionVarsToView($contentView);
		$contentView->data = $row;
		$pictureModel->showRandom();
		$contentView->display();
		
	}
	
	
	
	
}
  