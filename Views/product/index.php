<div class="section">
    <div class="container">
        <div class="row">
            <div id="aside" class="col-md-3">
                <div class="aside">
                    <h3 class="aside-title">Nhãn hàng</h3>
                    <div class="checkbox-filter">
                        <?php
                  
                     foreach($brands as $key =>$i){
                      
                     ?>
                        <div class="input-checkbox">
                            <label for="brand-1">
                                <span></span>
                                <!-- <a href="<?php echo BASE_URL ?>/product/product_brand/<?php echo $i['title_brand'] ?>/<?php echo $i['id_category_product'] ?>"><?php echo $i['title_brand']  ?></a> -->
                                <button class="btn btn-light btn-sm brand_button" style="width:200px"
                                    data-id-category="<?php echo $i['id_category_product'] ?>"
                                    data-id-brand="<?php echo $i['id_brand'] ?>"><?php echo $i['title_brand']  ?>
                                </button>
                                <small> </small>
                            </label>
                        </div>
                        <?php
                     }
                     ?>
                    </div>
                </div>
                <div class="aside">
                    <h3 class="aside-title">Giá</h3>
                    <div class="checkbox-filter">
                        <div class="input-checkbox">
                            <label for="brand-1">
                                <span></span>
                                <!-- <a
                                    href="<?php echo BASE_URL ?>/product/sort/low-to-high/<?php echo $i['id_category_product']; ?>">Thấp
                                    đến cao</a> -->
    <!-- =============================================================================== Sắp xếp ==================================================================================================== -->
                                
                                    <button class="btn btn-light btn-sm  sort_button" data-type-sort="low-to-high" data-id-category="<?php echo $i['id_category_product'] ?>" style="width:200px; margin-bottom: 10px">Thấp đến cao</button>

                                    <br>


                                    <button class="btn btn-light btn-sm sort_button" data-type-sort="high-to-low" data-id-category="<?php echo $i['id_category_product'] ?>" style="width:200px">Cao đến thấp</button>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="aside">
                    <h3 class="aside-title">Top selling</h3>
                    <?php
                  foreach($product_selling as $keys=> $pro){
                  ?>
                    <div class="product-widget">
                        <div class="product-img">
                            <img src="<?php echo BASE_URL ?>/public/uploads/product/<?php echo $pro['image_product'] ?>"
                                alt="">
                        </div>
                        <div class="product-body">
                            <h3 class="product-name">
                                <a
                                    href="<?php echo BASE_URL ?>/product/productdetail/<?php echo $pro['id_category_product'] ?>/<?php echo $pro['id_product'] ?>/<?php echo $pro['seri_product'] ?>">
                                    <?php
                                    echo $pro['title_product']     
                           ?>
                                </a>
                            </h3>
                            <h4 class="product-price"><?php echo number_format($pro['selling_product'], 0, ',', '.')?>đ<del
                                    class="product-old-price"><?php echo number_format($pro['price_product'], 0, ',', '.')?>đ</del></h4>
                        </div>
                    </div>
                    <?php
                  }
                  ?>
                </div>
            </div>
            <div id="store" class="col-md-9">
                <div class="row" id="product-list">
                    <?php 
                  foreach ($productcategoy as $key => $i): 
                     $sale = (($i['price_product'] - $i['selling_product']) / $i['price_product']) * 100;
                     $sale = ceil($sale);
               ?>

                    <div class="col-md-4 col-xs-6 ">
                        <div class="product" style="height: 450px">
                            <div class="product-img">
                                <a
                                    href="<?php echo BASE_URL ?>/product/productdetail/<?php echo $i['id_category_product'] ?>/<?php echo $i['id_product'] ?>"><img
                                        src="<?php echo BASE_URL ?>/public/uploads/product/<?php echo $i['image_product'] ?>"
                                        style="height:250px" alt=""></a>
                                <div class="product-label">
                                    <span class="sale">-<?php echo $sale ?>%</span>
                                    <span class="new">NEW</span>
                                </div>
                            </div>
                            <div class="product-body" style="height: 200px">
                                <p class="product-category"><?php echo $i['title_category_product']?></p>
                                <h3 class="product-name"><a
                                        href="<?php echo BASE_URL ?>/product/productdetail/<?php echo $i['id_category_product'] ?>/<?php echo $i['id_product'] ?>"><?php echo $i['title_product']?></a>
                                </h3>
                                <h4 class="product-price"><?php echo number_format($i['selling_product'], 0, ',', '.')?>đ<del
                                        class="product-old-price"><?php echo number_format($i['price_product'], 0, ',', '.')?>đ</del></h4>
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
                    <div class="store-filter clearfix">
                        <span class="store-qty">Showing 1-100 products</span>
                        <ul class="store-pagination">
                            <?php
                     for($j=1;$j<=$product_button;$j++){
                     
                  ?>
                            <li> <a
                                    href="<?php echo BASE_URL ?>/product/product_category/<?php echo $i['id_category_product'] ?>?trang=<?php echo $j ?>"><?php echo $j ?></a>
                            </li>
                            <?php
                     }
                  ?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<script>
