<?php


class CategoryModel extends BaseModel
{
    protected $table ='tbl_category_product';
    protected $table_brands ='tbl_brands';
    public function getallCategory(){
        return $this->getall($this->table);
    }
    public function brandCategory(){
        $sql = "SELECT * FROM $this->table_brands, $this->table where $this->table.id_category_product =  $this->table_brands.id_category_product AND $this->table_brands.status=0";
        return $this->select($sql);
    }

    public function category(){
        $sql = "SELECT * FROM $this->table where $this->table.status = 0 ORDER BY id_category_product DESC";
        return $this->select($sql);
    }

    public function GetCategoryById($cond){
        $sql = "SELECT * FROM $this->table where $cond";
        return $this->select($sql);
    }

    public function hiddencategory(){
        $sql = "SELECT * FROM $this->table where $this->table.status = 1 ORDER BY id_category_product DESC";
        return $this->select($sql);
    }
    
    public function countRows(){
        return $this->count($this->table);
    }
    

    public function insertCategory($data){
        return $this->insert($this->table,$data);
    }
    public function deleteCategory($cond){
        return $this->delete($this->table,$cond);
    }

    public function categoryByid($cond) {
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
    public function getCategory($title) {
        $sql = "SELECT * FROM $this->table WHERE  $this->table.title_category_product = '$title'";
        $result = $this->connect()->query($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    
    public function updateCategory($data,$cond){
        return $this->update($this->table,$data,$cond);
    }
    

    public function searchcategory($keyword){
        $keyword = '%' . $keyword . '%';
        $sql = "SELECT * FROM $this->table WHERE $this->table.title_category_product LIKE ? ";
    
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