<?php
class ColorModel extends BaseModel{

    protected $table ='tbl_colors';
    // protected $table_category ='tbl_category_product';
    // protected $table_product ='tbl_product';
    public function insertColor($data){
        return $this->insert($this->table,$data);
    }
    public function getColor(){
        $sql = "SELECT * FROM $this->table order by $this->table.id ASC";
        return $this->select($sql);
    }
    public function deleteColor($cond){
        return $this->delete($this->table,$cond);
    }

    public function getColorById($cond){
        $sql = "SELECT * FROM $this->table where $cond";
        return $this->select($sql);
    }
}