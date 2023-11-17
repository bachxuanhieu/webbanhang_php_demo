<?php


class NewdtModel extends BaseModel
{
    protected $table ='tbl_post';
    protected $table_category ='tbl_category_post';
    public function getallNewdt(){
        return $this->getall($this->table);
    }

    public function insertNewdt($data){
        return $this->insert($this->table,$data);
    }
    public function countRows(){
        return $this->count($this->table);
    }

    public function newdt(){
        $sql="SELECT * FROM $this->table,$this->table_category WHERE $this->table.id_category_post = $this->table_category.id_category_post And $this->table.status=0  ORDER BY $this->table.id_post DESC";
        return $this->select($sql);
    }
    public function  hiddenNewdt(){
        $sql="SELECT * FROM $this->table WHERE $this->table.status=1  ORDER BY $this->table.id_post DESC";
        return $this->select($sql);
    }

    public function deleteNewdt($cond){
        return $this->delete($this->table,$cond);
    }

    public function newdtByid($cond) {
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
    public function updateNewdt($data,$cond){
        return $this->update($this->table,$data,$cond);
    }

    public function searchNewdt($keyword){
        $keyword = '%' . $keyword . '%';
        $sql = "SELECT * FROM $this->table WHERE $this->table.title_post LIKE ?";
    
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