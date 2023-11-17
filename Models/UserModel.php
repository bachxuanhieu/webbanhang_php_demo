<?php


class UserModel extends AuthModel
{
    protected $table ='tbl_users';
  
    

    public function login($email,$password){
        $sql = "SELECT * FROM $this->table WHERE $this->table.email='$email' AND $this->table.password='$password'";
        $result = $this->connect->query($sql);

        if ($result) {
            if ($result->num_rows > 0) { 
                return true;
            }
        }

        return false;
    }
       public function getLogin($email,$password){
        $sql = "SELECT * FROM $this->table WHERE $this->table.email='$email' AND $this->table.password='$password'";
        $result = $this->connect->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                return $result->fetch_assoc(); 
            }
        }

        return false;
    }
    public function getNamebyID($userId){
        $sql = "SELECT * FROM $this->table WHERE $this->table.id_user=$userId";
        return $this->select($sql);
    }
    public function getName(){
        $sql = "SELECT * FROM $this->table";
        return $this->select($sql);
    }
    public function getUserByUsernameOrEmail($email) {
        $sql = "SELECT * FROM $this->table WHERE  $this->table.email = '$email'";
        $result = $this->connect()->query($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }



    public function insertUser($data){
        return $this->insert($this->table,$data);
    }

    public function updateUser($data,$cond){
        return $this->update($this->table,$data,$cond);
    }
    
    
}