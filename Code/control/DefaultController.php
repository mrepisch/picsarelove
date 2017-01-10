<?php
require_once 'view/View.php';
require_once 'lib/session.php';
class DefaultControler{
	
	function run() {
		
		$session = new SessionManager();
		$session->sessionLoad();
		$view = new View("view/main_content.php");
		$view->isLogdin = $session->getIsLogdin();
		$view->userName = $session->username;
		


		$view->display();

	}
}