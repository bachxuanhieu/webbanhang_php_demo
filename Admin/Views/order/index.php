<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Danh mục đơn hàng
            <form id="searchForm"  class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-end">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchInput" placeholder="Nhập code đơn hàng...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            </h5>
                <div class="input-group mt-4">
                    <input type="date" class="form-control" id="startDate" placeholder="Từ ngày">
                    <input type="date" class="form-control" id="endDate" placeholder="Đến ngày">
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="filterByDate">
                            Lọc theo ngày
                        </button>
                    </div>
                </div>
            
        </div>
        <div class="card-body">
        <table class="table">
            <thead>
                <tr>
            
                <th scope="col">id</th>
                <th scope="col">Code đơn hàng</th>
                <th scope="col">Ngày đặt</th>
                <th scope="col">Tình trạng đơn hàng</th>
                <th scope="col">Quản lý</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=0;
                    foreach($orders as $key => $ord){
                        $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $ord['order_code']; ?></td>
                    <td><?php echo $ord['order_date']; ?></td>

                
                    <td><?php 
                        if($ord['order_status']==0){
                            echo "<span style='color:red'>Đơn hàng mới</span>";
                        }elseif($ord['order_status']==2){
                            echo "<span style='color:blue'>Đơn hàng đã thanh toán Online</span>";
                        }else {
                            echo "<span style='color:green'>Đơn hàng đã xử lý</span>";
                        }
                        ?>
                    </td>



                    <td>
                        <!-- <button class="btn btn-success btn-sm showOrderButton" data-order-code="<?php echo $ord['order_code'] ?>">
                            Xem đơn hàng
                        </button> -->
                        <a href="<?php echo BASE_URL ?>/admin/order/order_details/<?php echo $ord['order_code']; ?>" class="btn btn-success btn-sm">Xem đơn hàng</a>



                        <!-- nút xóa============================================================================================================================================= -->
                        <button class="btn btn-danger btn-sm delete-order-button"  data-bs-toggle="modal" data-bs-target="#deleteOrderModal_<?php echo $ord['order_code']; ?>">Xóa đơn hàng</button>
                        
                        <div class="modal fade" id="deleteOrderModal_<?php echo $ord['order_code']?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xóa đơn hàng</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Dữ liệu đơn hàng sẽ bị xóa. Bạn có muốn xóa?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info"
                                            data-bs-dismiss="modal">No</button>
                                        <button data-order-code="<?php echo $ord['order_code']; ?>"
                                            class="btn btn-danger m-2 delete-order">Yes 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
                    };
                ?>
            </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    <?php include('order.js') ?>
</script>