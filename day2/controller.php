<?php
require_once ('function.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sku = $_POST['sku'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $description = $_POST['description'];

    $microtime = microtime();
    $microtime = str_replace(' ','_',$microtime)  ;
    $microtime = str_replace('.','_',$microtime)  ;

    $feature_image = './public/image/';
    $extension = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
    $feature_image_file = $feature_image . $microtime . '.' . $extension;

    $uploaded1 = move_uploaded_file($_FILES['image']['tmp_name'],$feature_image_file) ;

    $error = [];

    if($sku == NULL){
        $error['sku'] = "* Please enter the product sku !";
    }
    if($title == NULL){
        $error['title'] = "* Please enter the product sku !";
    }
    if($price == NULL){
        $error['price'] = "* Please enter the product price !";
    }
    if($size == NULL){
        $error['size'] = "* Please enter the product size !";
    }
    if($color == NULL){
        $error['color'] = "* Please enter the product color !";
    }
    if($description == NULL){
        $error['description'] = "* Please enter the product description !";
    }
    if($uploaded1 == NULL){
        $error['image'] = "* Please enter the product image !";
    }

    $_POST['image'] = $feature_image_file;

    if(empty($error)){
        createProduct("db.text", $_POST);
    }
}
require_once ('addForm.php');
?>

