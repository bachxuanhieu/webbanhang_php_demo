<?php

class OrderModel extends AuthModel{

    protected $table ='tbl_orders';
    protected $table_order ='tbl_order_details';

    public function insertOrder($data_order){
        return $this->insert($this->table,$data_order);
    }

    public function insert_order_details($data_details){
        return $this->insert($this->table_order,$data_details);
      }

}