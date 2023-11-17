<?php

class DashboardController extends BaseController
{
private $session;
private $categoryModel;
private $newModel;
private $newdtModel;
private $productModel;
private $orderModel;
private $userModel;
    public function __construct(){

        $this->loadSession('Session');
        $this->session = new Session;

        $this->loadModel('CategoryModel');
        $this->categoryModel = new CategoryModel;

        $this->loadModel('NewModel');
        $this->newModel = new NewModel;

        $this->loadModel('NewdtModel');
        $this->newdtModel = new NewdtModel;

        $this->loadModel('ProductModel');
        $this->productModel = new ProductModel;

        $this->loadModel('OrderModel');
        $this->orderModel = new OrderModel;

        $this->loadModel('UserModel');
        $this->userModel = new UserModel;
        

   }

    public function index(){      
        $this->dashboard();     
    }

      
    public function dashboard(){
        Session::checkSession();

        $categoryCount = $this->categoryModel->countRows();
        $productCount = $this->productModel->countRows();
        $newCount = $this->newModel->countRows();
        $newdtCount = $this->newdtModel->countRows();
        $orderCount = $this->orderModel->countRows(); 
        $orderdetailCount = $this->orderModel->countRows1(); 
        $userCount = $this->userModel->countRows(); 
        $this->view('layout.header');
        $this->view('dashboard.index',[
            'categoryCount'=>$categoryCount,
            'productCount'=>$productCount,
            'newCount'=>$newCount,
            'newdtCount'=>$newdtCount,
            'orderCount'=>$orderCount,
            'orderdetailCount'=>$orderdetailCount,
            'userCount'=>$userCount,
        ]);
        $this->view('layout.footer');
   }
}