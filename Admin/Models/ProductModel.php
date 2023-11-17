<?php


class ProductModel extends BaseModel
{
    protected $table ='tbl_product';
    protected $table_image ='tbl_product_images';
    protected $table_color ='tbl_product_color';
  
    protected $table_category ='tbl_category_product';
    public function getallProduct(){
        return $this->getall($this->table);
    }
    public function getProductImages(){
        return $this->getall($this->table_image);
    }
    public function getColors(){
        return $this->getall($this->table_color);
    }
    public function getColorById($id){
        $sql="SELECT * FROM $this->table_color WHERE $this->table_color.product_id = $id";
        return $this->select($sql);
    }
    public function getProductColor($id, $colorId){
        $sql="SELECT * FROM $this->table_color WHERE $this->table_color.product_id = $id AND $this->table_color.color_id = $colorId";
        return $this->select($sql);
    }
    public function getProductColorCond($cond){
        $sql="SELECT * FROM $this->table_color WHERE $cond";
        return $this->select($sql);
    }
    public function checkColorExists($cond){
        $sql="SELECT * FROM $this->table_color WHERE $cond";
        return $this->select($sql);
    }
    public function updateProductColor($colorData,$cond2){
        return $this->update($this->table_color,$colorData,$cond2);
    }
    public function getProductdImages($id){
        $sql="SELECT * FROM $this->table_image WHERE $this->table_image.id_product = $id";
        return $this->select($sql);
    }
    public function insertProduct($data){
        return $this->insert($this->table,$data);
       
    }
    public function insertImageProduct($imageData){
        return $this->insert($this->table_image,$imageData);
    }
    public function insertGetProduct($data){
        return $this->insertGetId($this->table,$data);
       
    }

    public function insertProductColor($colorData){
        return $this->insert($this->table_color,$colorData);
    }

    public function deleteColorProduct($cond){
        return $this->delete($this->table_color,$cond);
    }


   

    public function product(){
        $sql="SELECT * FROM $this->table,$this->table_category WHERE $this->table.id_category_product = $this->table_category.id_category_product  ORDER BY $this->table.id_product DESC";
        return $this->select($sql);
        
    }
    public function deleteProduct($cond){
        return $this->delete($this->table,$cond);
    }
    public function deleteImage($cond){
        return $this->delete($this->table_image,$cond);
    }
    public function deleteColor($cond2){
        return $this->delete($this->table_color,$cond2);
    }
    public function productByid($cond) {
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
    public function updateProduct($data,$cond){
        return $this->update($this->table,$data,$cond);
    }
    public function countRows(){
        return $this->count($this->table);
    }

    public function productPage($sp_tungtrang,$tung_trang)
    {
        $sql="SELECT * FROM $this->table,$this->table_category WHERE $this->table.id_category_product = $this->table_category.id_category_product AND $this->table.status = 0  ORDER BY $this->table.id_product DESC  LIMIT $tung_trang,$sp_tungtrang";
        return $this->select($sql);
    }
    public function hiddenProduct(){
        $sql="SELECT * FROM $this->table,$this->table_category WHERE $this->table.id_category_product = $this->table_category.id_category_product AND $this->table.status = 1  ORDER BY $this->table.id_product DESC";
        return $this->select($sql);
    }
    public function searchProduct($keyword) {
        $keyword = '%' . $keyword . '%';
        $sql = "SELECT * FROM $this->table, $this->table_category WHERE $this->table.title_product LIKE ? AND $this->table.id_category_product=$this->table_category.id_category_product";
    
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