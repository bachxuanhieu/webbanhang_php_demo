<?php


class HomeModel extends AuthModel
{
    protected $table ='tbl_product';

    protected $table_brand = 'tbl_brands';
    protected $table_category ='tbl_category_product';

    protected $table_slider='tbl_sliders';
    protected $table_setting='tbl_settings';
    
    public function getallProduct(){
        $sql = "SELECT * FROM $this->table WHERE $this->table.status = 0 limit 5";
        return $this->select($sql);
    }
    public function getHotProducts()
    {
        $sql = "SELECT * FROM $this->table WHERE $this->table.hot_product = 1";
        return $this->select($sql);
    }
    public function getBrand(){
        $sql = "SELECT * FROM $this->table_brand where $this->table_brand.status = 0 order by $this->table_brand.id_brand ASC";
        return $this->select($sql);
    }
    public function getSetting()
    {
        $sql = "SELECT * FROM $this->table_setting WHERE $this->table_setting.status = 1";
        return $this->select($sql);
    }
    public function getSellingProducts()
    {
        $sql = "SELECT * FROM $this->table WHERE $this->table.selling_product < $this->table.price_product";
        return $this->select($sql);
    }
    public function getSellingProducts5()
{
    $sql = "SELECT * FROM $this->table WHERE $this->table.selling_product < $this->table.price_product LIMIT 5";
    return $this->select($sql);
}

    


    public function getCategory()
    {
        $sql = "SELECT * FROM $this->table_category WHERE $this->table_category.status = 0";
        return $this->select($sql);
    }

    public function getSliders()
    {
        $sql = "SELECT * FROM $this->table_slider WHERE $this->table_slider.status_slider = 1";
        return $this->select($sql);
    }


    public function getProducts($offset, $itemsPerPage){
        $sql="SELECT * FROM $this->table order by $this->table.id_product desc LIMIT $offset,$itemsPerPage";
        return $this->select($sql);
    }

 
   
}