<?php
/**
 * Diese Klasse wird verwendet um Benutzereigaben zu validieren.
 * Diese Klasse besteht nur aus statischen Funktionen so das keine Instanz dieser Klasse erzeugt werden muss.
 * @author Sascha Blank
 */

class Validator {
	
	/**
	 * Prüft ob es sich beim übergebenen String um eine E-Mail Adresse handelt.
	 * @param string $p_string, die vermeindliche E-Mail Adresse
	 * @return true falls email anderenfalls false
	 */
	static function isEmail($p_string) {
		if( !filter_var($p_string, FILTER_VALIDATE_EMAIL) ) {
			return false;
		}
		return true;
	}
	
	/**
	 * Diese Funktion überprüft ob der übergebene Wert eine Zahl ist.
	 * @param unknown_type $p_string, der zu validierende Wert
	 * @return true falls Zahl anderenfalls false
	 */
	static function isNumber($p_string) {
		if( !filter_var($p_string, FILTER_VALIDATE_INT) ){
			return false; 
		}
		return true;
	}
	
	/**
	 * Diese Funktion prüft ob die beiden Passwort Strings identisch sind oder nicht.
	 * @param unknown_type $p_passwd, das erste Password
	 * @param unknown_type $p_confirmPasswd, das zweite Passwort
	 * @return true wenn beide Passwörter identisch sind anderenfalls false.
	 */
	static function validatePassword($p_passwd,$p_confirmPasswd) {
		if( !strlen($p_passwd) >= 8) {
			return false;
		}
		if( $p_passwd != $p_confirmPasswd){
			return false;
		}
		return true;
	}
	
	/**
	 * Diese Methode überprüft ob der übergebene Wert den Wert 0 hat.
	 * @param unknown_type $p_categoryID, der zu prüfende Wert
	 * @return true wen der Wert des Wertes 0 ist oder anderefalls false.
	 */
	static function isFieldNotZero($p_field) {
		if($p_field != 0){
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Diese Funktion prüft ob der String leer ist oder nicht.
	 * @param string $p_string, der zu prüfende String
	 * @return true falls string leer ist false anderenfalls.
	 */
	static function isStringEmpty($p_string){
		return strlen($p_string) > 0 ? false : true; 
	}
	
	static function validatePostRequest(){
		$foundSomthing = false;
		foreach ($_POST as $key => $value){
			$foundSomthing = Validator::validateVsHackyStuff($value);
			if( $foundSomthing ){
				return true;
			}
		}
		return $foundSomthing;
	}
	
	static function validateGetRequest(){
		$foundSomthing = false;
		foreach ($_POST as $key => $value){
			$foundSomthing = Validator::validateVsHackyStuff($value);
			if( $foundSomthing ){
				return true;
			}
		}
		return $foundSomthing;
	}
	
	static function validateVsHackyStuff($p_field){
		if( strpos($p_field, "<script>") != 0 
			|| strpos($p_field, "</script>") != 0 
			|| strpos($p_field, "{") != 0 
			|| strpos($p_field, "}") != 0 ){
			return true;	
		}
		if( strpos($p_field, "or 1=1") != 0 
			|| strpos($p_field, "OR 1=1") != 0
			|| strpos($p_field,"DROP TABLE") != 0
			|| strpos($p_field,"drop table") != 0
			|| strpos($p_field,"select * from user") != 0
			|| strpos($p_field,"SELECT * FROM user") != 0
			|| strpos($p_field,"SELECT passwd FROM user") != 0 
			|| strpos($p_field,"select passwd from user") != 0 ) {
			return true;
		}
		return false;
	}
	
	
}