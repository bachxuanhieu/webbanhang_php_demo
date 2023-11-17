<?php
class SeriModel extends BaseModel{

    protected $table ='tbl_series';
    protected $table_brand ='tbl_brands';

    public function insertSeri($data){
        return $this->insert($this->table,$data);
       
    }

    public function getSeri(){
        $sql="SELECT * FROM $this->table,$this->table_brand WHERE  $this->table.id_brand = $this->table_brand.id_brand And $this->table.status=0  ORDER BY $this->table.id DESC";
        return $this->select($sql);
        
    }
    public function getSeries($cond){
        $sql="SELECT * FROM $this->table WHERE  $cond And $this->table.status=0  ORDER BY $this->table.id DESC";
        return $this->select($sql);
    }
}