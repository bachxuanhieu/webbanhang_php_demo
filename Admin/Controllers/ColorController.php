<?php

class ColorController extends BaseController
{
    private $colorModel;
    public function __construct()
    {
        $this->loadModel('ColorModel');
        $this->colorModel = new ColorModel;


        // $this->loadModel('CategoryModel');
        // $this->categoryModel = new CategoryModel;

        parent:: __construct();
    }
    public function index(){
        $this->view('layout.header');

        $colors = $this->colorModel->getColor();
        $this->view('color.index',[
            'colors' => $colors
        ]);     
        $this->view('layout.footer');   
    }
    public function insertColor(){
        $name = $_POST['name'];
        $code = $_POST['code'];
        $status = $_POST['status'];
        $data = [
            'name' => $name,
            'code' => $code,
            'status' => $status,
        ];
        $result = $this->colorModel->insertColor($data); 

        if($result){
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        }
    }
    public function deleteColor(){
        $colorId = $_POST['colorId'];
        $cond="id='$colorId'";
        $result = $this->colorModel->deleteColor($cond);

         if ($result) {
            $response = [
                'success' => 'true',
                'message' => 'Xóa đơn hàng thành công',
            ];

        } else {
            $response = [
                'status' => 'error',
                'message' => 'Xóa đơn hàng thất bại',
            ];
        }
        echo json_encode($response);
    }
    public function editColor($colorId){
        $cond = "id='$colorId'";

        $colors = $this->colorModel->getColorById($cond);

        if($colors){
            $response = [
                'success' => true,
                'colors' =>$colors
            ];
        }else{
            $response = [
                'success' => false,
                'message' => 'không tìm thấy màu!'
            ]; 
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}