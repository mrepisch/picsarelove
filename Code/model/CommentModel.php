<?php
require_once 'model/BaseModel.php';

/**
 * Diese Klasse stellt das Model der Comment Tabelle dar.
 * Diese Klasse erbt von der Klasse BaseModel
 * @author Sascha Blank
 *
 */

class CommentModel extends BaseModel {
	
	/**
	 * Standart Konstruktor
	 */
	function __construct(){
		BaseModel::__construct("comments","commentID");
	}

	/**
	 * Diese Funktion erstellt einen neuen Eintrag in der Comment Tabelle
	 * @param int $p_userID, die Userid die den Beitrag erstellt hat
	 * @param int $p_pictureID, die Bildid fuer die der Beitrag ist
	 * @param string $p_text, der Text des Beitrages
	 */
	function createNewComment($p_userID,$p_pictureID,$p_text){
		$query = "INSERT INTO $this->tableName (f_picID, f_userID, text ) VALUES (?, ?, ?);";
        $conn = $this->connectToDb();
        $statement = $conn->prepare($query);
        $text = htmlspecialchars($p_text);
        $statement->bind_param('iis',$p_pictureID, $p_userID, $text);
		echo $p_pictureID . "   " .$p_userID ."   ".$text;
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $conn->close();
	}
	
	/**
	 * Funktion um die Kommentare fuer ein Bild zu holen und als array zurueckzugeben
	 * @param int $pictureID, die ID des Bildes
	 * @return array mit commantaren
	 */
	function readForPic($pictureID){
		$query = "SELECT * FROM `comments` join user on f_userID=userID WHERE f_picID=? ;";
		$conn = $this->connectToDb();
		$statement = $conn->prepare($query);
		$statement->bind_param("i",$pictureID);
		if( !$statement->execute()) {
			throw new Exception($statement->error);
		}
		$result = $statement->get_result();
		$rows = array();
		while( $row = $result->fetch_object()) {
			$rows[] = $row;
		}
		$conn->close();
		return $rows;
	}
}