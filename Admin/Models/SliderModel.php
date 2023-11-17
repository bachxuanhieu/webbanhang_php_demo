<?php


class SliderModel extends BaseModel
{
    protected $table ='tbl_sliders';
  
    public function getallSlider(){
        return $this->getall($this->table);
    }

    public function insertSlider($data){
        return $this->insert($this->table,$data);
       
    }

    public function deleteSlider($cond){
        return $this->delete($this->table,$cond);
    }
    public function sliderId($cond){
        $sql = "SELECT * FROM $this->table WHERE $cond";
        return $this->select($sql);
    }
    public function updateSlider($data,$cond){
        return $this->update($this->table,$data,$cond);
    }
}