<?php
require_once 'model/BaseModel.php';

class PictureModel extends BaseModel {
	
	function __construct(){
		BaseModel::__construct("pictures","picID");		
	}
	
	function createNewEntry($p_title, $p_image, $p_categoryID, $p_userID) {
		$query = "INSERT INTO $this->tableName (title, f_userID, f_categoryID, imagePath ) VALUES (?, ?, ?, ?);";
		$conn = $this->connectToDb();
		$statement = $conn->prepare($query);
		$title = htmlspecialchars($p_title);
		$statement->bind_param('ssss', $title , $p_userID, $p_categoryID, $p_image);
		
		if (!$statement->execute()) {
			throw new Exception($statement->error);
			return false;
		}
		$conn->close();
		return true;
	}
	
	
	function getLastPicture($p_pictureID){
		$row = $this->getByPrimaryKey($p_pictureID - 1,"*");
		if(empty($row ) ){
			$query = "SELECT * FROM $this->tableName ORDER BY picID DESC LIMIT 1";
			$conn = $this->connectToDb();
			$statement = $conn->prepare($query);
			if (!$statement->execute()) {
				throw new Exception($statement->error);
			}
			$result = $statement->get_result();
			$row = $result->fetch_object();
		}
		return $row;		
	}
	
	function getNextPicture($p_picture){
		$row = $this->getByPrimaryKey($p_picture + 1,"*");
		if(empty($row ) ){
			$query = "SELECT * FROM $this->tableName WHERE 1;";
			$conn = $this->connectToDb();
			$statement = $conn->prepare($query);
			if (!$statement->execute()) {
				throw new Exception($statement->error);
			}
			$result = $statement->get_result();
			$row = $result->fetch_object();
		}
		return $row;
	}
	
	function getByCategory($p_categoryID){
		$query = "SELECT * FROM $this->tableName WHERE f_categoryID = ?;";
		$conn = $this->connectToDb();
		$statement = $conn->prepare($query);
		$statement->bind_param("i", $p_categoryID);
		if (!$statement->execute()) {
			throw new Exception($statement->error);
		}
		$result = $statement->get_result();
		$rows = array();
		while( $row = $result->fetch_object()) {
			$rows[] = $row;
		}
		return $rows;
		
	}

	
}