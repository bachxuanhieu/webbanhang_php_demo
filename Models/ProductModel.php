<?php


class ProductModel extends AuthModel
{
    protected $table ='tbl_product';
    protected $table_category ='tbl_category_product';
    protected $table_brand ='tbl_brands';
    protected $table_comment ='tbl_comments';
    protected $table_rating ='tbl_ratings';
    protected $table_user ='tbl_users';
    protected $table_image ='tbl_product_images';

    protected $table_color_product ='tbl_product_color';

    protected $table_color ='tbl_colors';

    public function getProductdImages($id){
        $sql="SELECT * FROM $this->table_image WHERE $this->table_image.id_product = $id";
        return $this->select($sql);
    }
    public function updateProductColor($data_product_color,$cond){
        return $this->update($this->table_color_product, $data_product_color,$cond);
    }
    public function getProductColor($productId,$productColorId){
        $sql="SELECT * FROM $this->table_color_product WHERE $this->table_color_product.product_id = $productId AND $this->table_color_product.color_id = $productColorId";
        return $this->select($sql);
    }


    public function productBrand($id){
        $sql="SELECT * FROM $this->table_category,$this->table_brand WHERE $this->table_category.id_category_product = $this->table_brand.id_category_product
        AND $this->table_brand.id_category_product ='$id' order by $this->table_brand.id_brand desc";
        return $this->select($sql);
    }
    public function productCategory($id,$sp_tungtrang,$tung_trang)
    {
        $sql="SELECT * FROM $this->table,$this->table_category WHERE $this->table.id_category_product = $this->table_category.id_category_product
        AND $this->table.id_category_product ='$id' order by $this->table.id_product desc LIMIT $tung_trang,$sp_tungtrang";
     
        return $this->select($sql);
    }
    public function getColor_id($id){
        $sql="SELECT * FROM $this->table_color_product WHERE $this->table_color_product.product_id = $id";
        return $this->select($sql);
    }
    public function getColors(){
        $sql="SELECT * FROM $this->table_color";
        return $this->select($sql);
    }

    public function productBrandName($id_brand, $id)
    {
        $sql = "SELECT * FROM $this->table 
                WHERE id_category_product = '$id' 
                AND brand_product = '$id_brand' 
                ORDER BY id_product DESC";
        return $this->select($sql);
    }

    public function getProductsSortedByPrice( $sortOrder = 'asc',$categoryID)
    {
        $sql = "SELECT * FROM $this->table
                WHERE  $this->table.id_category_product = $categoryID 
                ORDER BY $this->table.selling_product $sortOrder";
        return $this->select($sql);
    } 
   
    public function getProductdetail($id){
        $sql="SELECT * FROM $this->table WHERE $this->table.id_product =$id";
        return $this->select($sql);
    }

    public function getProductSeri($seri_product){
        $sql="SELECT * FROM $this->table WHERE $this->table.seri_product =$seri_product";
        return $this->select($sql);
    }
    

    public function productAll($id)
    {
        $sql="SELECT * FROM $this->table,$this->table_category WHERE $this->table.id_category_product = $this->table_category.id_category_product
        AND $this->table.id_category_product ='$id'";
     
        return $this->select($sql);
    }
    public function insertComment($data){
        return $this->insert($this->table_comment,$data);
    }

    public function insertRating($data){
        return $this->insert($this->table_rating,$data);
    }
    public function getComment($id){

        $sql="SELECT * FROM $this->table_comment WHERE $this->table_comment.product_id =$id limit 5";
            
            return $this->select($sql);
    }
    public function getRating($id){
        $sql="SELECT * FROM $this->table_rating WHERE $this->table_rating.product_id =$id";
            
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
    public function categoryProduct($categoryId){
        $sql="SELECT * FROM $this->table_category where $this->table_category.id_category_product= $categoryId";
        return $this->select($sql);
    }

    
   
}