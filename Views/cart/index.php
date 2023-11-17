<div id="breadcrumb" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Giỏ hàng</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="<?php echo BASE_URL ?>/home/index">Trang Chủ</a></li>
                    <li class="active">Giỏ hàng</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Đơn đặt hàng</h3>
                    <br />
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
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Màu</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành Tiền</th>
                            <th scope="col">Chọn mua hàng</th>
                            <th scope="col">Sử lý</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php
                            if (isset($product))
                            {
                                $total = 0;
                                foreach ($product as $key => $i) {
                                    $subtotal = 0;
                                    foreach ($productCart as $keys => $pro) {
                                    
                                            if ($pro['product_id'] == $i['id_product']) {
                                            
                                            $subtotal = $pro['quanlity'] * $pro['price_product'];
                                            $total += $subtotal;
                                        
                            ?>
                            <tr>
                                <td style="width:150px">
                                    <?php echo $i['title_product'] ?>
                                </td>
                                <?php 
                                foreach ($color_product as $keys => $co_pro) {
                                    if($pro['product_color_id'] == $co_pro['color_id'] && $pro['product_id'] == $co_pro['product_id'] ) { 
                                ?>
                                    <td>
                                        <img src="<?php echo BASE_URL ?>/public/uploads/product_color/<?php echo $co_pro['image'] ?>"
                                            style="height:100px; width:100px" alt="">
                                    </td>
                                <?php }} ?>
                                <?php 
                                foreach ($colors as $keys => $co) {
                                    if($pro['product_color_id'] == $co['id']) { 
                                ?>
                                    <td>
                                        <input type="hidden" value="<?php echo $pro['product_color_id'] ?>" id="product_color_id">
                                        <?php echo $co['name'] ?>

                                    </td>
                                <?php }} ?>

                                <td>
                                    <?php echo number_format($pro['price_product'], 0, ',', '.') ?>đ
                                </td>

                                <td>
                                    <button class="btn btn-warning btn-sm update-quantity" data-action="subtract"
                                        data-product-id="<?php echo $i['id_product'] ?>">-</button>
                                    <span class="quantity">
                                        <?php echo $pro['quanlity'] ?>
                                    </span>
                                    <button class="btn btn-info btn-sm update-quantity" data-action="add"
                                        data-product-id="<?php echo $i['id_product'] ?>">+</button>
                                </td>

                                <td>
                                    <span class="subtotal">
                                        <?php echo number_format($subtotal, 0, ',', '.') ?>đ
                                    </span>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input buy_checked"
                                            <?php echo $pro['status'] == 1 ? 'checked' : '' ?> type="checkbox"
                                            value="<?php echo $pro['id'] ?>" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Mua hàng
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-danger deleteItemCart_button"
                                        data-product-id="<?php echo $i['id_product'] ?>">
                                        Xóa
                                    </button>
                                </td>
                            </tr>
                            <?php
                                        }
                                    }
                                }
                            
                            }
                        ?>


                        </tbody>
                </table>


                <div class="order-col p-3">
                    <div><strong><span style="color:red">Tổng thành tiền</span></strong></div>
                    <div><strong class="order-total"><?php echo number_format($total, 0, ',', '.') ?>đ</strong></div>
                </div>




            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="billing-details">
                    <div class="section-title text-center">
                        <h3 class="title">Thông tin đặt hàng</h3>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="<?php echo BASE_URL ?>/cart/orderMomo" method="POST" autocomplete="off"
                                name="formOrder">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Họ và tên:</label>
                                    <input class="input" type="text" name="name" value="<?php echo $name ?>"
                                        placeholder="Họ và tên">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Email:</label>
                                    <input class="input" type="email" name="email" value="<?php echo $email ?>"
                                        placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Số điện thoại:</label>
                                    <input class="input" type="text" name="phone" value="<?php echo $phone ?>"
                                        placeholder="Số điện thoại">
                                </div>
                                <div class="form-group">
                                    <h5>Chọn địa chỉ giao hàng</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="province" class="form-label">Thành phố:</label>
                                            <select name="province" id="province" class="form-control">
                                                <option value="">Chọn thành phố</option>
                                                <?php
                                                  foreach($provinces as $keys => $i){
                                                ?>
                                                <option value="<?php echo $i['province_id'] ?>"><?php echo $i['name'] ?>
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
                                <div class="form-group">
                                    <label for="" class="form-label">Số nhà/Tên đường/Thôn/Ấp</label>
                                    <input class="input" type="text" name="address" value="<?php echo $address ?>"
                                        placeholder="Địa chỉ nhận hàng">
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Ghi chú:</label>
                                    <input class="input" type="text" name="note" placeholder="Ghi chú cho Shop">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="button" class="btn btn-success btn-block" name="frmSubmit"
                                            id="submitOrderBtn" value="Thanh toán khi nhận hàng">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="submit" class="btn btn-danger btn-block" name="payUrl" id="payUrl"
                                            value="Thanh toán bằng Momo">
                                        </div>
                                    </div>
                                    <!-- <input type="submit" class="btn btn-info btn-block" name="VNpay" id="VNpay"
                                        value="Thanh toán bằng VNpay"> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
<?php include('cart.js') ?>
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("payUrl").addEventListener("click", function(event) {
        var province = document.getElementById("province").value;
        var district = document.getElementById("district").value;
        var wards = document.getElementById("wards").value;

        var atLeastOneProductChecked = $('.buy_checked').is(':checked');
        if (!atLeastOneProductChecked) {
            alert('Bạn chưa chọn sản phẩm');
        }
        if (province === "" || district === "" || wards === "") {
            alert("Vui lòng chọn đầy đủ thông tin địa chỉ Thành phố, Quận huyện, Phường xã.");
            event.preventDefault(); // Ngăn chặn việc gửi biểu mẫu nếu thông tin chưa đầy đủ.
        }
    });
    document.getElementById("VNpay").addEventListener("click", function(event) {
        var province = document.getElementById("province").value;
        var district = document.getElementById("district").value;
        var wards = document.getElementById("wards").value;

        if (province === "" || district === "" || wards === "") {
            alert("Vui lòng chọn đầy đủ thông tin địa chỉ Thành phố, Quận huyện, Phường xã.");
            event.preventDefault(); // Ngăn chặn việc gửi biểu mẫu nếu thông tin chưa đầy đủ.
        }
    });
});
</script>


