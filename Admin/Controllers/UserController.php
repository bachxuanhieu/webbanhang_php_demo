<?php

class UserController extends BaseController
{
    
    private $userModel;
    private $categoryModel;
    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->userModel = new UserModel;


        $this->loadModel('CategoryModel');
        $this->categoryModel = new CategoryModel;
        parent:: __construct();
    }

    public function index(){
        $this->listuser();
     }
    
    public function listuser(){
        Session::checkSession();
        $data['users'] = $this->userModel->getallUser();
        $this->view('layout.header');
        $this->view('user.index',$data);
        $this->view('layout.footer');
    }
    public function add_user(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $address = $_POST['address'];

            $existingUser = $this->userModel->getUserByUsernameOrEmail($email);
            $existingPhone = $this->userModel->getUserByUserPhone($phone);
            
        

            if($existingUser){
               
                $response = [
                    'success' => false,
                    'message' => 'Email đã sử dụng.'
                ];
                
                echo json_encode($response);
                exit;
            }elseif($existingPhone){
                $response = [
                    'success' => false,
                    'message' => 'Số điện thoại đã sử dụng.'
                ];
                
                echo json_encode($response);
                exit;
            }
            else{
                $data = array(
                    'name' => $name,
                    'phone' => $phone,
                    'email' => $email,
                    'password' => md5($password),
                    'address' => $address,
                );
            };
            $result = $this->userModel->insertUser($data); 

            if($result){
                header('Content-Type: application/json');
                echo json_encode(['success' => true]);
                exit;
            }
        }
    }
    public function deleteUser(){
        $userId = $_POST['userId'];
        $cond = "id_user='$userId'";
    
        $result = $this->userModel->deleteUser($cond); 
     
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

    public function get_user($userId) {
        try {
            // Thực hiện truy vấn cơ sở dữ liệu để lấy thông tin người dùng với $user_id
            $user = $this->userModel->getUserById($userId);
    
            if ($user) {
                $response = [
                    'success' => true,
                    'user' => $user,
                ];
                // Trả về dữ liệu dưới dạng JSON
                echo json_encode($response);
            } else {
                // Trả về mã lỗi HTTP 404 - Không tìm thấy (Not Found)
                http_response_code(404);
                $response = [
                    'success' => false,
                    'message' => 'Người dùng không tồn tại.',
                ];
                // Trả về thông báo lỗi dưới dạng JSON
                echo json_encode($response);
            }
        } catch (Exception $e) {
            // Xử lý lỗi nếu có lỗi truy vấn cơ sở dữ liệu hoặc lỗi khác
            // Trả về mã lỗi HTTP 500 - Lỗi máy chủ nếu có lỗi xảy ra
            http_response_code(500);
            $response = [
                'success' => false,
                'message' => 'Lỗi máy chủ: ' . $e->getMessage(),
            ];
            // Trả về thông báo lỗi dưới dạng JSON
            echo json_encode($response);
        }
    }
    public function update_user(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
          
    
            if($password===""){
                $data = [
                    'name' => $name,
                    'phone' => $phone,
                    'email' => $email,
                    'id_user' => $id
                ];
            }else{
                $data = [
                    'name' => $name,
                    'phone' => $phone,
                    'email' => $email,
                    'password' =>md5($password),
                    'id_user' => $id
                ];
            }
          
            $cond="id_user='$id'";
    
            // Thực hiện cập nhật thông tin người dùng
            $result = $this->userModel->updateUser($data,$cond); 
            
            $users = $this->userModel->getallUser();
            
            if ($result) {

                $message = "Cap nhat thong tin nguoi dung thanh cong.";
                header('Content-Type: application/json');
                $response = ['success' => true,'users'=>$users, 'message' => $message];
                echo json_encode($response);
                exit;
            } else {
                $message = "Lỗi khi cập nhật thông tin người dùng.";
                $response = ['success' => false, 'message' => $message];
                echo json_encode($response);
                exit;
            }
        }
    }

    public function searchUser(){
        if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['keyword'])){
            $keyword = $_GET['keyword'];
            $results = $this->userModel->searchUser($keyword);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'users' => $results]);
            exit();
        }
    }

    

    
    
}