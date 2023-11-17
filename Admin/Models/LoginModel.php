<?php

class LoginModel extends BaseModel
{
    protected $table ='tbl_admin';
    
    public function login($username, $password) {
        $sql = "SELECT * FROM $this->table WHERE username='$username' AND password='$password'";
        $result = $this->connect->query($sql);

        if ($result) {
            if ($result->num_rows > 0) { 
                return true;
            }
        }

        return false;
    }

    public function getLogin($username, $password) {
        $sql = "SELECT * FROM $this->table WHERE username='$username' AND password='$password'";
        $result = $this->connect->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                return $result->fetch_assoc(); // Sửa từ fetchAssoc() thành fetch_assoc()
            }
        }

        return false;
    }
}
