<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <?php
                foreach ($productdetail as $keys => $pro) {
            ?>
            <!-- <div class="container">
                <a href="<?php echo BASE_URL ?>">Trang chủ</a>
            </div> -->

            <!-- Product main img -->
            <div class="col-md-5 col-md-push-2">
                <div id="product-main">
                    <div class="product-preview">
                        <img src="<?php echo BASE_URL ?>/public/uploads/product/<?php echo $pro['image_product'] ?>"
                            class="main-image" alt="">
                    </div>
                </div>
            </div>
            <!-- /Product main img -->
            <!-- Product thumb imgs -->
            <div class="col-md-2  col-md-pull-5">
                <div id="product-imgs">
                    <div class="product-preview">
                        <img src="<?php echo BASE_URL ?>/public/uploads/product/<?php echo $pro['image_product'] ?>"
                            class="thumbnail-image" style="height: 100px; width:150px" alt="">
                        <?php
                            foreach ($product_images as $key => $i) {
                                if($pro['id_product'] == $i['id_product'] ){
                        ?>
                        <img src="<?php echo BASE_URL ?>/public/uploads/product_image/<?php echo $i['image_name'] ?>"
                            class="thumbnail-image" style="height: 100px; width:150px" alt="">
                        <?php
                                }
                            }   
                        ?>
                    </div>

                </div>
            </div>
            <!-- /Product thumb imgs -->
            <!-- Product details -->
            <div class="col-md-5">
                <div class="product-details">
                    <h2 class="product-name">
                        <?php echo $pro['title_product'] ?>
                    </h2>
                    <div>
                        <div class="product-rating">
                            <?php
                            // echo (ceil($rating));
                                for($i=1; $i<= ceil($rating); $i++){
                                   echo('<i class="fa fa-star"></i>');
                                   
                                }
                            ?>
                        </div>
                        <button class="btn btn-link review-link"> <?php echo $commentCount; ?> Review(s) | Add your
                            review</button>
                    </div>
                    <div>
                        <h3 class="product-price" id="product-detail-price">
                            <?php echo number_format($pro['selling_product'], 0, ',', '.') ?>đ
                        </h3>

                        <del class="product-old-price">
                            <?php echo number_format($pro['price_product'], 0, ',', '.') ?>đ
                        </del>
                    </div>
                    <p>
                        <?php echo $pro['small_desc'] ?>
                    </p>
                    <div class="product-options">


                        <h5>Bộ nhớ</h5>
                        <div class="row">
                            <?php
                                foreach($product_series  as $i){
                                    if($i['memory_product']!=""){
                            ?>
                            <div class="col-md-4">
                                <a href="<?php echo BASE_URL ?>/product/productdetail/<?php echo $i['id_category_product'] ?>/<?php echo $i['id_product'] ?>"
                                    class="btn btn-light" style=" width:150px; border: 4px solid #FF9999; margin: 5px">
                                    <?php echo $i['memory_product'] ?></a>
                            </div>
                            <?php 
                                }else{
                            ?>
                            <div></div>
                            <?php
                                }
                            }
                            ?>
                        </div>


                        <h5>Màu:</h5>
                        <div class="row">
                            <?php
                            foreach($colors as $co) {
                                foreach($color_id as $i) {
                                    if($co['id'] == $i['color_id']) {
                            ?>


                            <div class="col-md-4">
                                <?php if($i['quanlity'] == 0){  ?>

                                    <button class="btn btn-sm"
                                    style="border: 4px solid <?php echo $co['code']?>; width: 150px; margin: 10px">
                                    <?php echo $co['name']?>
                                    <img class=""
                                        src="<?php echo BASE_URL ?>/public/uploads/product_color/<?php echo $i['image'] ?>"
                                        height="50" width="50" alt="">
                                    <p>
                                        <span style="color: red">
                                           Đã hết hàng
                                        </span>
                                    </p>
                                    </button>
                                  
                                <?php }else{ ?> 
                                    
                                    <button data-color-id="<?php echo $i['color_id'] ?>" class="btn btn-sm  btn-color"
                                    style="border: 4px solid <?php echo $co['code']?>; width: 150px; margin: 10px">
                                    <?php echo $co['name']?>
                                    <img class="thumbnail-image"
                                        src="<?php echo BASE_URL ?>/public/uploads/product_color/<?php echo $i['image'] ?>"
                                        height="50" width="50" alt="">
                                    <p>
                                        <span style="color: red">
                                            <?php echo number_format($i['price_product'], 0, ',', '.'); ?>đ
                                        </span>
                                    </p>
                                    </button>
                                
                                <?php } ?>

                                
                               

                            </div>

                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>





                    </div>
                    <div class="add-to-cart">
                        <button class="btn btn-success btn-addCart"
                            data-product_id="<?php echo $pro['id_product'] ?>">Thêm giỏ hàng
                        </button>

                        <a class="btn btn-danger btn-sm"
                            href="<?php echo BASE_URL ?>/wishlist/addWishlist/<?php echo $pro['id_product'] ?>">Thêm Sản
                            phẩm yêu thích</a>

                    </div>
                    <ul class="product-links">
                        <li>Danh mục:</li>
                        <?php
                            $firstCategoryPrinted = false; // Biến kiểm tra
                            foreach ($productcategory as $keys => $i) {
                                if (!$firstCategoryPrinted) { // Chỉ thực hiện khi chưa in giá trị đầu tiên
                                    echo '<li><a href="#">' . $i['title_category_product'] . '</a></li>';
                                    $firstCategoryPrinted = true; // Đánh dấu đã in giá trị đầu tiên
                                }
                            }
                            ?>
                    </ul>
                </div>
            </div>
            <?php if($arr_properties != "" && $arr_properties != null){ ?>
            <div class="row">
                <div class="col-md-12">
                    <div id="product-tab">
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Thông số kỹ thuật</a></li>
                        </ul>
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Thông số kỹ thuật</th>
                                        <th>Giá trị</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            foreach($arr_properties as $key => $value){
                                        ?>
                                    <tr>
                                        <td><?php echo $value['name'] ?></td>
                                        <td><?php echo $value['value'] ?></td>
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
            <?php }else{ ?>
            <div></div>
            <?php } ?>
            <!-- /Product details -->
            <!-- Product tab -->
            <?php if($pro['desc_product'] != "" && $pro['desc_product'] != null){ ?>
            <div class="row">
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Đặc điểm nổi bật</a></li>
                        </ul>
                        <!-- /product tab nav -->
                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            <?php echo $pro['desc_product'] ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab1  -->
                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div>
            </div>
            <?php }else{ ?>
            <div></div>
            <?php } ?>

            <div class="col-md-12" id="comments-section">
                <div id="product-tab">
                    <ul class="tab-nav">
                        <li class="active"><a data-toggle="tab" href="#tab1">Bình luận</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="comments">
                                        <ul>
                                            <?php
                                                foreach ($comments as $keys => $i) {
                                                    foreach ($user_name as $keys => $j) {
                                                            if($i['user_id']==$j['id_user']){
                                                        ?>
                                            <li>
                                                <h5>
                                                    <?php echo $j['name'] ?>: <span
                                                        style="color:#A9A9A9"><?php echo $i['created_at'] ?></span>

                                                </h5>
                                                <h5>
                                                    <span style="color: #696969;">
                                                        <?php echo $i['content'] ?>
                                                    </span>
                                                </h5>
                                            </li>
                                            <?php

                                                            }
                                                    }
                                                }
                                                ?>
                                        </ul>
                                    </div>

                                    <div class="comment-form">
                                        <h4>Đánh giá sản phẩm:</h4>
                                        <div>
                                            <ul class="rating_product">
                                                <?php
                                                    for($count=1; $count<=5; $count++){
                                                        if($count<=ceil($rating)){
                                                            $color = 'color: #8B0000';
                                                        }else{
                                                            $color = 'color: #696969';
                                                        }
                                                    
                                                ?>
                                                <li class="rating"
                                                    style="cursor:pointer; font-size:40px;<?php echo $color ?>"
                                                    id="<?php echo $pro['id_product'] ?>-<?php echo $count ?>"
                                                    data-product_id="<?php echo $pro['id_product'] ?>"
                                                    data-index="<?php echo $count ?>"
                                                    data-rating="<?php echo $count ?>">
                                                    &#9733;
                                                </li>
                                                <?php
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                        <h4>Để lại bình luận:</h4>

                                        <form id="comment_form" method="POST">
                                            <textarea class="form-control" id="comment_content"
                                                placeholder="Nhập bình luận của bạn"></textarea>
                                            <input type="hidden" id="product_id"
                                                value="<?php echo $pro['id_product'] ?>">
                                            <button class="btn btn-success btn-sm" style="margin-top:10px"
                                                type="submit">Gửi</button>
                                        </form>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
            <!-- /product tab -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
<!-- Section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Sản phẩm liên quan</h3>
                </div>
            </div>
            <!-- /section title -->
            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="products-slick" data-nav="#slick-nav-2">
                                <!-- product -->
                                <?php
                                foreach ($productcategory as $keys => $pro) {
                                    ?>
                                <div class="product">
                                    <div class="product-img">
                                        <a
                                            href="<?php echo BASE_URL ?>/product/productdetail/<?php echo $pro['id_category_product'] ?>/<?php echo $pro['id_product'] ?>">
                                            <img src="<?php echo BASE_URL ?>/public/uploads/product/<?php echo $pro['image_product'] ?>"
                                                style="height:250px" alt="">
                                        </a>

                                        <div class="product-label">
                                            <span class="sale">-30%</span>
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-name"><a
                                                href="<?php echo BASE_URL ?>/product/productdetail/<?php echo $pro['id_category_product'] ?>/<?php echo $pro['id_product'] ?>">
                                                <?php
                                                    echo $pro['title_product']
                                                        ?>
                                            </a>
                                        </h3>
                                        <h4 class="product-price">
                                            <?php
                                                echo $pro['selling_product'] . ' $'
                                                    ?>
                                            <del class="product-old-price">
                                                <?php
                                                    echo $pro['price_product'] . ' $'
                                                        ?>
                                            </del>
                                        </h4>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist"> <a
                                                    href="<?php echo BASE_URL ?>/wishlist/addWishlist/<?php echo $pro['id_product'] ?>"><i
                                                        class="fa fa-heart-o"></i></a><span class="tooltipp">add to
                                                    wishlist</span></button>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
                                        <a class="btn btn-danger"
                                            href="<?php echo BASE_URL ?>/product/productdetail/<?php echo $pro['id_category_product'] ?>/<?php echo $pro['id_product'] ?>">Xem
                                            chi tiết</a>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                                <!-- /product -->
                            </div>
                            <div id="slick-nav-2" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- /Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>




<script>
<?php include('product.js') ?>
</script>