<?php


class CartModel extends AuthModel
{
    protected $table ='tbl_carts';
    protected $table_order ='tbl_orders';
    protected $table_order_detail ='tbl_order_details';
    protected $table_product = 'tbl_product';
    protected $table_momo = 'momo';

    protected $table_province = 'province';

    protected $table_district = 'district';

    protected $table_wards = 'wards';

    protected $table_colors = 'tbl_colors';
    protected $tbl_product_color = 'tbl_product_color';
  
    

   
       public function insertCart($data){
        return $this->insert($this->table,$data);
        }
        public function insertMomo($dataMomo){
            return $this->insert($this->table_momo,$dataMomo);
        }

        public function getCartItem(){
            $sql = "SELECT * FROM $this->table where $this->table.status = 1";
            return $this->select($sql);
        }

        public function getColor(){
            $sql = "SELECT * FROM $this->table_colors where $this->table_colors.status = 0";
            return $this->select($sql);
        }

        public function getColorProduct(){
            $sql = "SELECT * FROM $this->tbl_product_color";
            return $this->select($sql);
        }



        public function getProduct($userId){
            $sql = "SELECT * FROM $this->table_product 
                    WHERE id_product IN (
                        SELECT product_id FROM $this->table WHERE user_id = '$userId'
                    )";
            return $this->select($sql);
        }

        public function getProductCart($productId,$userId){
            $sql = "SELECT * FROM $this->table where $this->table.product_id = $productId and $this->table.user_id = $userId";
            return $this->select($sql);
        }

        public function productAll()
        {
            $sql="SELECT * FROM $this->table ORDER BY $this->table.id";
         
            return $this->select($sql);
        }

        public function getProvince(){
            $sql = "SELECT * FROM $this->table_province ORDER BY $this->table_province.province_id ASC";
            return $this->select($sql);
        }


        public function getNameProvince($province){
            $sql = "SELECT * FROM $this->table_province where $this->table_province.province_id=$province";
            return $this->select($sql);
        }

    

        public function getDistricts($cond){
            $sql="SELECT * FROM $this->table_district WHERE $cond";
            return $this->select($sql);
        }

        public function getNameDistrict($district){
            $sql = "SELECT * FROM $this->table_district where $this->table_district.district_id=$district";
            return $this->select($sql);
        }
        public function getWards($cond){
            $sql="SELECT * FROM $this->table_wards WHERE $cond";
            return $this->select($sql);
        }

        public function getNameWards($wards){
            $sql = "SELECT * FROM $this->table_wards where $this->table_wards.wards_id=$wards";
            return $this->select($sql);
        }

        public function checkProductInCart($userId, $productId) {
            $sql = "SELECT * FROM $this->table WHERE user_id = $userId AND product_id = $productId";
            $result = $this->select($sql);
    
            if ($result && count($result) > 0) {
                return $result[0];
            } else {
                return null;
            }
        }
        public function checkProductColor($userId, $id, $colorId){
            $sql = "SELECT * FROM $this->table WHERE user_id = $userId AND product_id = $id And product_color_id=$colorId";
            $result = $this->select($sql);
    
            if ($result && count($result) > 0) {
                return $result[0];
            } else {
                return null;
            }
        }
    
        public function updateQuantity($userId, $productId, $data) {
            $setValues = '';
            foreach ($data as $key => $value) {
                $setValues .= "$key = '$value',";
            }
            $setValues = rtrim($setValues, ',');
    
            $sql = "UPDATE $this->table SET $setValues WHERE user_id = $userId AND product_id = $productId";
            $result = $this->execute($sql);
    
            return $result;
        }

        public function deleteCartItem($cond) {
            return $this->delete($this->table, $cond);
        }

        public function deleteAllCartItems($cond) {
           
            return $this->delete($this->table,$cond);
        }
        
        
        public function getOrder($order_code){
            $sql="SELECT * FROM $this->table_order WHERE $this->table_order.order_code = $order_code ORDER BY $this->table_order.order_id desc ";
            return $this->select($sql);
        }
        public function getOrderID($userId){
            $sql="SELECT * FROM $this->table_order WHERE $this->table_order.user_id = $userId ORDER BY $this->table_order.order_id desc ";
            return $this->select($sql);
        }
       

        public function  getOrderDetail($cond){
            $sql="SELECT * FROM $this->table_order_detail WHERE $cond Limit 1";
            return $this->select($sql);
        }

        public function list_order_details($cond){
            $sql="SELECT * FROM $this->table_order_detail,$this->table_product where $cond AND $this->table_product.id_product = $this->table_order_detail.product_id";
            return $this->select($sql);
          
        }
        public function deleteOrder($cond_order){
            // Xóa chi tiết đơn hàng từ bảng $this->table_order_detail
           
           return $this->delete($this->table_order, $cond_order);
        
          
        }
        public function deleteDetails($cond_detail){
            // Xóa chi tiết đơn hàng từ bảng $this->table_order_detail
           
           return $this->delete($this->table_order_detail, $cond_detail);
        
          
        }
        public function updateOrderDetail($data,$cond){
            return $this->update($this->table_order_detail,$data,$cond);
        }

        public function updateStatus($data, $cond){
            return $this->update($this->table,$data,$cond);
        }
   
}