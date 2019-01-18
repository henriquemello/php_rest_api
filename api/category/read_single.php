<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';


//DB - Instanciar e conectar
$database = new Database();
$db = $database->connect();

//Instanciar Método do post.
$category = new Category($db);
 

//GET Id
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

//Get category
$category->read_single();

echo json_encode($category);

 
?>