<?php

class HomeController extends AuthController{
    private $homeModel;

    private $wishlistModel;

    private $cartModel;

    public function __construct()
    {
        $this->loadModel('HomeModel');
        $this->homeModel = new HomeModel;

        
        $this->loadModel('WishlistModel');
        $this->wishlistModel = new WishlistModel;

        $this->loadModel('CartModel');
        $this->cartModel = new CartModel;


        parent:: __construct();
    }


    public function index(){
        $category=$this->homeModel->getCategory();
        $setting=$this->homeModel->getSetting();

        $brands = $this->homeModel->getBrand();


        $this->view('layout/header',[
            'category'=>$category,
            'setting'=>$setting,
            'brands'=>$brands
        ]);
        
        $sliders=$this->homeModel->getSliders();
        $this->view('layout/slider',[
            'sliders'=>$sliders,
        ]);


        $product_hot = $this->homeModel->getHotProducts();
        $product_selling = $this->homeModel->getSellingProducts();

     
        
        $page= isset($_POST['page']) ? intval($_POST['page']) : 1;

        $itemsPerPage = 8;

        $offset = ($page - 1) * $itemsPerPage;

        $products = $this->homeModel->getProducts($offset, $itemsPerPage);



        $this->view('index',[
        'products'=>$products,
        'product_hot'=>$product_hot,
        'product_selling'=>$product_selling


    ]);
        
        $this->view('layout/footer',[
            'setting'=>$setting,
            'category'=>$category
        ]);
    }
    public function loadmore() {
        // Lấy số trang hiện tại từ yêu cầu AJAX
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    
        // Số sản phẩm trên mỗi trang
        $itemsPerPage = 8;
    
        // Tính vị trí bắt đầu trong CSDL dựa trên số trang
        $offset = ($page - 1) * $itemsPerPage;
    
        // Gọi hàm để lấy danh sách sản phẩm từ CSDL dựa trên vị trí bắt đầu và số sản phẩm trên mỗi trang
        $products = $this->homeModel->getProducts($offset, $itemsPerPage);
    
        // Trả về dữ liệu sản phẩm dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($products);
    }


    

      
}

