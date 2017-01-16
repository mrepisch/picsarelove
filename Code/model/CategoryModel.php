<?php
require_once 'model/BaseModel.php';

class CategoryModel extends BaseModel {

	function __construct(){
		BaseModel::__construct("categories","categoryID");
	}
	
	function showCategories() {
		$baseModel = new BaseModel();
		return $baseModel->readAll();
	}

}