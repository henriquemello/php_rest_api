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


//Busca no banco de dados.
$result = $post->read();

//Pega o rowCount;
$num = $result->rowCount();


if($num > 0){
    $posts_arr = array();
    $posts_arr['data'] = array();


    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        );

        //Incorporar 'data'
        array_push($posts_arr['data'],$post_item);
    }

    //Converter para Json
    echo json_encode($posts_arr);

}else{
    echo json_encode(
        array('message' => 'Nenhum resultado encontrado')
    );
}

?>