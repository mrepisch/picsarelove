<?php
require_once 'model/BaseModel.php';

class UserModel extends BaseModel {
	
	function __construct(){
		BaseModel::__construct("user","userID");
	}
	
	public function registerNewUser($p_email,$p_passwd ){
        $query = "INSERT INTO $this->tableName (username, password, privileges ) VALUES (?, ?, ?);";
        $conn = $this->connectToDb();
        $statement = $conn->prepare($query);
        $hash =  password_hash($p_passwd,PASSWORD_BCRYPT);
        $priv = "1";
        $statement->bind_param('sss', $p_email, $hash, $priv);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $conn->close();
	}

}