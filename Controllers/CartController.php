<?php

class CartController extends AuthController
{
    private $homeModel;
    private $productModel;

    private $orderModel;
    private $cartModel;
    private $wishlistModel;




    public function __construct()
    {
        session_start();
        $this->loadModel('HomeModel');
        $this->homeModel = new HomeModel;

        $this->loadModel('WishlistModel');
        $this->wishlistModel = new WishlistModel;

        $this->loadModel('OrderModel');
        $this->orderModel = new OrderModel;


        $this->loadModel('CartModel');
        $this->cartModel = new CartModel;

        $this->loadModel('ProductModel');
        $this->productModel = new ProductModel;

        parent::__construct();
    }
    public function index()
    {
        $this->cartlist();
    }

    public function cartlist()
    {

        Session::init();
        Session::checkSession();

        $userData = Session::getUserData();

        $userId = $userData['id_user'];

        $data['name'] = $userData['name'];
        $data['phone'] = $userData['phone'];
        $data['email'] = $userData['email'];
        $data['address'] = $userData['address'];

        $data['product'] = $this->cartModel->getProduct($userId);

        $data['colors'] = $this->cartModel->getColor();

        $data['color_product'] = $this->cartModel->getColorProduct();
        

        $data['productCart'] = $this->cartModel->productAll();


        $data['category'] = $this->homeModel->getCategory();
        $data['setting'] = $this->homeModel->getSetting();
        $this->view('layout/header', $data);

        $data['provinces'] = $this->cartModel->getProvince();




        $this->view('cart.index', $data);

        $this->view('layout.footer', $data);
    }
    public function getDistrict()
    {
        $province_id = $_GET['province_id'];

        $cond = "province_id='$province_id'";

        $districts = $this->cartModel->getDistricts($cond);
        if ($districts) {
            header('Content-Type: application/json');
            echo json_encode($districts);
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Không có province_id được cung cấp.'));
        }
    }
    public function getWards()
    {
        $district_id = $_GET['district_id'];

        $cond = "district_id='$district_id'";

        $wards = $this->cartModel->getWards($cond);

        if ($wards) {
            header('Content-Type: application/json');
            echo json_encode($wards);
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Không có province_id được cung cấp.'));
        }
    }

    public function update_status()
    {
        $id_cart = $_POST['id_cart'];
        $status = $_POST['status'];
        $cond = "id='$id_cart'";

        $data = array(
            'status' => $status
        );
        $result = $this->cartModel->updateStatus($data, $cond);


    }
    public function addCart()
    {
        $id = $_POST['productId'];
        $colorId = $_POST['colorId'];
        $price_product = $_POST['newPrice'];
        Session::init();
        Session::checkSession();
        
        $userData = Session::getUserData();
        
        if ($userData) {
            $userId = $userData['id_user'];
        }
        
        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng hay chưa
        $existingProduct = $this->cartModel->checkProductInCart($userId, $id);
        
        if ($existingProduct) {
            // Sản phẩm đã tồn tại, kiểm tra màu sắc
            $existingColor = $this->cartModel->checkProductColor($userId, $id, $colorId);

            
            if ($existingColor) {
                // Màu sắc đã tồn tại, tăng số lượng lên 1
                $newQuantity = $existingColor['quanlity'] + 1;
                $updateData = array(
                    'quanlity' => $newQuantity
                );
                $updateResult = $this->cartModel->updateQuantity($userId, $id, $updateData);
                
                if ($updateResult) {
                    $response = [
                        'success' => true,
                    ];
                }
            } else {
                // Màu sắc chưa tồn tại, thêm sản phẩm mới với màu sắc vào giỏ hàng
                $data = array(
                    'user_id' => $userId,
                    'product_color_id' => $colorId,
                    'product_id' => $id,
                    'price_product' => $price_product,
                    'quanlity' => 1
                );
                
                $result = $this->cartModel->insertCart($data);
                
                if ($result == 1) {
                    $response = [
                        'success' => true,
                    ];
                } else {
                    $response = [
                        'success' => false,
                    ];
                }
            }
        } else {
            // Sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm mới với màu sắc vào giỏ hàng
            $data = array(
                'user_id' => $userId,
                'product_color_id' => $colorId,
                'product_id' => $id,
                'price_product' => $price_product,
                'quanlity' => 1
            );
            
            $result = $this->cartModel->insertCart($data);
            
            if ($result == 1) {
                $response = [
                    'success' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                ];
            }
        }
        echo json_encode($response);
    }
    


