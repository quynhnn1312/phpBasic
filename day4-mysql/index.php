<?php
//Cách sử dụng Model
require_once ("./vendor/autoload.php");
use Model\Product;


$product = new Product();

$product->setData('id', 1);
$product->setData('sku', "MK12345");
$product->setData('name', 'sản phẩm 2');
$product->setData('price', 12345);
$product->setData('image', "https://images.pexels.com/photos/617965/pexels-photo-617965.jpeg");
$product->setData('short_description', "Lorem Ipsum is simply dummy text of the printing and typesetting industry");
$product->setData('description', "Lorem Ipsum is simply dummy text of the printing and typesetting industry");
$product->save();