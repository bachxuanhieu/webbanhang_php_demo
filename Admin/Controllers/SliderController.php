<?php

class SliderController extends BaseController
{
    private $sliderModel;
 

    public function __construct()
    {
        $this->loadModel('SliderModel');
        $this->sliderModel = new SliderModel;

        parent:: __construct();
    }

    public function index(){
    
        $this->listslider();
    }

    public function listslider(){
        $this->view('layout.header');

        $data['sliders']=$this->sliderModel->getallSlider();

        $this->view('slider.index',$data);
        $this->view('layout.footer');
    }

    public function addslider(){
        Session::checkSession();
        $this->view('layout.header');
        $this->view('slider.store');     
        $this->view('layout.footer');  
    }

    public function insertslider(){
        $title= $_POST['title_slider'];
        $desc= $_POST['desc_slider'];
      
        $status= $_POST['status_slider'];

           //  sử lý hình ảnh
           $image = $_FILES['image_slider']['name'];
           $tmp_image = $_FILES['image_slider']['tmp_name'];
           $div = explode('.', $image);
           $file_ext = strtolower(end($div));
           $unique_image = $div[0] . time() . '.' . $file_ext;
           $path_uploads = "public/uploads/slider/" . $unique_image; 
           
    
        //kết thúc sử lý hình ảnh
     
    
        $data=array(
            'title_slider'=>$title,

            'desc_slider'=>$desc,
            
            'status_slider'=>$status,
            
            'image_slider'=>$unique_image,
           
        );
        
        $result = $this->sliderModel->insertSlider($data);
        if($result==1){
            move_uploaded_file($tmp_image, $path_uploads);
        
            $message['msg']="Thêm sản phẩm thành công";
            header("Location:".BASE_URL."/admin/slider");
        }else{
            echo 2;
            $message['msg']="Thêm sản phẩm thất bại";
            header('Location:'.BASE_URL."/admin/slider");
        }
    }

    public function deleteSlider($id){
     
        $cond= "id_slider='$id'";
       
        $result = $this->sliderModel->deleteSlider($cond);
        
        $sliders = $this->sliderModel->getallSlider();
      
        if($result){
            $response = [
                'success' => true,
                'sliders' => $sliders,
                // 'hiddenNewdts'=> $hiddenNewdts
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    
    }
    public function editslider($id){
        Session::checkSession();

        $cond= "id_slider='$id'";
      
       
        $data['sliders'] = $this->sliderModel->sliderId($cond);
    
    
        $this->view('layout.header');
        $this->view('slider.edit',$data);
        $this->view('layout.footer');
    }

    public function updateslider($id) {
        $cond = "id_slider = '$id'";
        $title = $_POST['title_slider'];
        $desc = $_POST['desc_slider'];
      
        $status = $_POST['status_slider'];

    
        // Xử lý hình ảnh
        $image = $_FILES['image_slider']['name'];
        $tmp_image = $_FILES['image_slider']['tmp_name'];
    
        if ($image) {
            $path_uploads = BASE_URL."/public/uploads/slider/"; // Đường dẫn thư mục chứa ảnh cũ
    
            $data['sliderbyid'] = $this->sliderModel->sliderId($cond);
            foreach ($data['sliderbyid'] as $key => $value) {
                $old_image = $value['image_slider'];
                unlink($path_uploads . $old_image);
            }
    
            $div = explode('.', $image);
            $file_ext = strtolower(end($div));
            $unique_image = $div[0] . time() . '.' . $file_ext;
            $new_image_path = $path_uploads . $unique_image;
            move_uploaded_file($tmp_image, $new_image_path);
    
            $data = array(
                'title_slider' => $title,
                'desc_slider' => $desc,
            
                'status_slider'=>$status,
             
                'image_slider' => $unique_image,
              
            );
        } else {
            $data = array(
                'title_slider' => $title,
                'desc_slider' => $desc,
                'status_slider'=>$status,
            );
        }
    
        $result = $this->sliderModel->updateSlider($data, $cond);
        if ($result == 1) {
            header("Location:" . BASE_URL . "/admin/slider");
        } else {
            echo "lỗi rồi bạn ơi";
        }
    }

    public function toggleStatus($sliderId){
        $cond = "id_slider='$sliderId'";
        $slider = $this->sliderModel->sliderId($cond);
        // $newStatus=0;
        // print_r($slider);
        foreach($slider as $keys => $i){
            if($i['status_slider']==0){
                $i['status_slider']=1;
            }else{
                $i['status_slider']=0;
            }
            $newStatus=  $i['status_slider'];
        }
        $data = array(
            'status_slider' => $newStatus
        );
        $result = $this->sliderModel->updateSlider($data, $cond);

        $sliders = $this->sliderModel->getallSlider();
      
        if($result){
            $response = [
                'success' => true,
                'sliders' => $sliders,
                // 'hiddenNewdts'=> $hiddenNewdts
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    }

}