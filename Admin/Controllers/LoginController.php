<?php

class LoginController extends BaseController
{   
    public function __construct(){
        $message=array();
        $data=array();
        $this->loadSession('Session');
        $this->seccsion = new Session;
        $this->loadModel('LoginModel');
        $this->loginModel = new LoginModel;
   }
    public function index(){
       $this->login();
    }

    public function login(){
        Session::init();
        if(Session::get("login")==true){
         header("Location:".BASE_URL."/admin/product");
        }
        $this->view('login.login');
    }


    public function authentioncation_login(){
        $username=$_POST['username'];
        $password=md5($_POST['password']);
       
    
        $count=$this->loginModel->login($username,$password);
    
        if($count==0){
         $message['msg']="User hoặc pass word nhập sai";
         header("Location:".BASE_URL."/admin/login");
        }else{
    
         $result=$this->loginModel->getLogin($username,$password);
         Session::init();
         Session::set('login',true);
         Session::set('username',$result[0]['username']);
         Session::set('userid',$result[0]['admin_id']);
    
      
         header("Location:".BASE_URL."/admin/dashboard");
        }
    }
    public function logout(){
        Session::init();
        Session::destroy();
        header("Location:".BASE_URL."/admin/login");
   }
    
 

}