<div id="orderDetailsContainer">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4>Thông tin khách hàng
                <a href="<?php echo BASE_URL ?>/admin/order" class="btn btn-success float-end">Quay lại</a>

                </h4>
                <?php
                if(!empty($_GET['msg'])){
                    $msg=unserialize(urldecode($_GET['msg']));
                    foreach($msg as $key => $value){
                        echo '<span style="color:blue;">'.$value.'</span>';
                    }
                }
            ?>
            </div>
            <div class="card-body">
                <table class="table table-danger table-striped">
                    <thead>
                        <tr>

                            <th scope="col">Id</th>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Địa chỉ nhận hàng</th>
                            <th scope="col">Email</th>
                            <th scope="col">Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                $i=0;
            
                    foreach($order_info as $key => $ord){
                        
                        $i++;
                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $ord['name']; ?></td>
                            <td><?php echo $ord['phone']; ?></td>

                            <td><?php echo $ord['address']; ?>, <?php echo $ord['wards']; ?>, <?php echo $ord['district']; ?>, <?php echo $ord['province']; ?></td>
                            <td><?php echo $ord['email']; ?></td>
                            <td><?php echo $ord['note']; ?></td>
                            <?php
                    };
                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-5">
        <div class="card">
            <div class="card-header">
                <h4>Sản phẩm
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-success table-striped">
                    <thead>
                        <tr>

                            <th scope="col">Id</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">số Lượng</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $i=0;
                    $total=0;
                        foreach($order_details as $key => $ord){
                            $total+=$ord['product_quanlity']*$ord['price_product'];
                            $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $ord['title_product']; ?></td>
                            <td> <img src="<?= BASE_URL ?>/public/uploads/product/<?= $ord['image_product'] ?>"
                                    style="width: 100px; height: 100px;" alt=""></td>
                            <td><?php echo $ord['product_quanlity']; ?></td>
                            <td>$<?php echo number_format($ord['price_product'],0,',','.'); ?></td>

                            <td>$<?php echo number_format( $ord['product_quanlity']*$ord['price_product'],0,',','.'); ?>
                            </td>
                        </tr>
                        <?php
                        };
                    ?>
                   
                            
                            <tr>
                                <td>Tổng tiền: $<?php echo number_format($total,0,',','.'); ?></td>
                              
                                <td>
                                <?php
                                    foreach($order as $keys => $i){
                                        if($i['order_status']==0){
                                ?>
                                    <button class="btn btn-danger orderSubmit" data-code-id="<?php echo $ord['order_code']; ?>">
                                        Xác nhận đơn hàng!
                                    </button>
                                <?php
                                    }else{
                                ?>
                                     <button class="btn btn-success">
                                        Đơn hàng đã được xác nhận!
                                    </button>
                                <?php
                                    };
                                }
                                ?>

                                </td>
                               
                            </tr>
                
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    <?php include('order.js') ?>
</script>