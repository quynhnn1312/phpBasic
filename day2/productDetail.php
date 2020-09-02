<?php
    require_once ("./function.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $product = getProductById("db.text", $id);
    }
?>
<!doctype html>
<html lang="en">
<head>
    <?php require_once("./commons/head.php") ?>
</head>
<body>
<div class="container">
    <?php require_once("./commons/nav.php") ?>
    <section class="mt-5">
        <div class="card card-primary">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-6">
                    <img width="100%" src="<?php echo $product[6] ?>" alt="..." class="img-thumbnail">
                </div>
                <div class="col-sm-6 col-md-6 col-6 mt-5">
                    <h1 class="title-text mb-4"><?php echo $product[1] ?></h1>
                    <p class="sku-text"><span class="font-weight-bold">SKU: </span> <?php echo $product[0] ?></p>
                    <p class="price-product"><span class="font-weight-bold">Price: </span> <?php echo $product[2] ?>$ </p>
                    <hr>
                    <p class="font-weight-bold">Available Options</p>
                    <div>
                        <span class="size-product mr-5"><span class="font-weight-bold">Size: </span><?php echo $product[3] ?></span>
                        <span class="color-product"><span class="font-weight-bold">Color: </span><?php echo $product[4] ?></span>
                    </div>
                    <hr>
                    <p class="description-product">
                        <?php echo $product[5] ?>
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once('./commons/script.php') ?>
</body>
</html>