$(document).ready(function() {
    $('.brand_button').on('click', function() {
        var id = $(this).attr('data-id-category');
        var id_brand = $(this).attr('data-id-brand');
        $.ajax({
            type: 'GET',
            url: '<?php echo BASE_URL ?>/product/productBrand/' + id_brand + '/' + id,
            dataType: "json",
            success: function(produtcs) {
                FilteredProduct(produtcs);
            },
            error: function() {
                alert('Lỗi khi lọc sản phẩm');
            }
        })
    });
   //  ============================ phương thức sắp xếp ======================================
    $('.sort_button').on('click', function(){
      var type = $(this).attr('data-type-sort');

      var category=$(this).attr('data-id-category');

      console.log(type);

      $.ajax({
        type: 'GET',
        url: '<?php echo BASE_URL ?>/product/sort/' + type + '/' + category,
        dataType: "json",
            success: function(produtcs) {
                FilteredProduct(produtcs);
            },
            error: function() {
                alert('Lỗi khi lọc sản phẩm');
            }
      })
      
    })

    function FilteredProduct(products) {
        $('#product-list').empty();

        // Hiển thị sản phẩm lọc được
        for (var i = 0; i < products.length; i++) {
            // Tạo mã HTML hiển thị sản phẩm và thêm vào danh sách
            var productsHtml = '<div class="col-md-4 col-xs-6">';
            productsHtml += '<div class="product" style="height: 410px">';
            productsHtml += '<div class="product-img">';
            productsHtml +=
                '<a href="<?php echo BASE_URL ?>/product/productdetail/' + products[i]
                .id_category_product + '/' + products[i].id_product + '">';
            productsHtml +=
                '<img src="<?php echo BASE_URL ?>/public/uploads/product/' + products[i]
                .image_product + '" alt="" style="height: 250px">';
            productsHtml += '</a>';
            productsHtml += '</div>';
            productsHtml += '<div class="product-body">';
            productsHtml +=
                '<h3 class="product-name"><a href="<?php echo BASE_URL ?>/product/productdetail/' +
                products[i].id_category_product + '/' + products[i].id_product + '">';
            productsHtml += products[i].title_product;
            productsHtml += '</a></h3>';
            productsHtml += '<h4 class="product-price">$' + products[i]
                .selling_product + '</h4>';
            productsHtml += '<div class="product-rating">';
            // Hiển thị đánh giá sản phẩm (nếu có)

            productsHtml += '</div>';
            productsHtml += '<div class="product-btns">';
            productsHtml +=
                '<button class="add-to-wishlist"><a href="<?php echo BASE_URL ?>/wishlist/addWishlist/' +
                products[i].id_product +
                '"><i class="fa fa-heart-o"></i></a><span class="tooltipp">Add to wishlist</span></button>';
            productsHtml += '</div>';
            productsHtml += '</div>';
            productsHtml += '<div class="add-to-cart">';
            productsHtml +=
                '<a class="btn btn-danger btn-sm" href="<?php echo BASE_URL ?>/product/productdetail/' +
                products[i].id_category_product + '/' + products[i].id_product +
                '">Xem chi tiết</a>';
            productsHtml += '</div>';
            productsHtml += '</div>';
            productsHtml += '</div>';
            $('#product-list').append(productsHtml);
        }
    }
})
</script>