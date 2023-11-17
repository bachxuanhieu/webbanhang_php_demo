<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="billing-details">
                    <div class="section-title">
                        <h5 class="title">Lịch sủ đơn Hàng của bạn</h5><br />
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Stt</th>
                                <th scope="col">Ngày đặt hàng</th>
                                <th scope="col">Trạng thái đơn hàng</th>
                                <th scope="col">Sử lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $j = 0;
                            foreach ($orders as $keys => $i) {
                                $j++;
                                ?>
                            <tr>
                                <td>
                                    <?php echo $j ?>
                                </td>
                                <td>
                                    <?php echo $i['order_date'] ?>
                                </td>
                                <td>
                                    <?php
                                        if ($i['order_status'] == 1) {
                                            ?>
                                    Đơn hàng đã được xác nhận
                                    <?php
                                        } else {
                                            ?>
                                    Đơn hàng chưa được xác nhận
                                    <?php
                                        }
                                        ?>
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm"
                                        href="<?php echo BASE_URL ?>/cart/orderdetail/<?php echo $i['order_code'] ?>">Xem
                                        chi tiết đơn hàng</a>
                                    <?php
                                        if ($i['order_status'] == 0) {
                                            ?>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#deletedetail_<?php echo $i['order_code'] ?>">
                                        Hủy đơn hàng
                                    </button>
                                    <div class="modal fade delete_modal"
                                        id="deletedetail_<?php echo $i['order_code'] ?>" tabindex="-1" role="dialog"
                                        aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title" id="modalLabel">Hủy đơn hàng</h4>
                                                </div>
                                                <div class="modal-body">
                                                    Đơn hàng của bạn sẽ bị hủy, bạn có muốn?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-dismiss="modal">NO</button>
                                                    <!-- <a class="btn btn-danger btn-sm "
                                                            href="<?php echo BASE_URL ?>/cart/deletedetail/<?php echo $i['order_code'] ?>">Yes</a> -->
                                                    <button class="btn btn-danger btn-sm delete_order"
                                                        data-order-code="<?php echo $i['order_code'] ?>">YES</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                            } else {
                                            ?>
                                    <button class="btn btn-info btn-sm">Đơn hàng không thể hủy</button>

                                    <?php
                                        }
                                        ?>

                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
$(document).ready(function() {
    $('.delete_order').on('click', function() {
        var order_code = $(this).attr('data-order-code');
        var rowToRemove = $(this).closest('tr');
        $.ajax({
            type: 'POST',
            url: '<?php echo BASE_URL ?>/cart/deletedetail',
            data: {
                order_code: order_code,
            },
            dataType: 'json',
            success: function(data) {
                if (data.status === "true") {
                    rowToRemove.remove();
                    alert(data.message);

                    // Masquer le modal après la suppression avec succès
                    $('#deletedetail_' + order_code).hide();
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                } else {
                    alert(data.message);
                }
            },
            error: function() {
                alert('Lỗi xóa đơn hàng');
            }
        })
    })
})
</script>