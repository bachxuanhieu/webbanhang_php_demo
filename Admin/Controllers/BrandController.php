<?php

class BrandController extends BaseController
{
    private $brandModel;
    private $categoryModel;

    public function __construct()
    {
        $this->loadModel('BrandModel');
        $this->brandModel = new BrandModel;


        $this->loadModel('CategoryModel');
        $this->categoryModel = new CategoryModel;
        parent:: __construct();
    }
    public function index(){
    
        $this->listbrand();
    }

    public function listbrand(){
        Session::checkSession();
       

        $brands = $this->brandModel->brand();
        $categories=$this->categoryModel->category();
        $hiddenBrands=$this->brandModel->hiddenBrand();
        $this->view('layout.header');
        $this->view('brand.index',[
            "brands"=>$brands,
            "categories"=>$categories,
            'hiddenBrands'=>$hiddenBrands
        ]);     
        $this->view('layout.footer');   
    }
    public function addbrand(){
        if(isset( $_POST['title'])){
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $category_product = $_POST['category_product'];

            $data= array(
                'title_brand'=> $title,
                'desc_brand'=> $desc,
                'id_category_product'=> $category_product,
            );

            $result = $this->brandModel->insertBrand($data);
            if($result){
                header('Content-Type: application/json');
                echo json_encode(['success'=> true]);
                exit;
            }
        }
    }
 
    public function deleteBrand($brandId){
       
        $cond= "id_brand='$brandId'";
        $result = $this->brandModel->deleteBrand($cond);

        if ($result) {
            $response = [
                'success' => true,
                'message' => 'Xóa danh mục thành công.',
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Xóa danh mục không thành công.',
            ];
        }

        // Trả về dữ liệu dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    
    }
    public function editBrand($brandId) {
      
        $cond= "id_brand='$brandId'";
       
        $brand = $this->brandModel->brandByid($cond);
        

        
        if (!$brand) {
            $response = [
                'success' => false,
                'message' => 'Không tìm thấy danh mục.',
            ];
        } else {
            $response = [
                'success' => true,
                'brand' => $brand,
            ];
        }
    
        // Trả về dữ liệu dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function updatebrand(){
        $brandId =$_POST['brandId'];
        $cond = "id_brand='$brandId'";
     
            $title = $_POST['title']; 
            $desc = $_POST['desc']; 
            $category = $_POST['category']; 
    

        $data= array(
            'title_brand' => $title,
            'desc_brand' => $desc,
            'id_category_product' => $category
        );
        $result = $this->brandModel->updateBrand($data,$cond);
        if($result){
            $response = [
                'success' => true
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function toggleStatus($brandId){
       
 
        $cond="id_brand='$brandId'";
      
        $brand = $this->brandModel->brandByid($cond);
        if (!$brand) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Danh mục không tồn tại']);
            exit;
        }


        $data = array(
            'status'=>'1',
        );
        $result = $this->brandModel->updateBrand($data, $cond);
    
        if($result){
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        }
    }
    public function toggleStatus2($brandId){
       
 
        $cond="id_brand='$brandId'";
      
    
        $data = array(
            'status'=>'0',
        );
        $result = $this->brandModel->updateBrand($data, $cond);
    
        if($result){
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        }
    }

    public function search_brand(){
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
       
      
        $data['brands'] = $this->brandModel->searchBrand($keyword);
        $data['categories']=$this->categoryModel->category();
        $data['hiddenBrands']=$this->brandModel->hiddenBrand();
        
        // Trả về view hiển thị kết quả tìm kiếm
        
        $this->view('layout.header');
        $this->view('brand.search',$data);     
        $this->view('layout.footer');
    }
    
}