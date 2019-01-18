<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';


//DB - Instanciar e conectar
$database = new Database();
$db = $database->connect();

//Instanciar Método do post.
$post = new Post($db);
 

//GET Id
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

//Get post
$post->read_single();

echo json_encode($post);

 
?>