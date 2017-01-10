<?php

require_once 'view/View.php';
class PictureController {
	
	function upload() {
		
	}
	
	function displayForm() {
		$view = new View("view/uploadPic.php");
		$view->display();
	}
	
}
