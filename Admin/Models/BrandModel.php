<?php
class BrandModel extends BaseModel{

    protected $table ='tbl_brands';
    protected $table_category ='tbl_category_product';
    protected $table_product ='tbl_product';


    public function getallBrand(){
        return $this->getall($this->table);
    }
    public function getBrands($cond){
        $sql="SELECT * FROM $this->table WHERE  $cond And $this->table.status=0  ORDER BY $this->table.id_brand DESC";
        return $this->select($sql);
        
    }
    public function brand(){
        $sql="SELECT * FROM $this->table,$this->table_category WHERE  $this->table.id_category_product = $this->table_category.id_category_product And $this->table.status=0  ORDER BY $this->table.id_brand DESC";
        return $this->select($sql);
        
    }
    
    public function hiddenBrand(){
        $sql="SELECT * FROM $this->table,$this->table_category WHERE $this->table.id_category_product = $this->table_category.id_category_product And $this->table.status=1  ORDER BY $this->table.id_brand DESC";
        return $this->select($sql);
        
    }
    public function brandProduct(){
       
        $sql = "SELECT * FROM $this->table ORDER BY id_brand DESC";
        return $this->select($sql);
        
    }

    
    public function brandByid($cond) {
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

    public function updateBrand($data,$cond){
        return $this->update($this->table,$data,$cond);
    }

    public function insertBrand($data){
        return $this->insert($this->table,$data);
       
    }
    public function deleteBrand($cond){
        return $this->delete($this->table,$cond);
    }

    public function searchBrand($keyword) {
        $keyword = '%' . $keyword . '%';
        $sql = "SELECT * FROM $this->table, $this->table_category WHERE $this->table.title_brand LIKE ? AND $this->table.id_category_product=$this->table_category.id_category_product";
    
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

