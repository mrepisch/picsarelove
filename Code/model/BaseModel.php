<?php
/**
 * 
 * Enter description here ...
 * @author bblans
 *
 */
class BaseModel {

	protected $tableName;
	protected $primarayKey;
	

	
	function __construct( $p_tablename, $p_primaryKey  ) {
		$this->tableName = $p_tablename;
		$this->primarayKey = $p_primaryKey;		
	}
	
	static function connectToDb() {
		$host		= "localhost";
	 	$username 	= "admin";
	 	$password	= "cpp4ever";
	 	$dbName		= "picsarelove";
		$conn = new mysqli(host, username, password, dbName);
		if( $conn->connect_error ) {
			die("Connection failed: " . $conn->connect_error);
		}
		return $conn;
	}
	
	protected  function getByPrimaryKey( $p_pk, $p_attributes ) {
		$query = "SELECT $p_attributes FROM $this->tableName WHERE $this->primarayKey = ?;";
		$statement = BaseModel::connectToDb()->prepare($query);
		$statement->bindParam('i',$p_pk);
		if( !$statement->execute()) {
			throw new Exception($statement->error);
		}
		$result = $statement->get_result();
		$row = $result->fetch_object(); 
		return $row;
	}
	
	protected function readAll( $p_limit = 100) {
		$query = "SELECT * FROM $this->tableName LIMIT = $p_limit";
		$statement = BaseModel::connectToDb()->prepare($query);
		if( !$statement->execute()) {
			throw new Exception($statement->error);
		}
		$result = $statement->get_result();
		$rows = array();
		while( $row = $result->fetch_object()) {
			$rows[] = $row;
		}
		return $rows;
	}
	
	protected function deleteEntry( $p_pk ) {
		$query = "DELETE FROM $this->tableName WHERE $this->primarayKey = ?;";
		$statement = BaseModel::connectToDb()->prepare($query);
		$statement->bind_param('i', $p_pk);
			if( !$statement->execute()) {
			throw new Exception($statement->error);
		}
	}
	
	
}