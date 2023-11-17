<?php

class WishlistController extends AuthController{



    private $wishlistModel;
    private $homeModel;

    private $cartModel;
    public function __construct()
    {
        $this->loadModel('WishlistModel');
        $this->wishlistModel = new WishlistModel;

        $this->loadModel('CartModel');
        $this->cartModel = new CartModel;

        $this->loadModel('HomeModel');
        $this->homeModel = new HomeModel;

        parent:: __construct();
    }

    public function addWishlist($id) {
        Session::init();
        Session::checkSession();
    
        $userData = Session::getUserData();
    
        if ($userData) {
            $userId = $userData['id_user'];
        }
    
        // Kiểm tra xem sản phẩm đã tồn tại trong danh sách yêu thích hay chưa
        $existingWishlist = $this->wishlistModel->checkProductInWishlist($userId, $id);
    
        if (!$existingWishlist) {
            $data = array(
                'user_id' => $userId,
                'product_id' => $id,
            );
    
            $result = $this->wishlistModel->insertWishlist($data);
    
            if ($result == 1) {
               
                header("Location:".BASE_URL."/wishlist/wishlist");
            }
        } else {
            
           
            header("Location:".BASE_URL."/wishlist/wishlist");
        }
    }
    
    public function Wishlist(){
        Session::init();
        Session::checkSession();
    
        $userData = Session::getUserData();
        $userId = $userData['id_user'];
      
        $data['product']= $this->wishlistModel->getProduct($userId);

        $data['category']=$this->homeModel->getCategory();
        $data['setting']=$this->homeModel->getSetting();

        $this->view('layout/header',$data);
        $this->view('wishlist.index', $data);
        $this->view('layout.footer',$data);
    
    }

    public function DeleteWishlist($id){
        Session::init();
        Session::checkSession();
    
        $userData = Session::getUserData();
    
        if ($userData) {
            $userId = $userData['id_user'];
        }
    
        // Kiểm tra xem sản phẩm tồn tại trong danh sách yêu thích hay không
        $existingWishlist = $this->wishlistModel->checkProductInWishlist($userId, $id);
    
        if ($existingWishlist) {
            // Xóa sản phẩm khỏi danh sách yêu thích
            $result = $this->wishlistModel->removeWishlist($userId, $id);
    
            if ($result == 1) {
                $message['msg']="Xóa sản phẩm trong danh sách yêu thích thành công";
                header("Location:".BASE_URL."/wishlist/wishlist?msg=".urlencode(serialize($message)));
            }
        } else {
            $message['msg']="Có lỗi rồi!!! vui lòng thử lại sau.";
            header("Location:".BASE_URL."/wishlist/wishlist?msg=".urlencode(serialize($message)));
        }   
    }
}