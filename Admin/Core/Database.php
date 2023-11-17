<?php
class Database {

const HOST = "localhost";
const USERNAME = "root";
const PASSWORD = "";
const DB_NAME = "php_demo";

public function connect() {
    $connect = new mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DB_NAME);

    if ($connect->connect_errno === 0) {
        mysqli_set_charset($connect, 'utf8');
        return $connect;
    } else {
        return false;
    }
}
}
