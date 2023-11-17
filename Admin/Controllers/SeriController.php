<?php

class SeriController extends BaseController
{
    private $brandModel;
    private $categoryModel;
    private $seriModel;

    public function __construct()
    {
        $this->loadModel('BrandModel');
        $this->brandModel = new BrandModel;


        $this->loadModel('CategoryModel');
        $this->categoryModel = new CategoryModel;

        $this->loadModel('SeriModel');
        $this->seriModel = new SeriModel;
        parent:: __construct();
    }
    public function index(){
    
        $this->listbrand();
    }

    public function listbrand(){
        Session::checkSession();

        $data['categories']=$this->categoryModel->category();
        $data['series'] = $this->seriModel->getSeri();
   
       
        $this->view('layout.header');
        
        $this->view('seri.index',$data);

        $this->view('layout.footer');  

    }
    public function addSeri(){
        if(isset( $_POST['title'])){
            $title = $_POST['title'];
            $id_brand = $_POST['id_brand'];

            $data= array(
                'title_seri'=> $title,
                'id_brand'=> $id_brand,
            );

            $result = $this->seriModel->insertSeri($data);
            if($result){
                header('Content-Type: application/json');
                echo json_encode(['success'=> true]);
                exit;
            }
        }
    }
}