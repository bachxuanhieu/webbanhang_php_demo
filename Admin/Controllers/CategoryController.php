<?php

class CategoryController extends BaseController
{
    private $categoryModel;

    public function __construct()
    {
        $this->loadModel('CategoryModel');
        $this->categoryModel = new CategoryModel;
        parent:: __construct();
    }

    public function index(){

        Session::checkSession();
        
        $categories = $this->categoryModel->category();
        $hiddencategories = $this->categoryModel->hiddencategory();
        $brands = $this->categoryModel->brandCategory();




        $this->view('layout.header');


        $this->view('category.index',[
            'categories' => $categories,
            'hiddencategories' => $hiddencategories,
            'brands' => $brands,
        ]);
        
        $this->view('layout.footer');

    }

    public function getCategories(){
        $categories = $this->categoryModel->category();

        if ($categories) {
            $response = [
                'success' => true,
                'categories' => $categories,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Không có danh mục nào.',
            ];
        }
    
        // Trả về dữ liệu dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function insertcategory(){
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $status = $_POST['status'];

            $existingCategory = $this->categoryModel->getCategory($title);

            if( $existingCategory){
                $message = "Danh mục này đã tồn tại";
                echo json_encode(['success' => false, 'message' => $message]);
                exit;
            }else{
                $data = array(
                    'title_category_product' => $title,
                    'desc_category_product' => $desc,
                    'status' => $status,
                    
                );
            }

            $result = $this->categoryModel->insertCategory($data); 
    
            if($result){
                header('Content-Type: application/json');
                echo json_encode(['success' => true]);
                exit;
            }
        }
    }


    public function deletecategory($categoryId)
    {   
       
        $cond = "id_category_product='$categoryId'";
    
        $result = $this->categoryModel->deleteCategory($cond); 
     
      
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
    


    
    public function editCategory($categoryId) {
      
        $cond= "id_category_product='$categoryId'";
       
        $category = $this->categoryModel->categoryByid($cond);

        
            if (!$category) {
                $response = [
                    'success' => false,
                    'message' => 'Không tìm thấy danh mục.',
                ];
            } else {
                $response = [
                    'success' => true,
                    'category' => $category,
                ];
            }
    
        // Trả về dữ liệu dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function updateCategory($categoryId){
      
        $cond="id_category_product='$categoryId'";

     
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $status = $_POST['status'];

          

            $existingCategory = $this->categoryModel->getCategory($title);

            if( $existingCategory){
                $message = "Danh mục này đã tồn tại";
                echo json_encode(['success' => false, 'message' => $message]);
                exit;
            }else{
                $data = array(
                    'title_category_product' => $title,
                    'desc_category_product' => $desc,
                    'status' => $status,
                    
                );
            }
           
        
       
            $result = $this->categoryModel->updateCategory($data, $cond);
          
        
        if ($result) {
       
            $response = [
                'success' => true,
            ];
        }
    
        // Trả về dữ liệu dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        }
    }

    public function search_category(){
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
       
      
        $data['category'] = $this->categoryModel->searchcategory($keyword);
        
        // Trả về view hiển thị kết quả tìm kiếm
        
        $this->view('layout.header');
        $this->view('category.search',$data);     
        $this->view('layout.footer');
    } 
    public function toggle_status($categoryId){
        
        
        $cond= "id_category_product='$categoryId'";
        $data = array(
            'status'=>'1',
        );
        $result = $this->categoryModel->updateCategory($data, $cond);

        if($result){
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        }
        
    }
    public function toggle_status2($categoryId){
        
        
        $cond= "id_category_product='$categoryId'";
        $data = array(
            'status'=>'0',
        );
        $result = $this->categoryModel->updateCategory($data, $cond);

        if($result){
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        }
        
    }
     
       
    
}