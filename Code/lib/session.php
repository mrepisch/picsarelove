<?php
class SessionManager{
	
	function sessionLoad() {
		if( session_status() == PHP_SESSION_NONE ) {
			session_start();
		}
	}
	
	function killSession(){
		session_unset(); 
		session_destroy(); 
	}
	
	function __set($p_key, $p_value) {
		echo "Test";
		$_SESSION[$p_key] = $p_value;
	}
	
	function __get($p_key){
		if( isset( $_SESSION[$p_key] ) ) {
			return $_SESSION[$p_key];
		}
		return "";
	}
}