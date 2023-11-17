<?php

class ProductController extends AuthController{
    private $homeModel;
    private $productModel;
    private $wishlistModel;

    private $cartModel;
    private $userModel;
    public function __construct()
    {
        $this->loadModel('HomeModel');
        $this->homeModel = new HomeModel;

        $this->loadModel('ProductModel');
        $this->productModel = new ProductModel;

        $this->loadModel('WishlistModel');
        $this->wishlistModel = new WishlistModel;

        $this->loadModel('CartModel');
        $this->cartModel = new CartModel;

        $this->loadModel('UserModel');
        $this->userModel = new UserModel;

        parent:: __construct();
    }


    public function index(){
       $this->product_category(1);
    }


    public function product_category($id){

        $data['category']=$this->homeModel->getCategory();
        $data['setting']=$this->homeModel->getSetting();

        $this->view('layout/header',$data);
        $data['product']= $this->productModel->productAll($id);

        $product_count = count($data['product']);

        $product_button = ceil($product_count/6);

        $data['product_button']= $product_button;

        $sp_tungtrang= 6;

        if(!isset($_GET['trang'])){ 
            $trang=1;
        }else{
            $trang=$_GET['trang'];
        }

        $tung_trang = ($trang-1) * $sp_tungtrang;

        $data['productcategoy']= $this->productModel->productCategory($id,$sp_tungtrang,$tung_trang);
        // lấy thông số kỹ thuật:
      

       

       

        $data['brands']= $this->productModel->productBrand($id);
        $data['product_selling'] = $this->homeModel->getSellingProducts5();
        $this->view('product/index',$data);
        $this->view('layout.footer',$data);
    } 

    // public function 
    public function productBrand($id_brand,$id){
        $products= $this->productModel->productBrandName($id_brand,$id);
        header('Content-Type: application/json');
        echo json_encode($products);
    }



    public function sort($type, $categoryId)
    {
        if ($type === 'low-to-high' || $type === 'high-to-low') {
          
            
            if ($type === 'low-to-high') {
                $products = $this->productModel->getProductsSortedByPrice('asc', $categoryId);
            } elseif ($type === 'high-to-low') {
                $products = $this->productModel->getProductsSortedByPrice('desc', $categoryId);
            }
    
           
         
            header('Content-Type: application/json');
            echo json_encode($products);
        }
    
    }
    public function productdetail($id_category,$id){
        
        $data['category']=$this->homeModel->getCategory();
        $data['setting']=$this->homeModel->getSetting();

        $this->view('layout/header',$data);


        $data['productdetail']=$this->productModel->getProductdetail($id);

        foreach( $data['productdetail'] as $k=>$v){
           $seri_product = $v['seri_product'];
        }

        foreach($data['productdetail'] as $i){
            $data['arr_properties']=[];
            if($i['properties']!= null && $i['properties'] !="" ){
                $data['arr_properties'] = json_decode($i['properties'],true);
            };
        }
        
        $data['product_series']= $this->productModel->getProductSeri($seri_product);

        // print_r($data['product_series']);
        

        $data['product_images']=$this->productModel->getProductdImages($id);
        $data['productcategory']= $this->productModel->productAll($id_category);
        $data['color_id'] = $this->productModel->getColor_id($id);
        $data['colors'] = $this->productModel->getColors();

        $ratings = $this->productModel->getRating($id);
        if($ratings){
            $countRating = 0;
            $sum = 0;
            foreach($ratings as $rating){
                $sum += $rating['rating'];
                $countRating++;
            }
            $data['rating']=$sum/$countRating;
        }else{
            $data['rating']=0;
        }

        // phần bình luận ==================================
        $data['comments']= $this->productModel->getComment($id);
        $data['commentCount'] = count($data['comments']);
       

       

       

        $data['user_name'] = $this->userModel->getName();
       
        $this->view('product/productdetail',$data);
        $this->view('layout.footer',$data);

    }
    public function search_product(){
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

        $data['category']=$this->homeModel->getCategory();
        $data['setting']=$this->homeModel->getSetting();

        $this->view('layout/header',$data);
       
      
        $data['products'] = $this->productModel->searchProduct($keyword);
        
        $this->view('product.search',$data);


        $this->view('layout.footer',$data);



        
    }
    public function addComment()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        Session::init();
        Session::checkSession();
    
        $userData = Session::getUserData();
        if ($userData) {
            $userId = $userData['id_user'];
        }

       
        $commentContent = $_POST['comment'];
        $productId = $_POST['productId'];
      
    
        $data = [
            'user_id' => $userId,
            'product_id' => $productId, // Nếu bạn lưu sản phẩm liên quan
            'content' => $commentContent,
            'created_at' => date('Y-m-d H:i:s'), // Ngày giờ hiện tại
        ];
        $result = $this->productModel->insertComment($data);
        $user_name = $this->userModel->getNamebyID($userId);
        
        foreach($user_name as $i){
            $name = $i['name'];
        }
        if($result){
            $response = [
                'status' => 'success',
                'message' => 'Đã để lại bình luận',
                'user_id' => $userId,
                'content' => $commentContent,
                'name'  => $name
            ];

        }else{
            $response = [
            'status' => 'error',
            'message' => 'bình luận thất bại'
            ];
        };

        
        header('Content-Type: application/json');
        echo json_encode($response);
    
     
    }

    public function addRating(){
        Session::init();
        Session::checkSession();
    
        $userData = Session::getUserData();
        if ($userData) {
            $userId = $userData['id_user'];
        };
        $rating = $_POST['index'];
        $product_id = $_POST['product_id'];

        $data = [
            'user_id' => $userId,
            'product_id' => $product_id, // Nếu bạn lưu sản phẩm liên quan
            'rating' => $rating,
            'created_at' => date('Y-m-d H:i:s'), // Ngày giờ hiện tại
        ];
        $result = $this->productModel->insertRating($data);

        if($result){
            $response = [
                'status' => 'success',
                'message' => 'Đánh sao thành công',
            ];

        }else{
            $response = [
            'status' => 'error',
            'message' => 'đánh giá sao thất bại',
            ];
        };


        header('Content-Type: application/json');
        echo json_encode($response);


    }


}