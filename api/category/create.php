<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Methods: POST');
header('Access-Control-Headers: Access-Control-Headers,Content-Type,Access-Control-Methods,
Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';


//DB - Instanciar e conectar
$database = new Database();
$db = $database->connect();

//Instanciar Método do category.
$category = new Category($db);


//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$category->name = $data->name;


//create category
if($category->create()){
    echo json_encode(
        array('message'=>'category Created!')
    );
}else{
    echo json_encode(
        array('message'=>'category Not Created =(')
    );
}

?>