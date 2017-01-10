<?php
require_once 'view/View.php';;

class LoginController{
	
	function login(){
		
	}
	
	function register(){
		
	}
	
	function logout(){
		
		
	}
	
	function register_form()
	{
		$view = new View("view/register.php");
		$view->display();
	}
}