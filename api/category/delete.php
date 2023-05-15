<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';


//instantiate db &connect

$database = new Database();
$db = $database->connect();

$category = new Category($db);
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

if($category->delete()) {
    echo json_encode(
      array('message' => 'Category Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Category Not Deleted')
    );
  }