<?php
require_once 'model/CommentModel.php';
require_once 'lib/session.php';
require_once 'view/View.php';
class CommentController{
	
	function createNew() {
		$commentModel = new CommentModel();
		$session = new SessionManager();
		$session->sessionLoad();
		$pictureID = $_POST["picID"];
		$userID = $session->userId;
		$text = $_POST["text"];
		$commentModel->createNewComment($userID, $pictureID, $text);
		header("Location:index.php?picID=$pictureID");
	}
	
	function show_for_pic ()
	{		
		$commentModel = new CommentModel();
		$session = new SessionManager();
		$session->sessionLoad();
		$rows = $commentModel->readForPic($_POST["picID"]);
		$commentView = new View("view/comments.php");
		$commentView->data = $rows;
		$commentView->display(false);
		
	}
}