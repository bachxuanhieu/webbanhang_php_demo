<?php

class OrderController extends BaseController
{
    private $orderModel;

    public function __construct()
    {
        $this->loadModel('OrderModel');
        $this->orderModel = new OrderModel;
        parent:: __construct();
    }

    public function index(){

        Session::checkSession();
        
        $data['orders'] = $this->orderModel->getallOrder();


        $this->view('layout.header');


        $this->view('order.index',$data);

        $this->view('layout.footer');

    }

    public function order_details($order_code){
        // $ordermodel= $this->loadModel('ordermodel');
        // $table_order_details ='tbl_order_details';
        // $table_product= "tbl_product";
        
        $cond = "order_code='$order_code'"; 
       
    
        $data['order_details']= $this->orderModel->list_order_details($cond);
        $data['order_info']= $this->orderModel->list_info($cond);

        $data['order']= $this->orderModel->getOrderCode($cond);

        $this->view('layout/header');
        $this->view('order/order_detail',$data);
        $this->view('layout/footer');
    }
    public function order_confirm($orderCode){
        $cond = "order_code='$orderCode'";
        $data= array(
            'order_status' => 1,
        );
        $result= $this->orderModel->order_confirm($data,$cond);
        if($result){
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        }
    }

   public function searchOrder(){
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['keyword'])) {
        // Lấy từ khóa tìm kiếm từ request
        $keyword = $_GET['keyword'];

        // Gọi phương thức tìm kiếm trong model (chú ý cần import NewdtModel và DatabaseConnection)
    
        $results = $this->orderModel->searchOrder($keyword);
        

        // Trả về kết quả dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'orders' => $results]);
        exit();
    }
   }
   public function deleteOrder(){
    $order_code = $_POST['order_code'];
    $cond = "order_code = '$order_code'";

    $result = $this->orderModel->delete_Order($cond);

    $result1= $this->orderModel->delete_OrderDetail($cond);

    if ($result && $result1) {
        $response = [
            'status' => 'true',
            'message' => 'Xóa đơn hàng thành công',
        ];
     
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Xóa đơn hàng thất bại',
        ];
    }
    echo json_encode($response);
   }

   public function filterOrdersByDate() {
        
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];
            $startDateWithTime = $startDate .' 00:00:00';
            $endDateWithTime = $endDate . ' 23:59:59';

            $results = $this->orderModel->filterOrdersByDate($startDateWithTime, $endDateWithTime);

            // echo $results;
            if ($results) {
                $response = [
                    'status' => 'true',
                    'orders' => $results,
                ];
             
            } else {
                $response = [
                    'status' => 'error',
                    'orders' => "",
                ];
            }
            echo json_encode($response);
      

        
    }

}