<?php
require_once 'model/BaseModel.php';

class PictureModel extends BaseModel {
	
	function __construct(){
		BaseModel::__construct("pictures","picID");		
	}
	
	function createNewEntry($p_title, $p_image, $p_categoryID, $p_userID) {
		$query = "INSERT INTO $this->tableName (title, f_userID, f_categoryID, imagePath ) VALUES (?, ?, ?, ?);";
		echo $query;
		$conn = $this->connectToDb();
		$statement = $conn->prepare($query);
		
		$statement->bind_param('ssss', htmlspecialchars($p_title), $p_userID, $p_categoryID, $p_image);
		
		if (!$statement->execute()) {
			throw new Exception($statement->error);
		}
		$conn->close();
	}
	

	function showRandom() {
		
	}
	
}