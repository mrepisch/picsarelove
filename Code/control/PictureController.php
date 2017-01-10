<?php

require_once 'view/View.php';
require_once 'model/PictureModel.php';
class PictureController {
	
	function upload() {
		$targetdir = 'pictures/';
		$targetfile = $targetdir.$_FILES['picture']['name'];
		
		if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetfile)) {
		} else {
		}
		
		$title = $_POST["title"];
		$categoryID = $_POST["category"];
		$userID = 1;
		
		$pictureModel = new PictureModel();
		$pictureModel->createNewEntry($title, $targetfile, $categoryID, $userID);
		header("Location:index.php");
	}
	
	function displayForm() {
		$view = new View("view/uploadPic.php");
		$view->display();
	}
	
	
	
}
  