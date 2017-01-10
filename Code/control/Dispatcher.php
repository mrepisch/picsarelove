<?php
class Dispatcher{
	function loadDefault() {
		require_once "control/DefaultController.php";
		$cont = new DefaultControler();
		$cont->run();
	}
	
	function dispatch(){
		$controller = "";
		$action = "";
		if( $_SERVER['REQUEST_METHOD'] === "POST" ) {
			if( isset($_POST["cont"])) {
				$controller = $_POST["cont"];
			}
			if( isset($_POST["action"] ) ) {
				$action = $_POST["action"];
			}
		}
		else if( $_SERVER['REQUEST_METHOD'] === "GET"){
			if( isset($_GET["cont"])) {
				$controller = $_GET["cont"];
			}
			if( isset($_GET["action"] ) ) {
				$action = $_GET["action"];
			}
		}
		if( empty($controller)) {
			$this->loadDefault();
		}
		else{
		$fullControllerName = ucfirst( $controller ) . "Controller";
			if( file_exists($fullControllerName ) ){
				require_once "control/$fullControllerName.php";
				if( class_exists($fullControllerName)) {
					$controllerObject = new $fullControllerName();
					if( function_exists($action)) {
						$controllerObject->$action();
					}
					else{
						$this->loadDefault();
					}
				}
				else {
					$this->loadDefault();
				}
			}
			else {
				$this->loadDefault();
			}
		}
	}
	

}