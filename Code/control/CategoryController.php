<?php

require_once 'view/View.php';
require_once 'model/CategoryModel.php';

class CategoryController {
	
	function readCategories() {
		return BaseModel::readAll();
	}
}