<?php
require_once 'model/CommentModel.php';
require_once 'lib/session.php';
require_once 'lib/Validator.php';
require_once 'view/View.php';

/**
 * Diese Klasse stellt den Controller für die Benutzerkommentare dar.
 * @author Sascha Blank
 *
 */
class CommentController{
	
	/**
	 * Diese Funktion erstellt einen neuen Kommentar aus den Forulardaten
	 * und leitet danach auf die Webseite auf das ensprechende Bild um
	 */
	function createNew() {
		$commentModel = new CommentModel();
		$session = new SessionManager();
		$session->sessionLoad();
		$pictureID = $_POST["picID"];
		$userID = $session->userId;
		$text = $_POST["text"];
		if(!Validator::isStringEmpty($text)) {
			$commentModel->createNewComment($userID, $pictureID, $text);
			header("Location:index.php?picID=$pictureID");
		} else {
			header("Location:index.php?picID=$pictureID&comment_error=Bitte geben Sie einen Kommentar ein");
		}
	}

	/**
	 * Diese Funktion holt alle Kommentare für ein Bild aus der DB und übergiebt diese an den View
	 */
	function show_for_pic () { 		
		$commentModel = new CommentModel();
		$session = new SessionManager();
		$session->sessionLoad();
		$commentError = "";
		if( isset($_GET["comment_error"])){
			$commentError = $_GET["comment_error"];
		}
		$rows = $commentModel->readForPic($_POST["picID"]);
		$commentView = new View("view/comments.php");
		$commentView->data = $rows;
		$commentView->errormessage = $commentError;
		$commentView->display(false);
		
	}
}