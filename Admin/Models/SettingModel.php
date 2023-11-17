<?php


class SettingModel extends BaseModel
{
    protected $table ='tbl_settings';
    public function getSetting(){
        return $this->getall($this->table);
    }

    // public function deleteUser($cond){
    //     return $this->delete($this->table,$cond);
    // }
    // public function countRows(){
    //     return $this->count($this->table);
    // }
    
    public function insertSetiing($data){
        return $this->insert($this->table,$data);
       
    }
    public function deleteSetting($cond){
        return $this->delete($this->table,$cond);
    }
    public function settingByid($cond){
        $sql = "SELECT * FROM $this->table WHERE $cond";
        return $this->select($sql);
    }
    public function updateSetting($data,$cond){
        return $this->update($this->table,$data,$cond);
    }
}