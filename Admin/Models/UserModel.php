<?php


class UserModel extends BaseModel
{
    protected $table ='tbl_users';
    public function getallUser(){
        return $this->getall($this->table);
    }

    

    public function getUserById($userId){
        $sql = "SELECT * FROM $this->table WHERE  $this->table.id_user = '$userId'";
        return $this->select($sql);
    }

    public function deleteUser($cond){
        return $this->delete($this->table,$cond);
    }
    public function countRows(){
        return $this->count($this->table);
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
    public function getUserByUserPhone($phone) {
        $sql = "SELECT * FROM $this->table WHERE  $this->table.phone = '$phone'";
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
    public function searchUser($keyword){
        $keyword = '%' . $keyword . '%';
        $sql = "SELECT * FROM $this->table WHERE $this->table.name LIKE ?";
    
        // Chuẩn bị truy vấn
        $stmt = $this->connect->prepare($sql);
    
        // Kiểm tra lỗi khi chuẩn bị truy vấn
        if (!$stmt) {
            die("Lỗi khi chuẩn bị truy vấn: " . $this->connect->error);
        }
    
        // Gắn giá trị và kiểu dữ liệu cho biến tham số
        $stmt->bind_param('s', $keyword);
    
        // Thực hiện truy vấn
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $products = array();
    
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
    
            // Đóng kết nối và trả về kết quả   
            $stmt->close();
            $this->connect->close();
    
            return $products;
        } else {
            die("Lỗi khi thực hiện truy vấn: " . $stmt->error);
        }
    }

}