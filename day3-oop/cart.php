<?php
    require_once ("./commons/header.php");
    include_once ("./database/File.php");
    include_once ("./resourceModel/ProductResourceModel.php");
    include_once ("./resourceModel/CartResourceModel.php");
    include_once ("./model/Cart.php");
    include_once ("./model/Product.php");

    $fileCart = new CartResourceModel();
    $fileCarts = $fileCart->loadAllCart();
    $total = 0;

    $cart = new Cart();
    $cart->removeItem();
    $cart->updateToCart();

?>
    <section class="mt-5">
        <div class="section-title text-center">
            <h2>Shopping Cart</h2>
        </div>
        <table class="table text-center mt-3">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Model</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($fileCarts)){
                    foreach ($fileCarts as $key => $fileCart){ ?>
                        <?php
                            $cart = new Cart($fileCart);
                            $fileProduct = new ProductResourceModel();
                            $product = $fileProduct->loadProduct($cart->getIdProduct());
                        ?>
                        <tr>
                            <td>
                                <img class="img-thumbnail" src="<?php echo $product['image']; ?>" width="150px" alt="">
                            </td>
                            <td>
                                <p><?php echo $product['name']; ?></p>
                                <p>Size: <?php echo $product['size']; ?></p>
                                <p>Color: <?php echo $product['color']; ?></p>
                            </td>
                            <td> <?php echo $cart->getQuantity() ?> </td>
                            <td>
                                <form method="post" action="">
                                    <div class="input-group btn-block d-flex justify-content-center">
                                        <div class="cart-input">
                                            <input class="cart-input-box" name="quantity" type="text" value="<?php echo $cart->getQuantity() ?>">
                                            <input name="idProduct" value="<?php echo $cart->getIdProduct(); ?>" type="hidden">
                                            <input name="presentQty" value="<?php echo $cart->getQuantity(); ?>" type="hidden">
                                            <div onclick="decQuantity(event)" class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                            <div onclick="incQuantity(event)" class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                        </div>
                                        <span class="input-group-btn">
                                            <button type="submit" data-toggle="tooltip" data-direction="top" class="btn btn-primary text-white" data-original-title="Update"><i class="fas fa-sync-alt"></i></button>
                                            <a href="?idItem=<?php echo $key ?>&quantity=<?php echo $cart->getQuantity()?>&idProduct=<?php echo $cart->getIdProduct()?>" type="button" data-toggle="tooltip" data-direction="top" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-times-circle"></i></a>
                                        </span>
                                    </div>
                                </form>
                            </td>
                            <td><?php echo "$" . number_format($product['price'],2); ?></td>
                            <td><?php echo "$" . number_format($product['price'] * $cart->getQuantity(),2); ?></td>
                            <?php $total += $product['price'] * $cart->getQuantity() ?>
                        </tr>
                <?php } } ?>
            </tbody>
        </table>
        <hr>
        <div class="cart-amount-wrapper">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 offset-md-8">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td><strong>Sub-Total:</strong></td>
                            <td><?php echo "$" . number_format($total,2); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total:</strong></td>
                            <td><span class="color-primary"><?php echo "$" . number_format($total,2); ?></span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>



    <script src="./public/js/main.js"></script>
<?php require_once ("./commons/footer.php") ?>
<script>
    // notify success
    <?php if(isset($_SESSION['danger'])): ?>
    Swal.fire({
        toast: true,
        showConfirmButton: false,
        timerProgressBar: true,
        position: 'top-end',
        icon: 'error',
        title: "<?php echo $_SESSION['danger']; ?>",
        showConfirmButton: false,
        timer: 1500
    })
    <?php endif; unset($_SESSION['danger']);?>
</script>
