<?php

require_once 'view/View.php';
require_once 'model/PictureModel.php';
class PictureController {
	
	function upload() {
		$title = $_POST["title"];
		$image = $_POST["image"];
		$categoryID = $_POST["category"];
		$userID = 1;
		
		$pictureModel = new PictureModel();
		$pictureModel->createNewEntry($title, $image, $categoryID, $userID);
	}
	
	function displayForm() {
		$view = new View("view/uploadPic.php");
		$view->display();
	}
	
	
	
}
  