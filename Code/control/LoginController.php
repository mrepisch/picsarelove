<?php
require_once 'view/View.php';
require_once 'lib/Validator.php';
require_once 'model/UserModel.php';
require_once 'lib/session.php';

class LoginController{
	
	function login(){
		$email = $_POST["email"];
		$passwd = $_POST["passwd"];
		$email = htmlspecialchars($email);
		$userModel = new UserModel();
		$result = $userModel->getByWhere("username", $email);
		if( $result[0]->userName == $email ) {
			if( password_verify($passwd, $result[0]->password) ) {
				$session = new SessionManager();
				$session->sessionLoad();
				$session->userId = $result[0]->userID;
				$session->username = $result[0]->userName;
				$session->isLogdin = "true";
				header("Location:index.php");
				
			}
		}
		
		
		
	}
	
	function register(){
		$email = $_POST["email"];
		$passwd1 = $_POST["passwd"];
		$passwd2 = $_POST["passwdrep"];
		$validator = new Validator();
		$userModel = new UserModel();
		$counter = 0;
		$result = $userModel->getByWhere("username", $email);
		foreach( $result as $row) {
			$counter ++;
		}
		if( $counter == 0)
		{
			if( Validator::isEmail($email ) == false ) {
				// TODO:ERROR HANDLING
			}
			else if( Validator::validatePassword($passwd1, $passwd2) == false ) {
				//TODO: ERROR HANDLING
			}
			else {

				$userModel->registerNewUser($email, $passwd1);
				header("Location:index.php");
			}
		}
		else {
			echo "benutzer existiert schon";
		}
		
	}
	
	function logout(){
		$session = new SessionManager();
		$session->sessionLoad();
		$session->killSession();
		header("Location:index.php");
	}
	
	function register_form()
	{
		$session = new SessionManager();
		$session->sessionLoad();
		$view = new View("view/register.php");
		$view->isLogdin = $session->getIsLogdin();
		$view->userName = $session->username;
		$view->display();
	}
}