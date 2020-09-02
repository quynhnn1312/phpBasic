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

        public function addToCart ($idProduct, $quantity) {
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

        public function removeItem() {
            if(isset($_GET['idItem']) && isset($_GET['quantity']) && isset($_GET['idProduct'])) {
                // decrease quantity Product
                $pro = new Product();
                $pro->increaseQuantity($_GET['idProduct'], $_GET['quantity']);

                // remove item cart
                $cart = new CartResourceModel();
                $cart->updateCart($_GET['idItem']);

                header("location: cart.php");
            }
        }
    }