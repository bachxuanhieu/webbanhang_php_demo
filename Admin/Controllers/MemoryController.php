<?php

class MemoryController extends BaseController
{
    private $memoryModel;
    public function __construct()
    {
        $this->loadModel('MemoryModel');
        $this->memoryModel = new MemoryModel;


        // $this->loadModel('CategoryModel');
        // $this->categoryModel = new CategoryModel;

        parent:: __construct();
    }
    public function index(){
        $this->view('layout.header');

        $memories = $this->memoryModel->getMemory();
        $this->view('memory.index',[
            'memories' => $memories
        ]);     
        $this->view('layout.footer');   
    }

    public function insertMemory(){
        $name = $_POST['name'];
        $status = $_POST['status'];
        $data = [
            'name' => $name,
            'status' => $status,
        ];
        $result = $this->memoryModel->insertMemory($data); 

        if($result){
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        }
    }
    // public function deleteColor(){
    //     $colorId = $_POST['colorId'];
    //     $cond="id='$colorId'";
    //     $result = $this->colorModel->deleteColor($cond);

    //      if ($result) {
    //         $response = [
    //             'success' => 'true',
    //             'message' => 'Xóa đơn hàng thành công',
    //         ];

    //     } else {
    //         $response = [
    //             'status' => 'error',
    //             'message' => 'Xóa đơn hàng thất bại',
    //         ];
    //     }
    //     echo json_encode($response);
    // }
    // public function editColor($colorId){
    //     $cond = "id='$colorId'";

    //     $colors = $this->colorModel->getColorById($cond);

    //     if($colors){
    //         $response = [
    //             'success' => true,
    //             'colors' =>$colors
    //         ];
    //     }else{
    //         $response = [
    //             'success' => false,
    //             'message' => 'không tìm thấy màu!'
    //         ]; 
    //     }
    //     header('Content-Type: application/json');
    //     echo json_encode($response);
    // }
}