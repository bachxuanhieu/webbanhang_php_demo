<?php

class NewController extends BaseController
{
    
    private $newModel;
    private $categoryModel;
    public function __construct()
    {
        $this->loadModel('NewModel');
        $this->newModel = new NewModel;


        $this->loadModel('CategoryModel');
        $this->categoryModel = new CategoryModel;
        parent:: __construct();
    }

    public function index(){
        $this->listnew();
     }
    
    public function listnew(){
        Session::checkSession();
        $news = $this->newModel->new();
        $hiddenNews = $this->newModel->hiddenNew();
        $this->view('layout.header');
        $this->view('new.index',[
            'news' => $news,
            'hiddenNews' => $hiddenNews
        ]  
    );
        $this->view('layout.footer');
    }

    public function insertnew(){
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST['title_category_post'];
            $desc = $_POST['desc_category_post'];
            $data = array(
                'title_category_post' => $title,
                'desc_category_post' => $desc
            );
    
            $result = $this->newModel->insertNew($data); 
    
            if($result==1){
               
                header('Location:'.BASE_URL."/admin/new");
            }else{
                
                header('Location:'.BASE_URL."/admin/new");
            }
        }
    }
    public function deletenew($newId)
    {   
       
        $cond = "id_category_post='$newId'";
    
        $result = $this->newModel->deleteNew($cond); 
     
        if ($result) {
            $response = [
                'success' => true,
                'message' => 'Xóa danh mục thành công.',
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Xóa danh mục thất bại.',
            ];
        }

        // Trả về dữ liệu dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        
    }

    public function edit_new($id){
        Session::checkSession();
        $table="tbl_category_post";
        $cond= "id_category_post='$id'";
        
        $new = $this->newModel->newByid($cond);


       

        $this->view('layout.header');
   
        $this->view('new.edit',[
            'new'=>$new,
        ]);

        $this->view('layout.footer');
    }



    
    public function updatenew($id){
     
        $cond= "id_category_post='$id'";
        $title= $_POST['title_category_post'];
        $desc= $_POST['desc_category_post'];
        // $id = $_POST['id_category_post'];
        $data=array(
            'title_category_post'=>$title,
            'desc_category_post'=>$desc,
            // 'id_category_post'=>$id
        );
        print_r($data);
        $result = $this->newModel->updateNew($data,$cond);
        if($result){
            echo "1";
            header("Location:".BASE_URL."/admin/new");
        }
        else{
            echo "hãy quay lại, bị lỗi rồi";
        }
    }
    public function toggleStatus($newId){
        $cond="id_category_post='$newId'";
        $data = array(
            'status'=>'1',
        );
        $result = $this->newModel->updateNew($data,$cond);
        if($result){
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        }
    }
    public function toggleStatus2($newId){
        $cond="id_category_post='$newId'";
        $data = array(
            'status'=>'0',
        );
        $result = $this->newModel->updateNew($data,$cond);
        if($result){
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        }
    }

    public function search_new(){
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
       
      
        $data['news'] = $this->newModel->searchNew($keyword);

        $this->view('layout.header');
        $this->view('new.search',$data);     
        $this->view('layout.footer');

    }
    
}