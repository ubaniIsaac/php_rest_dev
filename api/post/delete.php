<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE ');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';


//instantiate db &connect
$database = new Database();
$db = $database->connect();

$post = new Post($db);


$post->id = isset($_GET['id']) ? $_GET['id'] : die();


// $data = json_decode(file_get_contents("php://input"));

if($post->delete()){
    echo json_encode(
        array('message'=> "Post deleted")
    );
}else{
    echo json_encode(
        array('message'=> 'Post Not deleted or doesn\'t exist')
    );
}