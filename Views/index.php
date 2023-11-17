
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Hot Products</h3>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                <?php
                                    foreach ($product_hot as $key => $pro):
                                    $sale = (($pro['price_product'] - $pro['selling_product']) / $pro['price_product']) * 100;
                                    $sale = ceil($sale);
                                    ?>
                                <div class="product">
                                    <div class="product-img p-3">
                                        <a
                                            href="<?php echo BASE_URL ?>/product/productdetail/<?php echo $pro['id_category_product'] ?>/<?php echo $pro['id_product'] ?>"><img
                                                src="<?php echo BASE_URL ?>/public/uploads/product/<?php echo $pro['image_product'] ?>"
                                                style="height:250px; width: 220px; padding:10px" alt=""></a>
                                        <div class="product-label">
                                            <span class="sale">-
                                                <?php echo $sale ?>%
                                            </span>
                                            <span class="new">Hot</span>
                                        </div>
                                    </div>
                                    <div class="product-body">

                                        <h3 class="product-name">
                                            <a
                                                href="<?php echo BASE_URL ?>/product/productdetail/<?php echo $pro['id_category_product'] ?>/<?php echo $pro['id_product'] ?>">
                                                <?php
                                                    echo $pro['title_product']
                                                ?>
                                            </a>
                                        </h3>
                                        <h4 class="product-price">
                                                <?php
                                                    echo number_format($pro['selling_product'], 0, ',', '.').'đ'
                                                ?>
                                            <del class="product-old-price">
                                                <?php
                                                    echo number_format($pro['price_product'], 0, ',', '.') . ' đ'
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
                                            <a class="add-to-wishlist"
                                                href="<?php echo BASE_URL ?>/wishlist/addWishlist/<?php echo $pro['id_product'] ?>"><i
                                                    class="fa fa-heart-o"></i></a>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
                                        <a class="btn btn-danger btn-sm"
                                            href="<?php echo BASE_URL ?>/product/productdetail/<?php echo $pro['id_category_product'] ?>/<?php echo $pro['id_product'] ?>">Xem
                                            chi tiết</a>
                                    </div>
                                </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div id="hot-deal" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                            <li>
                                <div>
                                    <h3>02</h3>
                                    <span>Days</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>10</h3>
                                    <span>Hours</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>34</h3>
                                    <span>Mins</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>60</h3>
                                    <span>Secs</span>
                                </div>
                            </li>
                        </ul>
                        <h2 class="text-uppercase">hot deal this week</h2>
                        <p>New Collection Up to 50% OFF</p>
                        <a class="primary-btn cta-btn" href="#">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Top selling</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <div id="tab2" class="tab-pane fade in active">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    <?php
                                    foreach ($product_selling as $keys => $pro) {
                                        $sale = (($pro['price_product'] - $pro['selling_product']) / $pro['price_product']) * 100;
                                        $sale = ceil($sale);
                                        ?>
                                    <div class="product">
                                        <div class="product-img p-3">
                                            <a
                                                href="<?php echo BASE_URL ?>/product/productdetail/<?php echo $pro['id_category_product'] ?>/<?php echo $pro['id_product'] ?>">
                                                <img src="<?php echo BASE_URL ?>/public/uploads/product/<?php echo $pro['image_product'] ?>"
                                                    alt="" style="height:250px; padding:10px">
                                            </a>
                                            <div class="product-label">
                                                <span class="sale">-
                                                    <?php echo $sale ?>%
                                                </span>
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
                                                        echo number_format($pro['selling_product'], 0, ',', '.').'đ'
                                                    ?>
                                                <del class="product-old-price">
                                                    <?php
                                                        echo number_format($pro['price_product'], 0, ',', '.').'đ'
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
                                                <a class="add-to-wishlist"
                                                    href="<?php echo BASE_URL ?>/wishlist/addWishlist/<?php echo $pro['id_product'] ?>"><i
                                                        class="fa fa-heart-o"></i></a>

                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <a class="btn btn-danger btn-sm"
                                                href="<?php echo BASE_URL ?>/product/productdetail/<?php echo $pro['id_category_product'] ?>/<?php echo $pro['id_product'] ?>">Xem
                                                chi tiết</a>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Tất cả sản phẩm</h3>
                    </div>
                </div>
            </div>
            <div class="row" id="product-list">
                <?php
                    foreach ($products as $key => $i):
                        $sale = (($i['price_product'] - $i['selling_product']) / $i['price_product']) * 100;
                        $sale = ceil($sale);
                    ?>
                <div class="col-md-3 col-xs-6">
                    <div class="product" style="height: 410px;">
                        <div class="product-img">
                            <a
                                href="<?php echo BASE_URL ?>/product/productdetail/<?php echo $i['id_category_product'] ?>/<?php echo $i['id_product'] ?>"><img
                                    src="<?php echo BASE_URL ?>/public/uploads/product/<?php echo $i['image_product'] ?>"
                                    style="height:250px" alt=""></a>
                            <div class="product-label">
                                <span class="sale">-
                                    <?php echo $sale ?>%
                                </span>
                                <span class="new">NEW</span>
                            </div>
                        </div>
                        <div class="product-body">
                            <h3 class="product-name"><a
                                    href="<?php echo BASE_URL ?>/product/productdetail/<?php echo $i['id_category_product'] ?>/<?php echo $i['id_product'] ?>">
                                    <?php echo $i['title_product'] ?>
                                </a>
                            </h3>
                            <h4 class="product-price">$
                                <?php  echo number_format($pro['selling_product'], 0, ',', '.').'đ' ?><del class="product-old-price">
                                    <?php  echo number_format($pro['price_product'], 0, ',', '.').'đ' ?>
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
                                        href="<?php echo BASE_URL ?>/wishlist/addWishlist/<?php echo $i['id_product'] ?>"><i
                                            class="fa fa-heart-o"></i></a><span class="tooltipp">add to
                                        wishlist</span></button>

                            </div>
                        </div>
                        <div class="add-to-cart">
                            <a class="btn btn-danger btn-sm"
                                href="<?php echo BASE_URL ?>/product/productdetail/<?php echo $i['id_category_product'] ?>/<?php echo $i['id_product'] ?>">Xem
                                chi tiết</a>

                        </div>
                    </div>
                </div>
                <?php
                    endforeach;
                    ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-success btn-block phantrang">
                        Xem thêm
                    </button>
                </div>
            </div>

        </div>
    </div>

 <script>
    <?php include('index.js') ?>
 </script>