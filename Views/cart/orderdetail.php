<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="billing-details">
                    <div class="section-title">
                        <h5 class="title">Chi tiết đơn hàng</h5> <br />
                        <?php
                        if (isset($_SESSION['message'])) {
                            echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
                            unset($_SESSION['message']); // Xóa thông báo ra khỏi session
                        }
                        ?>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Stt</th>
                                <th scope="col">Tên người đặt</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Email</th>
                                <th scope="col">Địa chỉ nhận hàng</th>
                                <th scope="col">Sử lý</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $j = 0;
                            foreach ($orderdetail as $order) {
                                $j++;
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $j ?>
                                    </td>
                                    <td>
                                        <?php echo $order['name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $order['phone'] ?>
                                    </td>
                                    <td>
                                        <?php echo $order['email'] ?>
                                    </td>
                                    <td>
                                        <?php echo $order['address'] ?>,
                                        <?php echo $order['wards'] ?>,
                                        <?php echo $order['district'] ?>,
                                        <?php echo $order['province'] ?>
                                    </td>
                                    <td>



                                        <?php
                                        foreach ($orders as $ord) {
                                            if ($ord['order_status'] == 0) {
                                                ?>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#edit_info_2">Chỉnh sửa thông tin</button>
                                            <?php
                                            } else {
                                                ?>
                                                <button type="button" class="btn btn-danger btn-sm">Không thể sửa thông tin</button>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </td>
                                </tr>
                                <!-- The modal -->
                                <div class="modal fade" id="edit_info_2" tabindex="-1" role="dialog"
                                    aria-labelledby="modalLabel_2" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="modalLabel_2">Chỉnh sửa thông tin</h4>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form for editing information -->
                                                <form
                                                    action="<?php echo BASE_URL ?>/cart/edit_info/<?php echo $order['order_detail_id'] ?>/<?php echo $order['order_code'] ?>"
                                                    method="POST">
                                                    <div class="mb-3">
                                                        <label class="form-label">Tên Người Nhận</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $order['name'] ?>" name="name">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Số điện thoại</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $order['phone'] ?>" name="phone">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $order['email'] ?>" name="email">
                                                    </div>
                                                    <div class="mb-3">
                                                        <h5>Chọn địa chỉ giao hàng</h5>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for="province" class="form-label">Thành phố:</label>
                                                                <select name="province" id="province" class="form-control">
                                                                    <option value="">Chọn thành phố</option>
                                                                    <?php
                                                                    foreach ($provinces as $keys => $i) {
                                                                        ?>
                                                                        <option value="<?php echo $i['province_id'] ?>">
                                                                            <?php echo $i['name'] ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="district">Quận/Huyện:</label>
                                                                <select id="district" name="district" class="form-control">
                                                                    <option value="">Chọn một quận/huyện</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="wards">Phường/Xã:</label>
                                                                <select name="wards" id="wards" class="form-control">
                                                                    <option value="">Chọn một phường/xã</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Địa chỉ nhận hàng</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $order['address'] ?>" name="address">
                                                    </div>
                                                    <!-- Nút "Lưu" để gửi form -->
                                                    <button type="submit" class="btn btn-success btn-sm"
                                                        style="margin-top: 10px">Lưu</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info btn-sm"
                                                    data-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </tbody>

                    </table>
                    <div class="section-title">
                        <h5 class="title">Sản phẩm đã đặt</h5>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Màu sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $total = 0;
                            foreach ($order_details as $key => $ord) {
                                $total += $ord['price'];
                                $i++;
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <?php
                                    foreach ($color_product as $keys => $co_pro) {
                                        if ($ord['product_color_id'] == $co_pro['color_id'] && $ord['product_id'] == $co_pro['product_id']) {
                                            ?>
                                            <td><img src="<?php echo BASE_URL ?>/public/uploads/product_color/<?php echo $co_pro['image'] ?>"
                                                    style="height:100px; width:100px" alt="">
                                            </td>
                                        <?php }
                                    } ?>
                                    <td>
                                        <?php echo $ord['title_product']; ?>
                                    </td>

                                    <?php
                                    foreach ($colors as $keys => $co) {
                                        if ($ord['product_color_id'] == $co['id']) {
                                            ?>
                                            <td>

                                                <?php echo $co['name'] ?>

                                            </td>
                                        <?php }
                                    } ?>
                                    <td>
                                        <?php echo $ord['product_quanlity']; ?>
                                    </td>


                                    <td>
                                        <?php echo number_format($ord['price'], 0, ',', '.'); ?>đ
                                    </td>
                                </tr>
                                <?php
                            }
                            ;
                            ?>
                            <tr>
                                <td><span style="color:red; font-size: 24px">Tổng tiền:</span> <span
                                        style="font-size: 24px">
                                        <?php echo number_format($total, 0, ',', '.'); ?>đ
                                    </span> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>



<script>
    <?php include('cart.js') ?>
</script>