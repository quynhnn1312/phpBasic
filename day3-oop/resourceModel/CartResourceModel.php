<?php
    include_once('../database/File.php');
    class CartResourceModel{
        public $fileName = "./data/cart.csv";
        private $flag = false;

        public function saveCart($dataCart=[]) {
            if($dataCart != []){
                $file = new File($this->fileName);
                $carts = $file->readFromFile();

                foreach ($carts as &$cart) {
                    if($cart['idProduct'] === $dataCart['idProduct']) {
                        $cart['quantity'] += $dataCart['quantity'];
                        $this->flag = true;
                        break;
                    }
                }
                if($this->flag === false){
                    $file->saveToFile($dataCart);
                }else{
                    $header = 'idProduct|quantity';
                    $file->updateFile($carts, $header);
                }
            }
        }

        public function removeItemCart($itemId = '') {
            if($itemId != ''){
                $file = new File($this->fileName);
                $carts = $file->readFromFile();
                unset($carts[$itemId]);
                $header = 'idProduct|quantity';
                $file->updateFile($carts, $header);

            }
        }

        public function updateCart($idProduct, $quantity) {
            $file = new File($this->fileName);
            $carts = $file->readFromFile();
            foreach ($carts as &$cart) {
                if($cart['idProduct'] === $idProduct){
                    $cart['quantity'] = $quantity;
                    break;
                }
            }

            $header = 'idProduct|quantity';
            $file->updateFile($carts, $header);
        }

        public function loadAllCart() {
            $file = new File($this->fileName);
            return $file->readFromFile();
        }
    }