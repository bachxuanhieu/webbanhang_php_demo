<?php
class Session {
    public static function init() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $val) {
        $_SESSION[$key] = $val;
    }

    public static function get($key) {
        self::init();
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function checkSession() {
        self::init();
        if (!self::get('users')) {
            self::destroy();
            $message['msg']="Bạn cần đăng nhập trước!!!";
            header("location:".BASE_URL."/user?msg=".urlencode(serialize($message)));
            exit();
        }
    }

    public static function destroy() {
        self::init();
        session_destroy();
    }

    public static function unsetKey($key) {
        self::init();
        unset($_SESSION[$key]);
    }
    public static function getUserData() {
        if (isset($_SESSION['users'])) {
            return $_SESSION['users'];
        }
        return null;
    }
}
