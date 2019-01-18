<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';


//DB - Instanciar e conectar
$database = new Database();
$db = $database->connect();


//Instanciar Método do Category.
$category = new Category($db);


//Busca no banco de dados.
$result = $category->read();

//Pega o rowCount;
$num = $result->rowCount();


if($num > 0){
    $categories_arr = array();
    $categories_arr['data'] = array();


    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $cat_item = array(
            'id' => $id,
            'name' => $name,
            'created_at' => $created_at

        );

        //Incorporar 'data'
        array_push($categories_arr['data'],$cat_item);
    }

    //Converter para Json
    echo json_encode($categories_arr);

}else{
    echo json_encode(
        array('message' => 'Nenhum resultado encontrado')
    );
}

?>