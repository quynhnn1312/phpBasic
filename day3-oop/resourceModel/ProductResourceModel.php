<?php
    include_once('../database/File.php');
    class ProductResourceModel{
        public $fileName = "./data/product.csv";

        public function saveProduct($dataProduct=[]) {
            if($dataProduct != []){
                $file = new File($this->fileName);
                $file->saveToFile($dataProduct);
            }
        }

        public function updateProduct($dataProduct=[]) {
            if($dataProduct != []){
                $file = new File($this->fileName);
                $header = 'sku|name|price|quantity|size|color|image';
                $file->updateFile($dataProduct, $header);
            }
        }

        public function loadProduct($id) {
            if($id != ""){
                $id = (int)$id;
                $file = new File($this->fileName);
                $products = $file->readFromFile();
                foreach ($products as $key => $product) {
                    if($id === $key){
                        return $product;
                    }
                }
            }
        }

        public function loadAllProduct() {
            $file = new File($this->fileName);
            return $file->readFromFile();
        }
    }