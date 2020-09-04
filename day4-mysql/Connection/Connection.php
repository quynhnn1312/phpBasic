<?php

namespace Connection;

class Connection
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    public $connect;

    public function __construct()
    {
        //Todo
        // Khởi tạo connection dựa vào các tham số lấy từ file config
        // Kiểm tra nếu khỏi tạo lỗi thì sẽ throw lỗi

        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "Quynh@_123";
        $this->dbname = "day4_mysql";

        $this->connect = new \mysqli($this->servername, $this->username, $this->password, $this->dbname);
        mysqli_set_charset($this->connect, 'utf8');

        if (!$this->connect) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
}