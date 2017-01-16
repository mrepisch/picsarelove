<?php
require_once 'model/BaseModel.php';

class CategoryModel extends BaseModel {

	function __construct(){
		BaseModel::__construct("categories","categoryID");
	}
	

}