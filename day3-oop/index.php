<?php
    require_once ("./commons/header.php");
    include_once ("./database/File.php");
    include_once ("./resourceModel/ProductResourceModel.php");
    include_once ("./resourceModel/CartResourceModel.php");
    include_once ("./model/Product.php");
    include_once ("./model/Cart.php");

    $fileProduct = new ProductResourceModel();
    $fileProducts = $fileProduct->loadAllProduct();

    if(isset($_GET['idProduct'])){
        $cart = new Cart();
        $cart->addToCart($_GET['idProduct'], 1);
    }
?>
    <section class="mt-5">
        <div class="section-title text-center mb-3">
            <h2>List Product</h2>
        </div>
        <div class="row">
            <?php if(isset($fileProducts)){
                    foreach ($fileProducts as $key => $fileProduct){ ?>
                        <?php $product = new Product($fileProduct) ?>
                        <div class="col-sm-3 col-md-3 col-3 mb-4">
                            <div class="card" style="width: 16rem;">
                                <img class="card-img-top" src="<?php echo $product->getImage() ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $product->getName() ."-". $product->getSku() ?></h5>
                                    <p class="card-price my-0">Price: <?php echo $product->price() ?></p>
                                    <p class="card-quantity my-0">Quantity: <?php echo $product->getQuantity() ?></p>
                                    <p class="card-size my-0">Size: <?php echo $product->getSize() ?></p>
                                    <p class="card-color">Color: <?php echo $product->getColor() ?></p>
                                    <a href="?idProduct=<?php echo $key ?>" class="btn btn-primary">Add To Cart</a>
                                </div>
                            </div>
                        </div>
            <?php } } ?>
        </div>
    </section>

<?php require_once ("./commons/footer.php") ?>
<script>
    // notify success
    <?php if(isset($_SESSION['success'])): ?>
    Swal.fire({
        toast: true,
        showConfirmButton: false,
        timerProgressBar: true,
        position: 'top-end',
        icon: 'success',
        title: "<?php echo $_SESSION['success']; ?>",
        showConfirmButton: false,
        timer: 1500
    })
    <?php endif; unset($_SESSION['success']);?>
</script>

