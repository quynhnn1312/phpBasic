<?php
    session_start();
    include_once ("../resourceModel/ProductResourceModel.php");
    include_once ("../resourceModel/CartResourceModel.php");
    include_once ("../model/Product.php");
    class Cart {
        private $idProduct, $quantity;

        public function __construct($values=[]){
            $this->idProduct = $values['idProduct'] ?? '';
            $this->quantity = $values['quantity'] ?? '';
        }


        public function getQuantity() {
            return $this->quantity;
        }

        public function getIdProduct() {
            return $this->idProduct;
        }

        public function addToCart () {
            if(isset($_GET['idProduct'])){
                $idProduct = $_GET['idProduct'];
                $quantity = 1;
                if($idProduct != "" && $quantity != ""){
                    $product = new ProductResourceModel();
                    $product = $product->loadProduct($idProduct);
                    if($quantity > $product['quantity']){
                        $_SESSION['danger']='Số lượng yêu cầu không có sẵn';
                        header("location: index.php");
                        return;
                    }
                    $cart = new CartResourceModel();
                    $cart->saveCart([ "idProduct" => $idProduct, "quantity" => $quantity]);

                    // decrease quantity Product
                    $pro = new Product();
                    $pro->decreaseQuantity($idProduct, $quantity);

                    header("location: index.php");
                    $_SESSION['success']='Thêm giỏ hàng thành công';
                }
            }
        }

        public function removeItem() {
            if(isset($_GET['idItem']) && isset($_GET['quantity']) && isset($_GET['idProduct'])) {
                // decrease quantity Product
                $pro = new Product();
                $pro->increaseQuantity($_GET['idProduct'], $_GET['quantity']);

                // remove item cart
                $cart = new CartResourceModel();
                $cart->removeItemCart($_GET['idItem']);

                header("location: cart.php");
            }
        }

        public function updateToCart () {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $product = new Product();

                if($_POST['quantity'] > $_POST['presentQty']){
                    $productById = new ProductResourceModel();
                    $productById = $productById->loadProduct($_POST['idProduct']);

                    $quantity = $_POST['quantity'] - $_POST['presentQty'];
                    if($quantity > $productById['quantity']){
                        $_SESSION['danger']='Số lượng yêu cầu không có sẵn';
                        return;
                    }

                    $product->decreaseQuantity($_POST['idProduct'], $quantity);
                }

                if($_POST['quantity'] < $_POST['presentQty']) {
                    $quantity = $_POST['presentQty'] - $_POST['quantity'];
                    $product->increaseQuantity($_POST['idProduct'], $quantity);

                }

                $cart = new CartResourceModel();
                $cart->updateCart($_POST['idProduct'], $_POST['quantity']);
                header("location: cart.php");
            }
        }
    }