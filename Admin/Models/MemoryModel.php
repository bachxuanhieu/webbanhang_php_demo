<?php
class MemoryModel extends BaseModel{

    protected $table ='tbl_memories';
    // protected $table_category ='tbl_category_product';
    // protected $table_product ='tbl_product';
    public function insertMemory($data){
        return $this->insert($this->table,$data);
    }
    public function getMemory(){
        $sql = "SELECT * FROM $this->table order by $this->table.id ASC";
        return $this->select($sql);
    }
    public function deleteMemory($cond){
        return $this->delete($this->table,$cond);
    }

    public function getMemoryById($cond){
        $sql = "SELECT * FROM $this->table where $cond";
        return $this->select($sql);
    }
}