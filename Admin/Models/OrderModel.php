<?php


class OrderModel extends BaseModel
{
    protected $table ='tbl_orders';
    protected $table_order ='tbl_order_details';
    protected $table_product ='tbl_product';

    public function delete_Order($cond){
        return $this->delete($this->table,$cond);
    }

    public function filterOrdersByDate($startDateWithTime,$endDateWithTime){
        $sql = "SELECT * FROM $this->table WHERE $this->table.order_date BETWEEN '$startDateWithTime' AND '$endDateWithTime' LIMIT 0, 25";
        return $this->select($sql);
    }
    public function delete_OrderDetail($cond){
        return $this->delete($this->table_order,$cond);
    }
    public function getallOrder(){
        $sql = "SELECT * FROM $this->table ORDER BY $this->table.order_id DESC";
        return $this->select($sql);
    }
    public function getOrderCode($cond){
        $sql = "SELECT * FROM $this->table WHERE $cond ";
        return $this->select($sql);
    }
    public function list_order_details($cond){
        $sql="SELECT * FROM $this->table_order,$this->table_product where $cond AND $this->table_product.id_product = $this->table_order.product_id";
        return $this->select($sql);
      
    }

    public function list_info($cond){
        $sql="SELECT * FROM $this->table_order where $cond limit 1";
        return $this->select($sql);
      }

      public function order_confirm($data,$cond){
        return $this->update($this->table,$data,$cond);
      }
      public function countRows(){
        return $this->count($this->table);
    }
    public function countRows1(){
        return $this->count($this->table_order);
    }
    public function searchOrder($keyword){
        $keyword = '%' . $keyword . '%';
        $sql = "SELECT * FROM $this->table WHERE $this->table.order_code LIKE ?";
    
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