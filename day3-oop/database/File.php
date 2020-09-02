<?php
    class File{
        private $fileName;
        private $fileHeader;
        private $data = [];

        public function __construct($fileName = ''){
            if($fileName !='') {
                $this->fileName = $fileName;
            }
        }

        public function saveToFile($data) {
            if(file_exists($this->fileName) && $data){
                $string = implode("|",$data);
                $a = fopen($this->fileName, "a");
                fwrite($a, PHP_EOL. $string);
                fclose($a);
            }
        }

        public function updateFile($data, $string) {
            if(file_exists($this->fileName)){
                foreach ($data as $value) {
                    $string .= PHP_EOL.implode("|",$value);
                }
                $w = fopen($this->fileName, "w");
                fwrite($w,$string);
                fclose($w);
            }
        }

        public function readFromFile() {
            $file = fopen($this->fileName,'r');
            while(!feof($file)) {
                $row = fgetcsv($file,0,'|');
                if(!$this->fileHeader) {
                    $this->fileHeader = $row;
                }
                else {
                    $this->data[] = array_combine($this->fileHeader,$row);
                }
            }

            fclose($file);
            return $this->data;
        }
    }
