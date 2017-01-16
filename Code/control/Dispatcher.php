<?php

/**
 * Diese Klasse stellt den Dispatcher der Webseite dar.
 * Die Aufgabe des Dispatchers ist die folgende:
 * Als erstes muss bestimmt werden ob es sich um ein POST oder GET Request handelt.
 * Dann muss der richtige Controller geladen werden. 
 * Zuletzt muss die ensprechende Funktion im Controller aufgerufen werden.
 * Request müssen folgende Parameter beinhalten:
 * cont=controllername z.b Login
 * action=functionname z.b register
 * @author bblans
 *
 */

class Dispatcher{
	
	/**
	 * Standart Aufruf ohne Request Parameter
	 */
	function loadDefault() {
		require_once "control/PictureController.php";
		$cont = new PictureController();
		$cont->show();
	}
	
	/**
	 * Dies ist die Dispatch Funktion in die jeder Request geleitet wird.
	 * Diese Funktion instanziert den Controller und ruft die ensprechende Funktion des Controllers auf.
	 */
	function dispatch(){
		$controller = "";
		$action = "";
		/**
		 * Prüefe ob POST oder GET Request.
		 * Hole die Parameter für Controller und dessen Funktion
		 */
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
		// Falls kein Controller Parameter mitgegeben wurde, Standart laden.
		if( empty($controller)) {
			$this->loadDefault();
		}
		else{
			//Controller instanzieren und ensprechende Funktion aufrufen.
			$fullControllerName = ucfirst( $controller ) . "Controller";
				require_once "control/$fullControllerName.php";
					$controllerObject = new $fullControllerName();
						$controllerObject->$action();
		}
	}
	

}