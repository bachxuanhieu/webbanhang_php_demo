<?php

class SettingController extends BaseController
{
    
    private $settingModel;
    public function __construct()
    {
        $this->loadModel('SettingModel');
        $this->settingModel = new SettingModel;


        parent:: __construct();
    }

    public function index(){
        $this->listuser();
     }
    
    public function listuser(){
        Session::checkSession();
        $data['settings']= $this->settingModel->getSetting();
        $this->view('layout.header');
        $this->view('setting.index',$data);
        $this->view('layout.footer');
    }

    public function addsetting(){
        Session::checkSession();
        $this->view('layout.header');
        $this->view('setting.store');
        $this->view('layout.footer');
    }

    public function insertsetting(){
        $name= $_POST['website_name'];
        $url= $_POST['website_url'];
        $phone= $_POST['phone'];
        $email= $_POST['email'];
        $facebook= $_POST['facebook'];
      
        $status= $_POST['status'];

         
    
        $data=array(
            'website_name'=>$name,

            'website_url'=>$url,
            
            'phone'=>$phone,
            
            'email'=>$email,

            'facebook'=>$facebook,

            'status'=>$status
           
        );
        
        $result = $this->settingModel->insertSetiing($data);

        if($result==1){
            $message['msg']="Thêm thông tin thành công";
            header("Location:".BASE_URL."/admin/setting");
        }else{
            echo 2;
            $message['msg']="Thêm thông tin thất bại";
            header('Location:'.BASE_URL."/admin/setting");
        }     
    }
    public function deletecategory($id)
    {   
       
        $cond = "id='$id'";
    
        $result = $this->settingModel->deleteSetting($cond); 
     
        header("Location:".BASE_URL."/admin/setting?success=Xóa+sản+phẩm+thành+công");
        
    }

    public function editsetting($id){
        Session::checkSession();
        $cond= "id='$id'";
       
        $data['setting'] = $this->settingModel->settingByid($cond);


        $this->view('layout.header');
   
        $this->view('setting.edit',$data);

        $this->view('layout.footer');
    }
    public function updatesetting($id){
      
    
        $cond= "id='$id'";
        $name= $_POST['website_name'];
        $url= $_POST['website_url'];
        $phone= $_POST['phone'];
        $email= $_POST['email'];
        $facebook= $_POST['facebook'];
      
        $status= $_POST['status'];

         
    
        $data=array(
            'website_name'=>$name,

            'website_url'=>$url,
            
            'phone'=>$phone,
            
            'email'=>$email,

            'facebook'=>$facebook,

            'status'=>$status
           
        );
           
        
       
        $result = $this->settingModel->updateSetting($data, $cond);
        
        if($result){
            header("Location:".BASE_URL."/admin/setting");
        }
        else{
            echo "0";
        }
    }

   
}