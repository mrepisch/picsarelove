<?php
require_once 'model/BaseModel.php';

class PictureModel extends BaseModel {
	
	function __construct(){
		BaseModel::__construct("picture","picID");		
	}
	
	function createNewEntry($p_title, $p_image, $p_categoryID, $p_userID) {
		$query = "INSERT INTO $this->tableName (username, password, privileges ) VALUES (?, ?, ?);";
		$conn = $this->connectToDb();
		$statement = $conn->prepare($query);
		
		$statement->bind_param('sbii', $p_title, $p_image, $p_categoryID, $p_userID);
		
		if (!$statement->execute()) {
			throw new Exception($statement->error);
		}
		$conn->close();
	}
}