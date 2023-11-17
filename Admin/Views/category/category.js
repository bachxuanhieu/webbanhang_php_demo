
$(document).ready(function(){

    //chay thử js:
    // $('#javascipts').on('click', function(){
    //     alert('hieu dep trai');
    // })

    // xóa danh mục
    $('.delete-category').on('click', function() {
    var categoryId = $(this).attr('data-category-id');
       
            $.ajax({
                type: 'POST',
                url: '<?php echo BASE_URL; ?>/admin/category/deleteCategory/' + categoryId,
                success: function(response) {
                    if (response.success) {
                        // Phản hồi thành công từ máy chủ
                        alert(response.message);
                        // Làm mới trang sau khi xóa thành công
                        location.reload();
                    } else {
                        // Xử lý lỗi nếu cần
                        alert(response.message);
                    }
                },
                error: function() {
                    // Xử lý lỗi kết nối
                    alert('Lỗi kết nối đến máy chủ');
                }
            });
        
    });

    // chỉnh sửa
    $('.edit-category').on('click',function(){
        var categoryId = $(this).attr('data-category-id');
        
        $.ajax({
            type:'GET',
            url: '<?php echo BASE_URL; ?>/admin/category/editCategory/' + categoryId,
            success: function(response) {
                console.log(response);
                if (response.success) { 
                    // Hiển thị thông tin danh mục trong modal
                    var categoryArray = response.category; // Nhận được một mảng
                        if (categoryArray.length > 0) {
                            var category = categoryArray[0]; // Lấy đối tượng đầu tiên từ mảng (nếu có)
                            // console.log(category);
                            $('#edit_title_category_product').val(category.title_category_product);
                            $('#edit_id_category_product').val(category.id_category_product);
                        
                            $('#edit_status_checkbox').prop('checked', category.status == 1);
                            $('#edit_desc_category_product').val(category.desc_category_product);
                        } else {
                            console.log("Không có danh mục nào được trả về từ máy chủ.");
                        }
                } else {
                    // Xử lý lỗi nếu cần
                    alert(response.message);
                }
            },
            error: function() {
                // Xử lý lỗi kết nối
                alert('Lỗi kết nối đến máy chủ');
            }
        }) 
        // Đoạn mã JavaScript để xử lý sự kiện khi người dùng lưu chỉnh sửa danh mục
            $('#button_edit').on('click', function() {
                var categoryId = $('#edit_id_category_product').val();
                var editedTitle = $('#edit_title_category_product').val();
                var editedStatus = $('#edit_status_checkbox').is(':checked') ? 1 : 0;
                var editedDesc = $('#edit_desc_category_product').val();
               

           

                // Kiểm tra điều kiện trước khi gửi AJAX request
                if (editedTitle === "" || editedDesc === "") {
                    alert("Không được bỏ trống");
                } else {
                    // Sử dụng AJAX để gửi các thay đổi lên máy chủ
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo BASE_URL; ?>/admin/category/updateCategory/'+categoryId, // Đặt URL phù hợp với tên phương thức chỉnh sửa ở phía máy chủ
                        data: { 
                            title: editedTitle,
                            status: editedStatus,
                            desc: editedDesc
                        },
                        
                        success: function(response) {
                            // console.log(data);
                            if (response.success) {
                                // Phản hồi thành công từ máy chủ
                                alert('Chỉnh sửa danh mục thành công');
                                // Làm mới trang sau khi thành công
                                var modal = $('#editCategoryModal');
                                modal.modal('hide');
                                location.reload();
                            } else {
                                // Xử lý lỗi nếu cần
                                alert("Danh mục đã tồn tại");
                            }
                        },
                        error: function() {
                            // Xử lý lỗi kết nối
                            alert('Lỗi kết nối đến máy chủ');
                        }
                    });
                }
            });

         
                       
    })

    //thêm danh mục

    $('#button_add').on('click', function() {
    var title = $('#title_category_product').val();
    var status = $('#status_checkbox').is(':checked') ? 1 : 0;
    var desc = $('#desc_category_product').val();

    // Kiểm tra điều kiện trước khi gửi AJAX request
        if (title === "" || desc === "") {
            alert("Không được bỏ trống");
        } else {
            var formData = new FormData(); // Khởi tạo đối tượng FormData

            // Thêm dữ liệu vào formData
            formData.append('title', title);
            formData.append('status', status);
            formData.append('desc', desc);

            $.ajax
            ({
                type: 'POST',
                url: '<?php echo BASE_URL; ?>/admin/category/insertcategory',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        // Phản hồi thành công từ máy chủ
                        alert('Thêm danh mục thành công');
                        // Làm mới trang sau khi thành công
                        var modal = $('#addCategoryModal');
                        modal.modal('hide');
                        location.reload();
                    } else {
                        // Xử lý lỗi nếu cần
                        alert("Danh mục đã tồn tại, hãy kiểm tra lại trong danh mục ẩn");
                    }
                },
                error: function() {
                    // Xử lý lỗi kết nối
                    alert('Lỗi kết nối đến máy chủ');
                }
            });
        }
    });

    $('.toggle-hidden-status').on('click',function(){
        var categoryId = $(this).attr('data-category-id');
        // alert(categoryId);
        $.ajax({
            type: 'GET',
            url: '<?php echo BASE_URL; ?>/admin/category/toggle_status/'+categoryId,
            success:function(response){
                if(response.success){
                    location.reload();
                }else{
                    alert('Lỗi khi ẩn danh mục')
                }
            },error: function(){
                alert('Lỗi kết nối máy chủ')
            }
        })

    });
    $('.toggle-show-status').on('click',function(){
        var categoryId = $(this).attr('data-category-id');
        // alert(categoryId);
        $.ajax({
            type: 'GET',
            url: '<?php echo BASE_URL; ?>/admin/category/toggle_status2/'+categoryId,
            success:function(response){
                if(response.success){
                    location.reload();
                }else{
                    alert('Lỗi khi hiển thị danh mục')
                }
            },error: function(){
                alert('Lỗi kết nối máy chủ')
            }
        })

    });


});



// document.addEventListener('DOMContentLoaded', function() {
// var toggleButtons = document.querySelectorAll('.toggle-status');

// toggleButtons.forEach(function(button) {
//     button.addEventListener('click', function() {
//         var categoryId = button.getAttribute('data-category-id');
//         var xhr = new XMLHttpRequest();
//         xhr.open('POST', '<?php echo BASE_URL; ?>/admin/category/toggle_status', true);
//         xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//         xhr.onreadystatechange = function() {
//             if (xhr.readyState === 4 && xhr.status === 200) {
//                 // Tải lại trang sau khi cập nhật trạng thái danh mục
//                 location.reload();
//             }
//         };
//         xhr.send('categoryId=' + categoryId);
//     });
// });

// // Bắt sự kiện khi ấn "Hiển thị" trong modal danh sách đã ẩn
// var modalToggleButtons = document.querySelectorAll('.modal .toggle-status');
// modalToggleButtons.forEach(function(modalButton) {
//     modalButton.addEventListener('click', function() {
//         var categoryId = modalButton.getAttribute('data-category-id');
//         var xhr = new XMLHttpRequest();
//         xhr.open('POST', '<?php echo BASE_URL; ?>/admin/category/toggle_status2', true);
//         xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//         xhr.onreadystatechange = function() {
//             if (xhr.readyState === 4 && xhr.status === 200) {
//                 // Tải lại trang sau khi cập nhật trạng thái danh mục
//                 location.reload();
//             }
//         };
//         xhr.send('categoryId=' + categoryId);
//     });
// });
// });
