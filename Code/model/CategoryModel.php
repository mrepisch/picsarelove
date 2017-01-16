<?php
require_once 'model/BaseModel.php';

/**
 * Diese Klasse stellt das Model der Cataegory Tabelle dar.
 * Diese Klasse erbt von der BaseModel Klasse
 * @author Petar Barisic
 *
 */
class CategoryModel extends BaseModel {

	function __construct(){
		BaseModel::__construct("categories","categoryID");
	}
}