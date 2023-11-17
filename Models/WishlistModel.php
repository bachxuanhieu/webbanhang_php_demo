<?php


class WishlistModel extends AuthModel
{
    protected $table ='tbl_wishlists';

    protected $table_product = 'tbl_product';
  
    

   
       public function insertWishlist($data){
        return $this->insert($this->table,$data);
        }

        public function getProduct($userId){
            $sql = "SELECT * FROM $this->table_product 
                    WHERE id_product IN (
                        SELECT product_id FROM $this->table WHERE user_id = '$userId'
                    )";
            return $this->select($sql);
        }
        public function checkProductInWishlist($userId, $productId) {
            $sql = "SELECT * FROM $this->table 
                    WHERE user_id = '$userId' 
                    AND product_id = '$productId'";
            return $this->select($sql);
        }

   

        // Xóa sản phẩm khỏi danh sách yêu thích
        public function removeWishlist($userId, $productId) {
            $cond = "$this->table.user_id = '$userId' AND $this->table.product_id = '$productId'";
            return $this->delete($this->table, $cond);
        }

        public function productAll()
        {
            $sql="SELECT * FROM $this->table ORDER BY $this->table.id_wishlist";
         
            return $this->select($sql);
        }
   
}