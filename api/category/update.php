<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Methods: PUT');
header('Access-Control-Headers: Access-Control-Headers,Content-Type,Access-Control-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';


//DB - Instanciar e conectar
$database = new Database();
$db = $database->connect();

//Instanciar Método do post.
$category = new Category($db);


//Get raw categoryed data
$data = json_decode(file_get_contents("php://input"));

//Set Id to update
$category->id = $data->id;

$category->name = $data->name;
 
//Update category
if($category->update()){
    echo json_encode(
        array('message'=>'Category Updated!')
    );
}else{
    echo json_encode(
        array('message'=>'Category Not Updated =(')
    );
}

?>