<?php
require_once 'view/View.php';
require_once 'model/PictureModel.php';
require_once 'lib/session.php';
require_once 'lib/Validator.php';
require_once 'model/CategoryModel.php';
require_once 'model/CommentModel.php';

/**
 * Diese Klasse stellt den Controller für die Bilder dar.
 * Sprich die Klasse verwaltet den Upload, und die Anzeige der Bilder.
 * Der View der in der Regel angesprochen wird ist main_content.php
 * @author Sascha Blank
 *
 */

class PictureController {
	
	/**
	 * Funktion um die Session Variablen in den View zu setzten 
	 * @param View $view, der View
	 */
	private function setSessionVarsToView($view) {
		$session = new SessionManager();
		$session->sessionLoad();
		$view->isLogdin = $session->getIsLogdin();
		$view->userName = $session->username;
	}
	
	/**
	 * Diese Funktion ist für den Upload der Bilder zuständig. 
	 * Es schreibt eine neue Bilddatei mit dem Bild das aus dem Formular stammt. 
	 * Ausserdem schreibt es noch einen neuen Eintrag in die DB
	 */
	function upload() {
		//Schreibe neue Bilddatei im Ordner pictures
		$targetdir = 'pictures/';
		$newFileName = $targetdir . uniqid() .".". pathinfo($_FILES['picture']['name'],PATHINFO_EXTENSION);
		$targetfile = $_FILES['picture']['name'] = $newFileName;
		if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetfile)) {
	
			$session = new SessionManager();
			$session->sessionLoad();
			$title = $_POST["title"];
			$categoryID = $_POST["category"];
			$userID = $session->userId;
			//Überprüfe ob alle Werte gesetzt sind vor allem die Kategorie ist wichtig.
			if( !Validator::isFieldNotZero($categoryID)) {
				//zeige formular mit Fehlermeldung nochmal an
				header("Location:index.php?cont=Picture&action=displayForm&error=Bitte Kategorie auswählen");
			} else if(Validator::isStringEmpty($title)) {
				//zeige formular mit Fehlermeldung nochmal an
				header("Location:index.php?cont=Picture&action=displayForm&error=Titel Feld ist leer");
			} else if(Validator::isStringEmpty($targetfile)) {
				//zeige formular mit Fehlermeldung nochmal an
				header("Location:index.php?cont=Picture&action=displayForm&error=Keine Datei ausgewählt");
			} else {
				$pictureModel = new PictureModel();
				$pictureModel->createNewEntry($title, $targetfile, $categoryID, $userID);
				header("Location:index.php?cont=Picture&action=show");
			}
		} else {
			echo "shitbelt";
		}
	}
	
	/**
	 * Diese Funktion list alle Kategorien ein und zeigt das Upload Formular an
	 */
	function displayForm() {
		$session = new SessionManager();
		$session->sessionLoad();
		$categorys = new CategoryModel();
		$rows = $categorys->readAll();
		$view = new View("view/uploadPic.php");
		$upload_error = "";
		if( isset($_GET["error"])){
			$upload_error = $_GET["error"];
		}
		$view->upload_error = $upload_error;
		$view->rows = $rows;
		$view->isLogdin = $session->getIsLogdin();
		$view->userName = $session->username;
		$view->display();
	}
	
	/**
	 * Diese Funktion zeigt anhand der Parameter picID und/oder categoriy ein ensprechendes Bild in der main_content.php(View) an.
	 * Folgende Fälle existieren:
	 * 1.)Keine ID und Kategorie angegeben
	 * 2.)Bild ID aber keine Kategorie angegeneben
	 * 3.)random als BildID Parameter, in diesem Fall ein zufälliges Bild wählen
	 * 4.)Bildid und KategorieID sind agegeben.
	 */
	function show() {
		//Hole zuerst die Parameter
		$picID = 1;
		if( isset($_GET["picID"]) && is_numeric($_GET['picID'])) {
			$picID = $_GET["picID"];
			
			if ($picID <= 0){
				$picID = 1;
			}
		} else if(isset($_GET["picID"])) {
			$picID = $_GET["picID"];
		}
		$category = -1;
		if( isset( $_GET["category"] ) && is_numeric($_GET['category'])) {
			$category = $_GET["category"];
			if( $category < -1){
				$category = -1;
			}
		}
		
		$pictureModel = new PictureModel();
		//Wen beide Paramter nicht gesetzt worden sind.
		if( $picID == 1 && $category == -1 ) {
			$row = $pictureModel->readAll(1);
			if( !empty($row)){
				$row = $row[0];
				$picID = $row->picID;
			}
		} else {
			//Bild mit spezifischer picID anzeigen
			$row = $pictureModel->getByPrimaryKey($picID, "*");
		}
		if( $picID == "random" ){
			//Fall für zufällige Bilder
			$row = $pictureModel->readAll();
			if( count($row) > 0){
				$randomInt = rand(0, count($row) - 1);
				$row = $row[$randomInt];
				$picID = $row->picID;
			}
		}
		if( $category == -1){
			//Falls Kategorie nicht gesetzt ist
			$nextPic = $pictureModel->getNextPicture( $picID );
			$lastPic = $pictureModel->getLastPicture( $picID );
			
			$contentView = new View("view/main_content.php");
			$this->setSessionVarsToView($contentView);
			$contentView->data = $row;
			$contentView->categoryID = $category;
			$contentView->last = $lastPic;
			$contentView->next = $nextPic;
			if( !empty($row)){
				$contentView->display();
			} else {
				$contentView->display(true,false);
			}
		}
		else {
			// Falls Kategorie gesetzt.
			$index = 0;
			$counter = 0;
			$rows = $pictureModel->getByCategory($category);
			$contentView = new View("view/main_content.php");
			$this->setSessionVarsToView($contentView);
			if( !empty($rows)){
				$contentView->categoryID = $category;
				if( $picID == 1){
					//Falls nur Kategorie angegeben
					$contentView->data = $rows[0];
				} else {
					//Falls id und Kategorie angegeben.
					foreach( $rows as $row){
						if( $row->picID == $picID ){
							$contentView->data = $row;
							$index = $counter;
						}
						$counter ++;
					}
				}
				// Hole nächstes und vorhergehendes Bild
				$rowCount = count($rows);
				if( $index == 0){
					$contentView->last = $rows[$rowCount - 1];
				} else{
					$contentView->last = $rows[$index - 1];
				}
				if( $index >= $rowCount - 1){
					$contentView->next = $rows[0];
				} else{
					$contentView->next = $rows[$index + 1];	
				}
				$contentView->categoryID = $category;	
				$contentView->display();
			} else {
				//Falls keine Bilder mit Kategorie ID vorhanden.
				$contentView->display(true,false);
			}
		}
		
	}
	
	
	/**
	 * Diese Funktion löscht anhand des Parameters picID
	 * zuerst alle dazugehörigen Kommentare und dann das Bild das ausgewählt wurde.
	 */
	function delete() {
		if( isset($_GET["picID"])) {
			$picID = $_GET["picID"];
		}
		$session = new SessionManager();
		$session->sessionLoad();
		$sessionUserID = $session->userId;
		$pictureModel = new PictureModel();
		$row = $pictureModel->getByPrimaryKey($picID, "*");
		$userID = $row->f_userID;
		
		if ($userID == $sessionUserID) {
			unlink($row->imagePath);	
			$commentModel = new CommentModel();
			$commentModel->deleteForPic($picID);
			$pictureModel->deleteEntry($picID);
			header("Location:index.php?cont=User&action=showOptions");
		}
	}

}
  