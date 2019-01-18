<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Methods: DELETE');
header('Access-Control-Headers: Access-Control-Headers,Content-Type,Access-Control-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';


//DB - Instanciar e conectar
$database = new Database();
$db = $database->connect();

//Instanciar Método do post.
$post = new Post($db);


//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

//Set Id to update
$post->id = $data->id;

//Update post
if($post->delete()){
    echo json_encode(
        array('message'=>'Post Deleted!')
    );
}else{
    echo json_encode(
        array('message'=>'Post Not Deleted =(')
    );
}

?>