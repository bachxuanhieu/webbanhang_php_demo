<?php

class UserController extends AuthController
{
    private $userModel;
    private $homeModel;
    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->userModel = new UserModel;

        $this->loadModel('HomeModel');
        $this->homeModel = new HomeModel;

        parent::__construct();
    }


    public function index()
    {
        $this->login();
    }
    public function login()
    {

        $data['category'] = $this->homeModel->getCategory();
        $data['setting'] = $this->homeModel->getSetting();

        $this->view('layout/header', $data);
        // Session::init();
        $this->view('user.login');
        $this->view('layout.footer', $data);
    }

    public function login_user()
    {
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $count = $this->userModel->login($email, $password);

        if ($count == 0) {
            $message['msg'] = "Email hoặc pass word nhập sai";
            header('Location:' . BASE_URL . "/user?msg=" . urlencode(serialize($message)));
        } else {

            $result = $this->userModel->getLogin($email, $password);

            $userData = $result;


            Session::init();
            Session::set('users', true);
            Session::set('users', $userData);


            $message['msg'] = "Đăng nhập thành công";
            header('Location:' . BASE_URL . "/home?msg=" . urlencode(serialize($message)));
        }
    }

    public function logout()
    {
        Session::init();
        Session::destroy();
        $message['msg'] = "Đăng xuất thàng công thành công";
        header('Location:' . BASE_URL . "/user?msg=" . urlencode(serialize($message)));
    }

    public function register()
    {

        $data['category'] = $this->homeModel->getCategory();
        $data['setting'] = $this->homeModel->getSetting();

        $this->view('layout/header', $data);
        // Session::init();
        $this->view('user.register');
        $this->view('layout.footer', $data);
    }

    public function insert_user()
    {
        $name = $_POST['txtname'];
        $email = $_POST['txtemail'];
        $phone = $_POST['txtphone'];
        $address = $_POST['txtaddress'];
        $password = $_POST['txtpassword'];
        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu
        $existingUser = $this->userModel->getUserByUsernameOrEmail($email);

        if ($existingUser) {
            $message['msg'] = "Email đã sử dụng";
            header('Location:' . BASE_URL . "/user/register?msg=" . urlencode(serialize($message)));
            return;
        } else {
            $data = array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'password' => md5($password),
            );

            $result = $this->userModel->insertUser($data);
            if ($result == 1) {
                $message['msg'] = "Đăng ký thành công";
                header('Location:' . BASE_URL . "/user?msg=" . urlencode(serialize($message)));
            } else {
                $message['msg'] = "Đăng ký thất bại";
                header('Location:' . BASE_URL . "/user/register?msg=" . urlencode(serialize($message)));
            }
        }

    }

    public function forgetPassword()
    {
        $data['category'] = $this->homeModel->getCategory();
        $data['setting'] = $this->homeModel->getSetting();

        $this->view('layout/header', $data);
        // Session::init();
        $this->view('user.resetPassword');
        $this->view('layout.footer', $data);
    }


    public function resetPassword()
    {
        $email = $_POST['email'];

        $existingUser = $this->userModel->getUserByUsernameOrEmail($email);

        if ($existingUser) {
            $password = substr(md5(rand(0, 9999999)), 0, 8);
            $data = [
                'password' => $password,
            ];
            $cond = "email='$email'";
            $result = $this->userModel->updateUser($data, $cond);
            if ($result) {
                // echo (require "PHPMailer-master/src/PHPMailer.php");
                if ($this->SendMail($email,$password)) {

                    $response = [
                        'status' => 'success',
                        'message' => 'Bạn đã gửi mail thanh công'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Lỗi khi tiến hành gửi mail',
                      
                    ];
                }

            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Lỗi khi cập nhật mật khẩu'
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Không tìm thấy người dùng với email này'
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function SendMail($email,$password)
    {
        include "PHPMailer-master/src/PHPMailer.php"; 
        include "PHPMailer-master/src/SMTP.php"; 
        include 'PHPMailer-master/src/Exception.php'; 
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
        try {
            $mail->SMTPDebug = 0; //0,1,2: chế độ debug
            $mail->isSMTP();  
            $mail->CharSet = "utf-8";
            $mail->Host = 'smtp.gfg.com';  //SMTP servers
            $mail->SMTPAuth = true; // Enable authentication
            $mail->Username = 'hieucoganglen@gmail.com'; // SMTP username
            $mail->Password = '01656431624';   // SMTP password
            $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
            $mail->Port = 587;  // port to connect to                
            $mail->setFrom('hieucoganglen@gmail.com', 'Hieu' ); 
            $mail->addAddress($email, 'Recipient Name'); 
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Mật khẩu mới!';
            $noidungthu = "$password"; 
            $mail->Body = $noidungthu;
            $mail->smtpConnect( array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            ));
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    


}