    public function updateQuanlity()
    {
        Session::init();
        Session::checkSession();

        $userData = Session::getUserData();

        if ($userData) {
            $userId = $userData['id_user'];
        }

        $action = $_POST['action'];

        $productId = $_POST['productId'];

        $productColorId = $_POST['productColorId'];

        $productInfo = $this->productModel->getProductColor($productId,$productColorId);
        if ($productInfo) {
            // Lấy thông tin sản phẩm trong giỏ hàng
            $cartItem = $this->cartModel->checkProductInCart($userId, $productId);

            if ($cartItem) {
                $newQuantity = $cartItem['quanlity'];

                if ($action === 'add') {
                    // Kiểm tra xem số lượng trong giỏ hàng đã vượt quá số lượng sản phẩm tồn kho hay chưa
                    foreach ($productInfo as $pro) {
                        if ($newQuantity + 1 <= $pro['quanlity']) {
                            $newQuantity++;
                        } else {
                            $response = [
                                'status' => 'error',
                                'message' => 'Sản phẩm đã hết hàng'
                            ];
                            echo json_encode($response);
                            return;
                        }
                    }
                } elseif ($action === 'subtract') {
                    if ($newQuantity > 1) {
                        $newQuantity--;
                    }
                }

                // Cập nhật số lượng trong giỏ hàng
                $updateData = ['quanlity' => $newQuantity];
                $result = $this->cartModel->updateQuantity($userId, $productId, $updateData);
                $product = $this->cartModel->getProductCart($productId,$userId);

                foreach ($product as $i) {
                    $newTotal = $i['price_product'] * $newQuantity;
                }
                if ($result) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Cập nhật thành công',
                        'new_quantity' => $newQuantity,
                        'newTotal' => $newTotal,

                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Cập nhật thất bại'
                    ];
                }

                echo json_encode($response);
                return;
            }
        }


        // Trường hợp không có dữ liệu hoặc có lỗi
        $response = [
            'status' => 'error',
            'message' => 'Có lỗi xảy ra khi cập nhật số lượng sản phẩm'
        ];
        echo json_encode($response);
    }

    public function deleteCart()
    {
        Session::init();
        Session::checkSession();

        $userData = Session::getUserData();


        if ($userData) {
            $userId = $userData['id_user'];
        }
        $productId = $_POST['productId'];
        $cond = "product_id='$productId' and user_id='$userId'";
        $result = $this->cartModel->deleteCartItem($cond);

        if ($result) {
            $response = [
                'status' => 'true',
                'message' => 'Xóa sản phẩm thành công',
            ];

        } else {
            $response = [
                'status' => 'error',
                'message' => 'Xóa sản phẩm thất bại',
            ];
        }
        echo json_encode($response);
    }
    // code thanh toan momo :==================================
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    public function orderMomo()
    {
        Session::init();
        Session::checkSession();

        $userData = Session::getUserData();

        if (!$userData) {
            echo "Người dùng chưa đăng nhập";
            return;
        }

        $userId = $userData['id_user'];
        $product = $this->cartModel->getProduct($userId);
        $total = 0;
        foreach ($product as $key => $i) {
            $subtotal = 0;
            $productCart = $this->cartModel->getCartItem();
            foreach ($productCart as $keys => $pro) {
                if ($pro['product_id'] == $i['id_product']) {
                    $subtotal = $pro['quanlity'] * $pro['price_product'];
                    $total += $subtotal;
                }
            }
        }
        if (isset($_POST['payUrl']))
        {
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

            $orderInfo = "Thanh toán qua MoMo";
            $amount = "10000";
            $orderId = rand(0, 9999);
            $redirectUrl = "http://localhost/demo/cart/listorder";
            $ipnUrl = "http://localhost/demo/cart/listorder";
            $extraData = "";


           
                $partnerCode = $partnerCode;
                $accessKey = $accessKey;
                $serectkey = $secretKey;
                $orderId = $orderId; // Mã đơn hàng
                $orderInfo = $orderInfo;
                $amount = $total;
                $ipnUrl = $ipnUrl;
                $redirectUrl = $redirectUrl;
                $extraData = $extraData;

                $requestId = time() . "";
                $requestType = "payWithATM";
                // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
                //before sign HMAC SHA256 signature
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $serectkey);
                $data = array(
                    'partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature
                );
                // ================================================================================================================================================================================
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
    
                $province = $_POST['province'];
                $district = $_POST['district'];
                $wards = $_POST['wards'];
    
                $provinceName = $this->cartModel->getNameProvince($province);
                foreach ($provinceName as $i) {
                    $namePro = $i['name'];
                }
    
                $districtName = $this->cartModel->getNameDistrict($district);
                foreach ($districtName as $i) {
                    $nameDist = $i['name'];
                }
    
    
                $wardsName = $this->cartModel->getNameWards($wards);
                foreach ($wardsName as $i) {
                    $nameWards = $i['name'];
                }
    
    
                $note = $_POST['note'];
                $address = $_POST['address'];
                $order_code = rand(0, 9999);
    
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $order_date = date("Y-m-d H:i:s");
    
                $data_order = array(
                    'order_status' => '2',
                    'user_id' => $userId,
                    'order_code' => $order_code,
                    'order_date' => $order_date,
                );
    
                $result_order = $this->orderModel->insertOrder($data_order);
    
                if ($result_order) {
                    $data['productCart'] = $this->cartModel->getCartItem();
    
                    foreach ($data['productCart'] as $key => $value) {
                        $data_details = array(
                            'order_code' => $order_code,
                            'product_id' => $value['product_id'],
                            'product_color_id' => $value['product_color_id'],
                            'product_quanlity' => $value['quanlity'],
                            'price' => $subtotal,
                            'name' => $name,
                            'phone' => $phone,
                            'email' => $email,
                            'province' => $namePro,
                            'district' => $nameDist,
                            'wards' => $nameWards,
                            'note' => $note,
                            'address' => $address,
                        );
    
                        $result_order_details = $this->orderModel->insert_order_details($data_details);
    
                        if (!$result_order_details) {
                            echo "Lỗi khi thêm chi tiết đơn hàng";
                            return;
                        }
                    }
                    $cond = "id=id AND status=1";
                    $result_delete = $this->cartModel->deleteCartItem($cond);
                }
                


                // =============================================================================================================================================================================
                $result = $this->execPostRequest($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true); // decode json

                //Just a example, please check more in there

                header('Location: ' . $jsonResult['payUrl']); 
        }
        
    }

    public function addOrder(){
        Session::init();
        Session::checkSession();

        $userData = Session::getUserData();

        if (!$userData) {
            echo "Người dùng chưa đăng nhập";
            return;
        }

        $userId = $userData['id_user'];
        $product = $this->cartModel->getProduct($userId);
        $total = 0;
        foreach ($product as $key => $i) {
            $subtotal = 0;
            $productCart = $this->cartModel->getCartItem();
            foreach ($productCart as $keys => $pro) {
                if ($pro['product_id'] == $i['id_product']) {
                    $subtotal = $pro['quanlity'] * $pro['price_product'];
                    $total += $subtotal;
                }
            }
        }

        // $productId = $_POST['productId'];

        // $productColorId = $_POST['productColorId'];

        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $province = $_POST['province'];
        $district = $_POST['district'];
        $wards = $_POST['wards'];

        $provinceName = $this->cartModel->getNameProvince($province);
        foreach ($provinceName as $i) {
            $namePro = $i['name'];
        }

        $districtName = $this->cartModel->getNameDistrict($district);
        foreach ($districtName as $i) {
            $nameDist = $i['name'];
        }


        $wardsName = $this->cartModel->getNameWards($wards);
        foreach ($wardsName as $i) {
            $nameWards = $i['name'];
        }


        $note = $_POST['note'];
        $address = $_POST['address'];
        $order_code = rand(0, 9999);

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order_date = date("Y-m-d H:i:s");

        $data_order = array(
            'order_status' => '0',
            'user_id' => $userId,
            'order_code' => $order_code,
            'order_date' => $order_date,
        );

        $result_order = $this->orderModel->insertOrder($data_order);

        if ($result_order) {
            $data['productCart'] = $this->cartModel->getCartItem();
            foreach ($data['productCart'] as $key => $value) {
                $data_details = array(
                    'order_code' => $order_code,
                    'product_id' => $value['product_id'],
                    'product_color_id' => $value['product_color_id'],
                    'product_quanlity' => $value['quanlity'],
                    'price' => $subtotal,
                    'name' => $name,
                    'phone' => $phone,
                    'email' => $email,
                    'province' => $namePro,
                    'district' => $nameDist,
                    'wards' => $nameWards,
                    'note' => $note,
                    'address' => $address,
                );
                $product_color = $this->productModel->getProductColor($value['product_id'],$value['product_color_id']);

                foreach($product_color as $pro){
                    $quanlity = $pro['quanlity']- $value['quanlity'];
                }
                $data_product_color=[
                    'quanlity' => $quanlity
                ];
                $cond = "product_id='{$value['product_id']}' and color_id = '{$value['product_color_id']}'";

                $this->productModel->updateProductColor($data_product_color,$cond);
            
             
                $result_order_details = $this->orderModel->insert_order_details($data_details);

                if (!$result_order_details) {
                    $response = [
                        'status' => 'error',
                    ];
                }
            }
            $cond = "status=1";
            $result = $this->cartModel->deleteCartItem($cond);
            if ($result) {
                $response = [
                    'status' => 'success',
                ];
             
            } else {
                $response = [
                    'status' => 'error',
                ];
             
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    
    }
 
   

 
    






    public function listorder()
    {
        $data['category'] = $this->homeModel->getCategory();
        $data['setting'] = $this->homeModel->getSetting();

        $this->view('layout/header', $data);

        Session::init();
        Session::checkSession();

        $userData = Session::getUserData();

        $userId = $userData['id_user'];
        if(isset($_GET['partnerCode'])){
            $dataMomo = [
                'user_id' => $userId,
                'partnerCode'=>$_GET['partnerCode'],
                'orderId'=>$_GET['orderId'],
                'requestId'=>$_GET['requestId'],
                'transId'=>$_GET['transId'],
                'amount'=>$_GET['amount'],
                'orderInfo'=>$_GET['orderInfo'],
                'orderType'=>$_GET['orderType'],
                'payType'=>$_GET['payType'],
                'signature'=>$_GET['signature'],
            ];
            $result = $this->cartModel->insertMomo($dataMomo);
            
        }

     
      
        $data['orders'] = $this->cartModel->getOrderID($userId);

        $this->view('cart.order', $data);
        $this->view('layout.footer', $data);
    }

    public function orderdetail($order_code)
    {
        Session::init();
        Session::checkSession();

        $data['category'] = $this->homeModel->getCategory();
        $data['setting'] = $this->homeModel->getSetting();

        $this->view('layout/header', $data);

        $cond = "order_code='$order_code'";
        $data['orderdetail'] = $this->cartModel->getOrderDetail($cond);

        $data['order_details'] = $this->cartModel->list_order_details($cond);

        
        $data['colors'] = $this->cartModel->getColor();

        $data['color_product'] = $this->cartModel->getColorProduct();

        $data['orders'] = $this->cartModel->getOrder($order_code);

        $data['provinces'] = $this->cartModel->getProvince();

        $this->view('cart.orderdetail', $data);
        $this->view('layout.footer', $data);
    }
    public function deletedetail()
    {
        $order_code = $_POST['order_code'];
        $cond_order = "order_code = '$order_code'";
        $result = $this->cartModel->deleteOrder($cond_order);
        $result1 = $this->cartModel->deleteDetails($cond_order);

        if ($result) {
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

    public function edit_info($order_detail_id, $order_code)
    {
        $cond = "order_detail_id='$order_detail_id'";
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        $province = $_POST['province'];
        $district = $_POST['district'];
        $wards = $_POST['wards'];

        $provinceName = $this->cartModel->getNameProvince($province);
        foreach ($provinceName as $i) {
            $namePro = $i['name'];
        }

        $districtName = $this->cartModel->getNameDistrict($district);
        foreach ($districtName as $i) {
            $nameDist = $i['name'];
        }


        $wardsName = $this->cartModel->getNameWards($wards);
        foreach ($wardsName as $i) {
            $nameWards = $i['name'];
        }
        $data = array(
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'province' => $namePro,
            'district' => $nameDist,
            'wards' => $nameWards,
            'address' => $address

        );
        $result = $this->cartModel->updateOrderDetail($data, $cond);

        if ($result) {
            $_SESSION['message'] = "Chỉnh sửa thông tin thành công";
        }
        header('Location:' . BASE_URL . '/cart/orderdetail/' . $order_code);
    }
}