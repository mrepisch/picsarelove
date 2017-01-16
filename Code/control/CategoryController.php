<?php

require_once 'view/View.php';
require_once 'model/CategoryModel.php';

class CategoryController {
	
	function show_categories() {
		$categoriesModel = new CategoryModel();
		return $categoriesModel->showCategories();
	}
	
}