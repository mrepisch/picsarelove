<?php

require_once 'view/View.php';
require_once 'model/CategoryModel.php';

class CategoryController {
	
	function show_all() {
		
		$categoryModel = new CategoryModel();
		$rows = $categoryModel->readAll();
	
		$categoryView = new View("view/categories.php");
		$categoryView->data = $rows;
		$categoryView->display(false);
	
	}
	
}