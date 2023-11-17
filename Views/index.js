
$(document).ready(function() {
    var page = 1;
    var isLoading = false; // Biến để kiểm tra trạng thái đang tải

    $(".phantrang").on('click', function() {
        if (!isLoading) { // Kiểm tra xem có đang tải dữ liệu không
            isLoading = true; // Đánh dấu đang tải
            page++;
            loadProducts(page);
        }
    });

    function loadProducts(page) {
        $.ajax({
            url: '<?php echo BASE_URL ?>/home/loadmore',
            type: 'POST',
            data: {
                page: page
            },
            success: function(data) {
                if (data.length > 0) {
                    // console.log(data);
                    // Hiển thị sản phẩm dưới dạng HTML
                    var productsHtml = '';
                    for (var i = 0; i < data.length; i++) {
                        productsHtml += '<div class="col-md-3 col-xs-6">';
                        productsHtml += '<div class="product" style="height: 410px;">';
                        // Hiển thị thông tin sản phẩm
                        productsHtml += '<div class="product-img p-3">';
                        productsHtml +=
                            '<a href="<?php echo BASE_URL ?>/product/productdetail/' + data[i]
                            .id_category_product + '/' + data[i].id_product + '">';
                        productsHtml +=
                            '<img src="<?php echo BASE_URL ?>/public/uploads/product/' + data[i]
                            .image_product + '" alt="" style="height: 250px">';
                        productsHtml += '</a>';
                        productsHtml += '</div>';
                        productsHtml += '<div class="product-body">';
                        productsHtml +=
                            '<h3 class="product-name"><a href="<?php echo BASE_URL ?>/product/productdetail/' +
                            data[i].id_category_product + '/' + data[i].id_product + '">';
                        productsHtml += data[i].title_product;
                        productsHtml += '</a></h3>';
                        productsHtml += '<h4 class="product-price">$' + data[i]
                            .selling_product +'<del class="product-old-price">'+data[i].price_product+'$</del></h4>';
                            
                        productsHtml += '<div class="product-rating">'+
                        // Hiển thị đánh giá sản phẩm (nếu có)
                       ' <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star"></i>';
                       
                       
                        
                       

                        productsHtml += '</div>';
                        productsHtml += '<div class="product-btns">';
                        productsHtml +=
                            '<button class="add-to-wishlist"><a href="<?php echo BASE_URL ?>/wishlist/addWishlist/' +
                            data[i].id_product +
                            '"><i class="fa fa-heart-o"></i></a><span class="tooltipp">Add to wishlist</span></button>';
                        productsHtml += '</div>';
                        productsHtml += '</div>';
                        productsHtml += '<div class="add-to-cart">';
                        productsHtml +=
                            '<a class="btn btn-danger btn-sm" href="<?php echo BASE_URL ?>/product/productdetail/' +
                            data[i].id_category_product + '/' + data[i].id_product +
                            '">Xem chi tiết</a>';
                        productsHtml += '</div>';
                        productsHtml += '</div>';
                        productsHtml += '</div>';
                    }
                    $('#product-list').append(productsHtml);
                    isLoading = false; // Đánh dấu kết thúc tải dữ liệu
                } else {
                    $('.phantrang').hide();
                }
            },

            error: function() {
                isLoading = false; // Đánh dấu kết thúc tải dữ liệu trong trường hợp lỗi
                alert('Có lỗi sảy ra, vui lòng thử lại');
            }
        });
    }
});
