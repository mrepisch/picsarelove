<?php
require_once 'view/View.php';
require_once 'lib/Validator.php';
require_once 'model/UserModel.php';
require_once 'lib/session.php';

/**
 * Diese Klasse stellt den Controller für alles was mit dem Login zu tun hat dar.
 * Sprich wen sich ein Benutzer einlogen, ausloggen oder neu regisitieren will.
 * @author Sascha Blank
 *
 */

class LoginController{
	
	/**
	 * Diese Methode ist für das Login des Benutzers zuständig. 
	 * Im Falle eines Fehlers wird wieder auf die index.php umgeleitet.
	 */
	function login(){
		//Parameter holen
		$email = $_POST["email"];
		$passwd = $_POST["passwd"];
		$email = htmlspecialchars($email);
		$userModel = new UserModel();
		//Record aus der DB für den Benutzer holen
		$result = $userModel->getByWhere("username", $email);
		if(! empty($result)){
			if( $result[0]->userName == $email ) {
				
				// Hasehs vergleichen
				if( password_verify($passwd, $result[0]->password) ) {

					$session = new SessionManager();
					$session->sessionLoad();
					$session->userId = $result[0]->userID;
					$session->username = $result[0]->userName;
					$session->isLogdin = "true";
					header("Location:index.php");
				}
				else {
					// Falls Passwort falsch
					header("Location:index.php?loginerror=Falsches Login");
					
				}
			}
			else{
				//Falls username falsch
			header("Location:index.php&loginerror=Falsches Login");
			}
		}
		else {
			// Falls keine Daten vorhanden
			header("Location:index.php&loginerror=Falsches Login");
		}
	}

	
	/**
	 * Diese Funktion ist für das registrieren einen neuen Benutzers zuständig.
	 */
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
		if( $counter == 0) {
			//Prüefe ob email valird
			if( Validator::isEmail($email ) == false ) {
				header("Location:index.php?cont=Login&action=register_form&error=Email nicht valid");
			}
			//Prüfe ob beide Passwörter gleich sind
			else if( Validator::validatePassword($passwd1, $passwd2) == false ) {
				header("Location:index.php?cont=Login&action=register_form&error=Passwörter nicht gleich");
			}
			else {
				//Schreibe neuen Benutzer in die DB
				$userModel->registerNewUser($email, $passwd1);
				header("Location:index.php?cont=Login&action=register_form&error=Registrierung Erfolgreich");
			}
		}
		else {
			//Falls der Benutzer schon vorhanden ist.
			
			header("Location:index.php?cont=Login&action=register_form&error=Benutzer existiert schon");
			
		}
		
	}
	
	/**
	 * Diese Funktion ist für das ausloggen des Benutzers zuständig.
	 * Sie gibt dem Session object die Anweissung die Session zu zerstören.
	 * Danach wird auf die index.php weitergeleitet
	 */
	function logout(){
		$session = new SessionManager();
		$session->sessionLoad();
		$session->killSession();
		header("Location:index.php");
	}
	
	/**
	 * Diese Funktion zeigt den View mit dem Registrirungsformular an.
	 * Falls Fehler im GET request vorhanden sind werden diese auch angezeigt.
	 */
	function register_form() {
		$session = new SessionManager();
		$session->sessionLoad();
		$registerError = "";
		if( isset($_GET["error"])){
			$registerError = $_GET["error"];
		}
		$view = new View("view/register.php");
		$view->register_error = $registerError;
		$view->isLogdin = $session->getIsLogdin();
		$view->userName = $session->username;
		$view->display();
	}
	
	

}