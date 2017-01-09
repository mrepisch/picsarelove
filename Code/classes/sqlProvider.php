<?php
/**
 * 
 * Enter description here ...
 * @author bblans
 *
 */
class SqlProvider {
	
	private $host		= "localhost";
	private $username 	= "admin";
	private $password	= "cpp4ever";
	private $dbName		= "picsarelove";

	/**
	 * Diese Funktion verbindet zu der MySql Datenbank
	 * und gibt die Verbinndung zurück
	 * @author Sascha Blank
	 * @return mysqli object mit der Datanbank Verbindung
	 */
	function connect(){
		$conn = new mysqli($host, $username, $password, $dbName);
		if( $conn->connect_error ) {
			die("Connection failed: " . $conn->connect_error);
		}
		return $conn;
	}
	
	/**
	 * Diese Funktion generiert ein SQL SELECT query als string und gibt den string zurueck
	 * @param string $p_tableName
	 * @param string $p_attributes
	 * @param string $p_where
	 */
	function generateSelectQuery($p_tableName, $p_attributes, $p_where ) {
		
	}
}