<?php

class NewdtController extends BaseController
{
    private $newdtModel;
    private $newModel;

    public function __construct()
    {
        $this->loadModel('NewdtModel');
        $this->newdtModel = new NewdtModel;


        $this->loadModel('NewModel');
        $this->newModel = new NewModel;
        parent:: __construct();
    }

    public function index(){
    
        $this->listnewdt();
    }

    public function listnewdt(){
        Session::checkSession();
        // $products = $this->productModel->getallProduct();

        $newdts = $this->newdtModel->newdt();
        $hiddenNewdts = $this->newdtModel->hiddenNewdt();


        $this->view('layout.header');
        $this->view('newdt.index',[
            "newdts"=>$newdts,
            "hiddenNewdts"=>$hiddenNewdts,
        ]);     
        $this->view('layout.footer');   
    }
    public function addnewdt(){
        Session::checkSession();
        $this->view('layout.header');

        $news=$this->newModel->new();
        $this->view('newdt.store',[
            'news'=>$news,
        ]);     
        $this->view('layout.footer');   
    }

    public function insertnewdt(){
        $title= $_POST['title_post'];
        $content= $_POST['content_post'];
      

           //  sử lý hình ảnh
           $image = $_FILES['image_post']['name'];
           $tmp_image = $_FILES['image_post']['tmp_name'];
           $div = explode('.', $image);
           $file_ext = strtolower(end($div));
           $unique_image = $div[0] . time() . '.' . $file_ext;
           $path_uploads = "public/uploads/new/" . $unique_image; 
           
        
        //kết thúc sử lý hình ảnh
        $new= $_POST['category_post'];
        $data=array(
            'title_post'=>$title,
            'content_post'=>$content,
            'image_post'=>$unique_image,
            'id_category_post'=>$new,
        );
        // print_r($data);
        $result = $this->newdtModel->insertNewdt($data);
       
        if($result){
            move_uploaded_file($tmp_image, $path_uploads);
 
            header("Location:".BASE_URL."/admin/newdt");
        }else{
           echo "Thất bại";
        }
    }

    public function deletenewdt($id){
     
        $cond= "id_post='$id'";
       
        $result = $this->newdtModel->deleteNewdt($cond);
        if($result==1){
            $message['msg']="Xóa sản phẩm thành công";
            header("Location:".BASE_URL."/admin/newdt");
        }else{
            $message['msg']="Xóa sản phẩm thất bại";
            header("Location:".BASE_URL."/admin/newdt");
        }
    
    }

    public function editnewdt($id){
        Session::checkSession();

        $cond= "id_post='$id'";
      
        $data['postbyid'] = $this->newdtModel->newdtByid($cond);
        $data['new'] = $this->newModel->new();
    
    
        $this->view('layout.header');
        $this->view('newdt.edit',$data);
        $this->view('layout.footer');
    }

    public function updatenewdt($id){
       
        $category= $_POST['category_post'];
        
        $desc= $_POST['content_post'];
        $cond = "id_post='$id'";
        $title= $_POST['title_post'];
           //  sử lý hình ảnh
           $image = $_FILES['image_post']['name'];
           $tmp_image = $_FILES['image_post']['tmp_name'];
           $div = explode('.', $image);
           $file_ext = strtolower(end($div));
           $unique_image = time() . '.' . $file_ext;
           $path_uploads = "public/uploads/new/" . $unique_image; 
           
    
        //kết thúc sử lý hình ảnh
        if($image){
          
            $data['newdtbyid'] = $this->newdtModel->newdtByid($cond);

            foreach ($data['newdtbyid'] as $key => $value) {
                $path_uploads = "C:/xampp/htdocs/demo/public/uploads/new/"; // Đường dẫn thư mục chứa ảnh cũ
        
                $old_image = $value['image_post'];
                unlink($path_uploads . $old_image);
            }
        
            // Tiếp tục với xử lý cập nhật thông tin
        
            if ($image) {
                $unique_image = time() . '.' . $file_ext;
                $new_image_path = "C:/xampp/htdocs/demo/public/uploads/new/" . $unique_image;
                move_uploaded_file($tmp_image, $new_image_path);
        
                $data = array(
                    'title_post' => $title,
                    'content_post' => $desc,
                    'image_post' => $unique_image,
                    'id_category_post' => $category,
                );
            } else {
                $data = array(
                    'title_post' => $title,
                    'content_post' => $desc,
                    'id_category_post' => $category,
                );
            }
        
            $result = $this->newdtModel->updateNewdt($data, $cond);
            if ($result == 1) {
                header("Location:" . BASE_URL . "/admin/newdt");
            } else {
                echo "lỗi rồi bạn ơi";
            }
        }
    
    }

    public function searchnewdt() {
        // Xử lý request tìm kiếm
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['keyword'])) {
            // Lấy từ khóa tìm kiếm từ request
            $keyword = $_GET['keyword'];

            // Gọi phương thức tìm kiếm trong model (chú ý cần import NewdtModel và DatabaseConnection)
        
            $results = $this->newdtModel->searchNewdt($keyword);

            // Trả về kết quả dưới dạng JSON
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'newdts' => $results]);
            exit();
        }

        // Xử lý các trường hợp khác (nếu cần)
        // ...
    }

    public function toggleStatus($newdtId){
        $cond = "id_post='$newdtId'";
        $data = array(
            'status' => '1',
        );
        $result = $this->newdtModel->updateNewdt($data, $cond);
    
        $newdts = $this->newdtModel->newdt();
        // $hiddenNewdts = $this->newdtModel->hiddenNewdt();
    
        if ($result) {
            if (empty($newdts)) {
                $newdts = []; // Gán một giá trị mặc định nếu $newdts không có dữ liệu
            }
            $response = [
                'success' => true,
                'newdts' => $newdts,
                // 'hiddenNewdts'=> $hiddenNewdts
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    }
    public function toggleShowStatus($newdtId){
        $cond = "id_post='$newdtId'";
        $data = array(
            'status' => '0',
        );
        $result = $this->newdtModel->updateNewdt($data, $cond);
    
        // $newdts = $this->newdtModel->newdt();
        $hiddenNewdts = $this->newdtModel->hiddenNewdt();
    
        if ($result) {
            if (empty($newdts)) {
                $newdts = []; // Gán một giá trị mặc định nếu $newdts không có dữ liệu
            }
            $response = [
                'success' => true,
                // 'newdts' => $newdts,
                'hiddenNewdts'=> $hiddenNewdts
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    }
    

}