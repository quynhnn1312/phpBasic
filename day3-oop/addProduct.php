<?php
    require_once ("./commons/header.php");
    require_once("./model/Product.php");
    include_once ("./database/File.php");
    include_once ("./resourceModel/ProductResourceModel.php");
    $model = new Product();
    $error = $model->addProduct();
?>
    <section class="mt-5">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Product</h3>
            </div>
            <form role="form" action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-6">
                            <div class="form-group">
                                <label for="Sku">Sku <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo isset($sku) ? $sku : '' ?>" name="sku" class="form-control" placeholder="Enter sku ...">
                                <span class="text-danger"><?php echo isset($error['sku']) ? $error['sku'] : "" ?></span>
                            </div>
                            <div class="form-group">
                                <label for="Title">Name <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo isset($name) ? $name : '' ?>" name="name" class="form-control" placeholder="Enter name ...">
                                <span class="text-danger"><?php echo isset($error['name']) ? $error['name'] : "" ?></span>
                            </div>
                            <div class="form-group">
                                <label for="Price">Price <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" value="<?php echo isset($price) ? $price : '' ?>" name="price" class="form-control" placeholder="Enter price ...">
                                <span class="text-danger"><?php echo isset($error['price']) ? $error['price'] : "" ?></span>
                            </div>
                            <div class="form-group">
                                <label for="Price">Quantity <span class="text-danger">*</span></label>
                                <input type="number" value="<?php echo isset($quantity) ? $quantity : '' ?>" name="quantity" class="form-control" placeholder="Enter quantity ...">
                                <span class="text-danger"><?php echo isset($error['quantity']) ? $error['quantity'] : "" ?></span>
                            </div>
                            <div class="form-group">
                                <label for="Size">Size <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo isset($size) ? $size : '' ?>" name="size" class="form-control" placeholder="Enter size ...">
                                <span class="text-danger"><?php echo isset($error['size']) ? $error['size'] : "" ?></span>
                            </div>
                            <div class="form-group">
                                <label for="Color">Color <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo isset($color) ? $color : '' ?>" name="color" class="form-control" placeholder="Enter color ...">
                                <span class="text-danger"><?php echo isset($error['color']) ? $error['color'] : "" ?></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-6">
                            <div class="form-group text-center">
                                <img width="300px" id="output" src="./public/image/default-image.jpg" alt="..." class="img-thumbnail">
                            </div>
                            <div class="form-group">
                                <label for="Color">Image URL <span class="text-danger">*</span></label>
                                <input type="file" value="<?php echo isset($image) ? $image : '' ?>" name="image" id="input" class="form-control" placeholder="Choose file">
                                <span class="text-danger"><?php echo isset($error['image']) ? $error['image'] : "" ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button> &nbsp;
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </form>
        </div>
    </section>


<script>
    // preview image
    document.querySelector("#input").oninput = (event) => {
        let output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>

<?php require_once ("./commons/footer.php") ?>

