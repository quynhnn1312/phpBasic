<?php
    include_once ("./database/File.php");
    include_once ("./resourceModel/CartResourceModel.php");

    $fileCart = new CartResourceModel();
    $carts = $fileCart->loadAllCart();
    $item = count($carts);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="./public/css/style.css">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
        <a class="navbar-brand text-white border border-white px-2" href="#">SMART-OSC</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="./index.php"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-white" href="./addProduct.php"><i class="fas fa-folder-plus"></i> Add Product</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-white" href="./cart.php"><i class="fas fa-shopping-cart"></i> <?php echo $item>0 ? "($item item)" : "(Empty)" ?> </a>
                </li>
            </ul>
            <form action="./index.php" method="post" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" value="" type="search" name="keyword" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>

        </div>
    </nav>