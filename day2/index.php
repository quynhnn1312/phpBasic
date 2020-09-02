<?php
    require_once ("./function.php");
    $products = getAllProduct("db.text");
    // search product
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $keyword = $_POST['keyword'];
        $data = @file("db.text");
        $productSearchs = search($data, $keyword);
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
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sku</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Size</th>
                    <th scope="col">Color</th>
                    <th scope="col">
                        <a class="btn btn-outline-success" href="addForm.php">Add</a>
                    </th>
                </tr>
                </thead>
                <tbody>
                    <?php if(isset($products)): foreach ( $keyword ? $productSearchs : $products as $key => $product): ?>
                        <tr>
                            <td><?php echo $key+1 ?></td>
                            <td><?php echo $product[0] ?></td>
                            <td><?php echo $product[1] ?></td>
                            <td>
                                <img class="img-thumbnail" src="<?php echo $product[6] ?>" width="150px" alt="">
                            </td>
                            <td><?php echo $product[5] ?></td>
                            <td><?php echo $product[2] ?>$</td>
                            <td><?php echo $product[3] ?></td>
                            <td><?php echo $product[4] ?></td>
                            <td>
                                <a class="btn btn-outline-info" href="productDetail.php?id=<?php echo $key; ?>"><i class="fas fa-eye"></i> Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </section>
    </div>

    <?php require_once('./commons/script.php') ?>
    <script>
        <?php if(isset($_SESSION['success'])): ?>
        Swal.fire({
            toast: true,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: 'success',
            title: "<?php echo $_SESSION['success']; ?>",
            position: 'top-end'
        })
        <?php endif; unset($_SESSION['success']); ?>
    </script>
</body>
</html>