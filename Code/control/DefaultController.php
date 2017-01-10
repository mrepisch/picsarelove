<?php
require_once 'view/View.php';
class DefaultControler{
	
	function run() {
		
		$view = new View("view/main_content.php");
		$view->display();
	}
}