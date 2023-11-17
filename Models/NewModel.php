<?php


class NewModel extends AuthModel
{
    protected $table ='tbl_category_post';
    protected $table_post ='tbl_post';
    public function getallCategory(){
        return $this->getall($this->table);
    }

    public function getallPost(){
        $sql = "SELECT * FROM $this->table_post ORDER BY $this->table_post.id_post ASC";
        return $this->select($sql);
    }
    public function getPostdetail($id){
        $sql = "SELECT * FROM $this->table_post WHERE  $this->table_post.id_post = $id";
        return $this->select($sql);
    }
    
    public function getnewCategory($id){
    $sql="SELECT * FROM $this->table_post WHERE $this->table_post.id_category_post ='$id'";
     
        return $this->select($sql);
    }

    


//     public function getCategory()
//     {
//         return $this->getall($this->table_category);
//     }
   
}