<?php


header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);


//get id from url
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

$result = $category->read_single();

$num = $result->rowCount();


// echo json_encode($result);

if($num > 0){

$row = $result->fetch(PDO::FETCH_ASSOC);

extract($row);

$categories_arr = array(
    'id' =>$row['id'],
    'name' => $row['name'],
    'created_at' => $row['created_at'],
);

print_r(json_encode($categories_arr));
}else{
    echo json_encode(array('message'=> 'No category with this id '));
}
