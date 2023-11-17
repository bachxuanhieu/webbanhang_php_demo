<?php

class NewController extends AuthController{

private $newModel;
public function __construct(){

            
    $this->loadModel('NewModel');
    $this->newModel = new NewModel;


    parent:: __construct();
}

public function index(){
    $data['category_post']= $this->newModel->getallCategory();
    $data['post']= $this->newModel->getallPost();
    
    $this->view('new.index',$data);
}

public function newDetail($id){
    $data['category_post']= $this->newModel->getallCategory();
    $data['postDetail']= $this->newModel->getPostdetail($id);
    $this->view('new.newdt',$data);
}

public function newCategory($id){
    
    $data['category_post']= $this->newModel->getallCategory();
    $data['newCategory']= $this->newModel->getnewCategory($id);
    $this->view('new.newCategory',$data);
}

}