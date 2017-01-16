<?php
require_once 'model/BaseModel.php';

class CommentModel extends BaseModel {
	
	function __construct(){
		BaseModel::__construct("comments","commentID");
	}

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
}