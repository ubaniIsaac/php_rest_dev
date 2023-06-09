<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';


//instantiate db &connect
$database = new Database();
$db = $database->connect();

$post = new Post($db);


//Get Id from url
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

//get post single from read single function
$post->read_single();

//create array
$post_arr = array(
    'id' =>$post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name,

);


//make json
print_r(json_encode($post_arr));
