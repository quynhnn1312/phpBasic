<?php
    session_start();

    function getAllProduct($file) {
        $products = [];
        if(file_exists($file)) {
            $r = fopen($file, "r");
            while (!feof($r)){
                $row = fgets($r);
                if(!empty($row)) {
                    $products[] = explode("|| ", $row);
                }
            }
        }
        return $products;
    }

    function createProduct($file, $data) {
        if(file_exists($file) && $data){
            $string = implode("|| ",$data);

            $a = fopen($file, "a");
            fgets(fopen($file, "r")) ? fwrite($a, PHP_EOL. $string) : fwrite($a, $string);
            fclose($a);

            header("location:index.php");
            $_SESSION['success']='Thêm mới thành công';
        }
    }

    function getProductById($file, $id) {
        $data = @file($file);
        foreach ($data as $key => $value) {
            if($key == $id){
                return $product[] = explode("|| ", $value);
            }
        }
    }

    function search($data,$keyword) {
        foreach ($data as $value) {
            $newValue = strtolower($value);
            $keyword = strtolower(trim($keyword," "));

            $array = explode("|| ",$newValue);
            array_pop($array);
            $array = implode("|| ",$array);
            if(strpos($array, $keyword) !== false){
                $product[] = explode("|| ", $value);
            }
        }
        return $product;
    }