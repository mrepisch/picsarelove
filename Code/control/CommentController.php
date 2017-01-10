<?php
require_once 'model/CommentModel.php';
require_once 'lib/session.php';
class CommentController{
	
	function createNew() {
		$commentModel = new CommentModel();
		$session = new SessionManager();
		$session->sessionLoad();
		$pictureID = $_POST["pictureid"];
		$userID = $session->userId;
		$text = $_POST["text"];
		$commentModel->createNewComment($userID, $pictureID, $text);
	}
	
	function show_for_pic ()
	{
		echo $_POST["picID"];
	}
}