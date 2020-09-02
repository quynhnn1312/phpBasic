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

        public function updateCart($itemId = '') {
            if($itemId != ''){
                $file = new File($this->fileName);
                $carts = $file->readFromFile();
                if(count($carts) == 1){
                    $carts = [];
                }else{
                    foreach ($carts as $key => &$cart) {
                        if($cart['idProduct'] == $itemId){
                            array_splice($carts,$key, 1);
                            break;
                        }
                    }
                }

                $header = 'idProduct|quantity';
                $file->updateFile($carts, $header);

            }
        }

        public function loadAllCart() {
            $file = new File($this->fileName);
            return $file->readFromFile();
        }
    }