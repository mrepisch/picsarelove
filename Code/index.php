<?php
require_once 'classes/sqlProvider.php';
$sql = new SqlProvider();
//echo $sql->generateSelectQuery("categories", "*", "");
//echo $sql->generateInsertQuery("categories", "categoryName", "'Lustiges'");
echo $sql->generateUpdateQuery("categories", "categoryName='test'", "categoryID=1");

echo $sql->generateDeleteQuery("categories", "categoryID=1");