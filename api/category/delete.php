<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Methods: DELETE');
header('Access-Control-Headers: Access-Control-Headers,Content-Type,Access-Control-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';


//DB - Instanciar e conectar
$database = new Database();
$db = $database->connect();

//Instanciar Método do category.
$category = new Category($db);


//Get raw category data
$data = json_decode(file_get_contents("php://input"));

//Set Id to update
$category->id = $data->id;

//Update category
if($category->delete()){
    echo json_encode(
        array('message'=>'Category Deleted!')
    );
}else{
    echo json_encode(
        array('message'=>'Category Not Deleted =(')
    );
}

?>