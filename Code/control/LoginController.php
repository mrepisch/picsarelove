<?php
require_once 'view/View.php';
require_once 'lib/Validator.php';
require_once 'model/UserModel.php';
class LoginController{
	
	function login(){
		$email = $_POST["email"];
		$passwd = $_POST["passwd"];
		$userModel = new UserModel();
		$userModel->getByWhere("email", $email) ;
		
		
	}
	
	function register(){
		$email = $_POST["email"];
		$passwd1 = $_POST["passwd"];
		$passwd2 = $_POST["passwdrep"];
		$validator = new Validator();
		if( Validator::isEmail($email ) == false ) {
			// TODO:ERROR HANDLING
		}
		else if( Validator::validatePassword($passwd1, $passwd2) == false ) {
			//TODO: ERROR HANDLING
		}
		else {
			$userModel = new UserModel();
			$userModel->registerNewUser($email, $passwd1);
			header("Location:index.php");
		}
		
		
	}
	
	function logout(){
		
		
	}
	
	function register_form()
	{
		$view = new View("view/register.php");
		$view->display();
	}
}