<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';


//instantiate db &connect

$database = new Database();
$db = $database->connect();

$post = new Post($db);
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

$post->read_single();

$data = json_decode(file_get_contents("php://input"));

$post->title =  isset($data->title) ? $data->title : $post->title;
$post->body = isset($data->body) ? $data->body : $post->body ;
$post->author = isset($data->author) ? $data->author : $post->author ;
$post->category_id = isset($data->category_id) ? $data->category_id : $post->category_id ;

if($post->update()){
    echo json_encode(
        array('message'=> $post)
    );
}else{
    echo json_encode(
        array('message'=> 'Post Not created')
    );
}