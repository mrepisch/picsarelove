<?php

require_once 'lib/session.php';
require_once 'view/View.php';
require_once 'control/PictureController.php';

class UserController {
	
	private function setSessionVarsToView($p_view, $p_session) {
		$p_view->isLogdin = $p_session->getIsLogdin();
		$p_view->userName = $p_session->username;
	}
	
	function showOptions() {
		$session = new SessionManager();
		$session->sessionLoad();
		$userID = $session->userId;
		$pictureModel = new PictureModel();
		$rows = $pictureModel->getByWhere("f_userID", $userID);
		
		$userView = new View("view/editUser.php");
		$this->setSessionVarsToView($userView, $session);
		$userView->data = $rows;
		
		$userView->display();
	}
	
	function reset() {
		
	}
}