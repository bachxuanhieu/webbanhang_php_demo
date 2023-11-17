
$(document).ready(function() {
  
    $('.edit-brand').on('click', function() {
        var brandId = $(this).attr('data-id-brand');

        // alert(brandId);

        $.ajax({
            type: 'GET',
            url: '<?php echo BASE_URL ?>/admin/brand/editBrand/' + brandId,
            success: function(response) {
                if (response.success) {
                    var brandArray = response.brand;
                  
                    if (brandArray.length > 0) {
                        var brand = brandArray[0];
                        console.log(brand);
                        $('#edit_title_brand').val(brand.title_brand);
                        $('#edit_id_brand').val(brand.id_brand);
                        $('#edit_desc_brand').val(brand.desc_brand);
                        $('#edit_category_product').val(brand.id_category_product);
                    } else {
                        alert("Không có danh mục nào được trả về");
                    }
                } else {
                    alert(response.message);
                }
                // alert("đã lấy được brand");
            },
            error: function() {
                alert("lỗi kết nối dữ liệu");
            }
        });
    });


    $('.edit_brand_button').on('click', function() {
        var brandId = $('#edit_id_brand').val();
        var title = $('#edit_title_brand').val();
        var desc = $('#edit_desc_brand').val();
        var category = $('#edit_category_product').val();

       data={
        brandId:brandId,
        title: title,
        desc: desc,
        category: category
       };
       console.log(data);

        $.ajax({
            type: 'POST',
            url: '<?php echo BASE_URL ?>/admin/brand/updatebrand',
            data:data,
            success: function(responre) {
                if (responre.success) {
                    console.log(responre);
                    alert('Chỉnh sửa nhãn hàng thành công');
                    var modal = $('#editBrandModal');
                    modal.modal('hide');
                    // location.reload();
                } else {
                    alert("Lỗi chỉnh sửa");
                }
            },
            error: function() {
                alert('Lỗi kết nối máy chủ');
            }
        });

    });


    // thêm nhãn hàng===================================================================================================================================================================
    $('#add_brand_button').click(function() {
    var title = $('#title_brand').val();
    var desc = $('#desc_brand').val();
    var category_product = $('#category_product').val();

    if (title === "" || desc === "") {
        alert("Không được để trống");
        return;
    }

    var data = {
        title: title,
        desc: desc,
        category_product: category_product
    };

    $.ajax({
        type: 'POST',
        url: '<?php echo BASE_URL ?>/admin/brand/addBrand', 
        data: data,
        success: function(response) {
            if (response.success) {
                // Thêm dòng mới vào bảng dữ liệu
                var newRow = '<tr>' +
                    '<td>' + response.id + '</td>' +
                    '<td>' + title + '</td>' +
                    '<td>' + desc + '</td>' +
                    '<td>' + category_product + '</td>' +
                    '<td>' +
                    // Thêm các nút sửa và xóa
                    '</td>' +
                    '</tr>';
                $('table tbody').append(newRow);

                // // Đóng modal và xóa dữ liệu trong form
                alert('Thêm danh mục thành công');
                $('#addBrandModal').modal('hide');
               
            } else {
                alert("Lỗi thêm nhãn hàng");
            }
        },
        error: function() {
            alert('Lỗi kết nối máy chủ');
        }
    });
    });
    // xóa nhãn hàng====================================================================================================================================================================
    $('.delete-brand').on('click', function() {
    var brandId = $(this).attr('data-delete-brand-id');

    $.ajax({
        type: 'POST',
        url: '<?php echo BASE_URL ?>/admin/brand/deleteBrand/' + brandId, // Thay đổi thành đúng đường dẫn của tệp xử lý xóa nhãn hàng
        data: { brandId: brandId },
        success: function(response) {
            if (response.success) {
                // Loại bỏ dòng khỏi bảng dữ liệu
                alert('Xóa nhãn hàng thành công');
                $('#deleteBrandModal').modal('hide');
                location.reload();
            } else {
                alert("Lỗi xóa nhãn hàng");
            }
        },
        error: function() {
            alert('Lỗi kết nối máy chủ');
        }
    });
    });
    // chỉnh sửa nhãn hàng: b1: lấy thông tin chỉnh sửa=====================================================================================================================================

 

    // b2: chỉnh sửa thông tin

  

// thay đổi trạng thái ==============================================================================================================================================================================================
    $('.toggle-hiden-status').on('click', function() {
        var brandId = $(this).attr('data-brandstatus-id');
      
        // Gửi yêu cầu AJAX để thay đổi trạng thái
        $.ajax({
            type: 'GET',
            url: '<?php echo BASE_URL ?>/admin/brand/toggleStatus/' + brandId,
          
            success: function(response) {
                if (response.success) {
                    // Thay đổi văn bản của nút và cột "Trạng thái" dựa trên trạng thái mới
                       
                        location.reload();
                } else {
                    alert('Lỗi khi thay đổi trạng thái');
                }
            },
            error: function() {
                alert('Lỗi kết nối máy chủ');
            }
        });
    });


    $('.toggle-show-status').on('click', function() {
        var brandId = $(this).attr('data-brand-id');
      
        // Gửi yêu cầu AJAX để thay đổi trạng thái
        $.ajax({
            type: 'GET',
            url: '<?php echo BASE_URL ?>/admin/brand/toggleStatus2/' + brandId,
          
            success: function(response) {
                if (response.success) {
                    // Thay đổi văn bản của nút và cột "Trạng thái" dựa trên trạng thái mới
                      
                        location.reload();
                } else {
                    alert('Lỗi khi thay đổi trạng thái');
                }
            },
            error: function() {
                alert('Lỗi kết nối máy chủ');
            }
        });
    });



});
