<?php

class Session {
    public static function init(){
        session_start();
    }

    public static function set($key, $val){
        $_SESSION[$key] = $val;
    }

    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function checkSession(){
        self::init();
        if(self::get('login')==false){
            self::destroy(); // Đã sửa lỗi "sefl" thành "self"
            header("Location:http://localhost/demo/admin/login");
            exit(); // Thêm lệnh exit để dừng việc thực hiện sau khi chuyển hướng
        }
    }

    public static function destroy(){
        session_destroy();
    }

    public static function unsetKey($key){ // Sửa tên phương thức "unset" thành "unsetKey" để tránh xung đột với hàm unset()
        unset($_SESSION[$key]);
    }
}
