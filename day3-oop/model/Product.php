<?php
    session_start();
    include_once ("../resourceModel/ProductResourceModel.php");
    class Product{
        private $sku ,$name, $price, $quantity, $size, $color, $image;

        public function __construct($values=[]){
            $this->sku = $values['sku'] ?? '';
            $this->name = $values['name'] ?? '';
            $this->price = $values['price'] ?? '';
            $this->quantity = $values['quantity'] ?? '';
            $this->size = $values['size'] ?? '';
            $this->color = $values['color'] ?? '';
            $this->image = $values['image'] ?? '';
        }

        public function price() {
            return "$" . number_format($this->price,2);
        }

        // set variable
        public function setSku($sku) {
            $this->sku = $sku;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function setPrice($price) {
            $this->price = $price;
        }

        public function setQuantity($quantity) {
            $this->quantity = $quantity;
        }

        public function setSize($size) {
            $this->size = $size;
        }

        public function setColor($color) {
            $this->color = $color;
        }

        public function setImage($image) {
            $this->image = $image;
        }

        // get variable
        public function getSku() {
            return $this->sku;
        }

        public function getName() {
            return $this->name;
        }

        public function getPrice() {
            return $this->price;
        }

        public function getQuantity() {
            return $this->quantity;
        }

        public function getSize() {
            return $this->size;
        }

        public function getColor() {
            return $this->color;
        }

        public function getImage() {
            return $this->image;
        }

        public function decreaseQuantity($idProduct, $quantity) {
            $file = new ProductResourceModel();
            $products = $file->loadAllProduct();
            foreach ($products as $key => &$product) {
                if($key == $idProduct) {
                    $product['quantity'] -= $quantity;
                }
            }

            $file->updateProduct($products);
        }


        public function increaseQuantity($idProduct, $quantity) {
            $file = new ProductResourceModel();
            $products = $file->loadAllProduct();
            foreach ($products as $key => &$product) {
                if($key == $idProduct) {
                    $product['quantity'] += $quantity;
                }
            }

            $file->updateProduct($products);
        }

        public function addProduct() {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $microtime = microtime();
                $microtime = str_replace(' ','_',$microtime)  ;
                $microtime = str_replace('.','_',$microtime)  ;

                $feature_image = './public/image/';
                $extension = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
                $feature_image_file = $feature_image . $microtime . '.' . $extension;

                $uploaded1 = move_uploaded_file($_FILES['image']['tmp_name'],$feature_image_file) ;

                $error = [];

                if($_POST['sku'] == NULL){
                    $error['sku'] = "* Please enter the product sku !";
                }
                if($_POST['name'] == NULL){
                    $error['name'] = "* Please enter the product name !";
                }
                if($_POST['price'] == NULL){
                    $error['price'] = "* Please enter the product price !";
                }

                if($_POST['quantity'] == NULL){
                    $error['quantity'] = "* Please enter the product quantity !";
                }

                if($_POST['size'] == NULL){
                    $error['size'] = "* Please enter the product size !";
                }
                if($_POST['color'] == NULL){
                    $error['color'] = "* Please enter the product color !";
                }
                if($uploaded1 == NULL){
                    $error['image'] = "* Please enter the product image !";
                }

                $_POST['image'] = $feature_image_file;

                if(empty($error)){
                    $data = new ProductResourceModel();
                    $data->saveProduct($_POST);
                    $_SESSION['success']='Thêm sản phẩm thành công';
                    header("location: index.php");
                }else{
                    return $error;
                }
            }
        }


    }