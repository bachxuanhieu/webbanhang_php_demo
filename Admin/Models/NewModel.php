<?php


class NewModel extends BaseModel
{
    protected $table ='tbl_category_post';
    public function getallNew(){
        return $this->getall($this->table);
    }

    public function new(){
        $sql = "SELECT * FROM $this->table where $this->table.status=0 ORDER BY id_category_post DESC";
        return $this->select($sql);
    }
    
    public function hiddenNew(){
        $sql = "SELECT * FROM $this->table where $this->table.status=1 ORDER BY id_category_post DESC";
        return $this->select($sql);
    }
    

    public function insertNew($data){
        return $this->insert($this->table,$data);
    }
    public function deleteNew($cond){
        return $this->delete($this->table,$cond);
    }

    public function newByid($cond) {
        $sql = "SELECT * FROM $this->table WHERE $cond";
        
        $connection = $this->connect();
        if ($connection) {
            $result = mysqli_query($connection, $sql);
            if ($result) {
                $rows = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                }
                return $rows;
            } else {
                // Handle query error here
                return false;
            }
        } else {
            // Handle connection error here
            return false;
        }
    }
    
    public function updateNew($data,$cond){
        return $this->update($this->table,$data,$cond);
    }
    public function countRows(){
        return $this->count($this->table);
    }


    public function searchNew($keyword) {
        $keyword = '%' . $keyword . '%';
        $sql = "SELECT * FROM $this->table WHERE $this->table.title_category_post LIKE ?";
    
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