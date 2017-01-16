<?php

class Validator {
	
	static function isEmail($p_string) {
		if( !filter_var($p_string, FILTER_VALIDATE_EMAIL) ) {
			return false;
		}
		return true;
	}
	
	static function isNumber($p_string) {
		if( !filter_var($p_string, FILTER_VALIDATE_INT) ){
			return false; 
		}
		return true;
	}
	
	static function validatePassword($p_passwd,$p_confirmPasswd) {
		if( !strlen($p_passwd) >= 8) {
			return false;
		}
		if( $p_passwd != $p_confirmPasswd){
			return false;
		}
		return true;
	}
	
	static function validateCategory($p_categoryID) {
		if($p_categoryID != 0){
			return true;
		} else {
			return false;
		}
	}
}