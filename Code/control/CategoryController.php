<?php
require_once 'view/View.php';
require_once 'model/CategoryModel.php';

/**
 * Diese Klasse ist der Controller für die Kategorien.
 * @author Sascha Blank
 */

class CategoryController {
	
	/**
	 * Diese Funktion holt sich alle Kategorien aus dem Model und schreibt diese in den View
	 */
	function show_all() {
		$categoryModel = new CategoryModel();
		$rows = $categoryModel->readAll();
		$categoryView = new View("view/categories.php");
		$categoryView->data = $rows;
		$categoryView->display(false);
	}
	
}