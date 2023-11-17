
$(document).ready(function() {
var selectedColorId= null;
var selectedNewPrice = null;
    $('.btn-color').on('click', function() {
        selectedColorId = $(this).data('color-id'); // Lấy giá trị data-color-id của nút màu
        // console.log('Color ID selected: ' + selectedColorId);
        selectedNewPrice = parseFloat($(this).find('span').text().replace(/[đ,.]/g, '').replace(',', '.'));
        
     
    });
    $('.btn-addCart').on('click',function(){
        if(selectedColorId=== null){
            alert('Bạn hãy chọn màu sản phẩm');
        } else {
            // Sử dụng selectedColorId để thêm sản phẩm vào giỏ hàng
            var colorId = selectedColorId;
            var newPrice = selectedNewPrice;
            var productId = $(this).attr("data-product_id");
           
            $.ajax({
                type: 'POST',
                url: "<?php echo BASE_URL ?>/cart/addCart",
                data:{
                    colorId: colorId,
                    productId: productId,
                    newPrice: newPrice 
                },
                dataType: 'json',
                success:function(response){
                    console.log(response);
                    if(response.success){
                        window.location.href = '<?php echo BASE_URL ?>/cart/cartlist';
                        alert("Thêm giỏ hàng thành công");
                    }else{
                        alert("Lỗi thêm giỏ hàng");
                    }
                }, error: function(){
                    alert('Bạn hãy đăng nhập trước!');
                }
            })
        }
    })
    
    // chỉnh sửa load ảnh:===========================================================================
    $('.thumbnail-image').on('click', function() {
        // Lấy đường dẫn của hình nhỏ được click
        var newImageUrl = $(this).attr('src');

        // Thay đổi đường dẫn của hình lớn
        $('.main-image').attr('src', newImageUrl);
    });
    $('.btn-color').on('click', function () {
        var newImageUrl = $(this).find('img').attr('src');
        $('.main-image').attr('src', newImageUrl);


        // Lấy giá trị giá sản phẩm từ nút màu
        var newPrice = parseFloat($(this).find('span').text().replace(/[đ,.]/g, '').replace(',', '.'));
       
        // Cập nhật giá sản phẩm trên giao diện
        $('.product-price').text(newPrice.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
    });


    // phần comment===================================================================================


    $('#comment_form').submit(function(e) {
        e.preventDefault();
        var comment = $('#comment_content').val();
        var productId = $('#product_id').val(); // Lấy giá trị từ biến toàn cục
        var data = {
            comment: comment,
            productId: productId,
        };
        $.ajax({
            type: 'POST',
            url: '<?php echo BASE_URL ?>/product/addComment',
            data: data,
            success: function(response) {
                if (response.status === "success") {
                    // console.log(data);
                    var commentHtml = '<li><h5>' + response.name +
                        ':</h5><span style="color: black;">' + response.content +
                        '</span></p></li>';
                    $('.comments ul').append(commentHtml);
                    // Xóa nội dung biểu mẫu
                    $('.comment-form textarea').val('');
                } else {
                    alert('bạn cần đăng nhập trước');
                }
            },
            error: function() {
                alert('Có lỗi xảy ra khi gửi bình luận.');
            }
        });
    });

    // phần load comment ==================================================================================================

    $('.review-link').on('click', function(e) {
        e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
        $('html, body').animate({
            scrollTop: $('#comments-section').offset().top
        }, 'slow'); // Cuộn xuống phần bình luận một cách mượt
    });


    // phần đánh giá sao: =================================================================================================
    function remove_background(product_id){
        for(var count = 1; count <= 5; count++){
            $('#'+product_id+'-'+count).css('color','#696969');
        }
    }

    // hover chuột đánh giá sao.=============================================================================================
    $(document).on('mouseenter','.rating',function(){
        var index = $(this).data('index');
        var product_id = $(this).data('product_id');
        // alert(index);
        // alert(product_id);
        remove_background(product_id);
        for(var count = 1; count<= index; count++){
            $('#'+product_id+'-'+count).css('color','#8B0000');
        }
    });

    // nhả chuột không đánh giá sao:==========================================================================================

    $(document).on('mouseleave','.rating',function(){
        var index = $(this).data('index');
        var product_id = $(this).data('product_id');
        var rating = $(this).data('rating');
        // alert(index);
        // alert(product_id);
        remove_background(product_id);
        for(var count = 1; count<= rating; count++){
            $('#'+product_id+'-'+count).css('color','#8B0000');
        }
    });

    // click chuột đánh giá sao:=================================================================================================

    $('.rating').on('click',function(){
        var index = $(this).data('index');
        var product_id = $(this).data('product_id');
        //  alert(index);
        // alert(product_id);
        $.ajax({
                type: 'POST',
                url: '<?php echo BASE_URL ?>/product/addRating', 
                data:{
                    index:index,
                    product_id:product_id,

                },
                success:function(response){
                    console.log(response);
                    if (response.status === "success") {
                        alert('đánh giá sao thành công');
                    } else {
                        alert("bạn cần đăng nhập trước để bình luận");
                        window.location.href = '<?php echo BASE_URL ?>/user/index';
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi gửi bình luận.');
                }
            });
    });



});
