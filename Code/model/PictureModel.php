<?php
require_once 'model/BaseModel.php';

/**
 * Diese Klasse stellt das Model der Picture Tabelle dar.
 * Diese Klasse erbt von der Klasse BaseModel
 * @author Sascha Blank
 *
 */
class PictureModel extends BaseModel {
	
	/**
	 * Standart Konstruktir
	 */
	function __construct(){
		BaseModel::__construct("pictures","picID");		
	}
	
	/**
	 * Diese Funktion erstellt einen neuen Eintrag in der Picture Tabelle
	 * @param string $p_title der Titel des Bildes
	 * @param string $p_image der Pfath auf dem Webserver zu dem Bild
	 * @param int $p_categoryID, die ID der Categoriy Tabelle 
	 * @param int $p_userID, die ID des Users der das Bild hochgeladen hat.
	 */
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
	
	
	/**
	 * Diese Function gibt das ensprechende Record des Bildes zurueck das ein Punkt vor der uebergebenen Picture ID in der DB 
	 * vorhanden ist.
	 * @param int $p_pictureID, die ID des Bildes
	 * @return object mit dem record aus der Picture Tabelle
	 */
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
	
	/**
	 * Diese Function gibt das ensprechende Record des Bildes zurueck das ein Punkt nach der uebergebenen Picture ID in der DB 
	 * vorhanden ist.
	 * @param int $p_picture die ID des Bildes in der Picture Tabelle
	 * @return object mit der record aus der Picture Tabelle
	 */
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
	
	/**
	 * Diese Funktion gibt alle Bilder der Picture Tabelle mit der entsprechenden Kategorie zurück.
	 * @param int $p_categoryID, die ID der Kategorie
	 * @return array mit records aus der Picture Tabelle
	 */
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