<?php

require_once 'lib/session.php';
require_once 'view/View.php';
require_once 'control/PictureController.php';
require_once 'model/UserModel.php';

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
	
	function changePW() {
		$session = new SessionManager();
		$session->sessionLoad();
		$userModel = new UserModel();
		$userID = $session->userId;
		$passwd1 = $_POST["oldpasswd"];
		$passwd2 = $_POST["passwd"];
		$passwd3 = $_POST["passwdrep"];
		
		$result = $userModel->getByWhere("userID", $userID);
		if(! empty($result)){
			if( $result[0]->userID == $userID ) {
				// Hasehs vergleichen
				if( password_verify($passwd1, $result[0]->password) ) {
					//Prüfe ob beide Passwörter gleich sind
					if( Validator::validatePassword($passwd2, $passwd3) == false ) {
						//TODO: ERROR HANDLING
					} else {
						//Schreibe neuen Benutzer in die DB
						$userModel->changePassword($userID, $passwd2);
						header("Location:index.php?cont=User&action=showOptions");
					}
				} else {
					// Falls Passwort falsch
					header("Location:index.php");
				}
			}
			else{
				//Falls username falsch
				header("Location:index.php");
			}
		}
		else {
			// Falls keine Daten vorhanden
			header("Location:index.php");
		}
	}
	
}