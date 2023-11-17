

$(document).ready(function() {
    // Bắt sự kiện khi người dùng submit form tìm kiếm
    $('#searchForm').submit(function(e) {
        e.preventDefault();
        var keyword = $('#searchInput').val();
        searchPosts(keyword);
    });

    // Hàm thực hiện tìm kiếm bài viết bằng AJAX
    function searchPosts(keyword) {
        $.ajax({
            type: 'GET',
            url: '<?php echo BASE_URL ?>/admin/newdt/searchnewdt',
            data: { keyword: keyword },
            success: function(response) {
                if (response.success) {
                    // Cập nhật danh sách bài viết sau khi tìm kiếm
                    updatePostTable(response.newdts);
                } else {
                    alert('Không tìm thấy bài viết.');
                }
            },
            error: function() {
                alert('Lỗi kết nối máy chủ.');
            }
        });
    }

    // Hàm cập nhật bảng danh sách bài viết
    
    function updatePostTable(newdts) {
        var tbody = $('tbody');
        tbody.empty();

        $.each(newdts, function(index, newdt) {
            var row = '<tr>' +
            '<td>' + newdt.id_post + '</td>' +
            '<td><img src="<?php echo BASE_URL ?>/public/uploads/new/' + newdt.image_post + '" height="100" width="100" alt=""></td>' +
            '<td style="width:300px">' + newdt.title_post + '</td>' +
            '<td>' + newdt.id_category_post + '</td>' +
            '<td>' +
            '<button class="btn btn-warning btn-sm m-1 toggle-hidden-status" data-newdt-id="'+newdt.id_post+'">' +' Ẩn'
             +
            '</button>' +
            '<button data-bs-toggle="modal" data-bs-target="#deletepost" class="btn btn-danger btn-sm m-1">Xóa</button>' +
            '<div class="modal fade" id="deletepost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
            '<div class="modal-dialog">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<h5 class="modal-title" id="exampleModalLabel">Xóa bài viết</h5>' +
            '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
            '</div>' +
            '<div class="modal-body">' +
            'Dữ liệu bài viết sẽ bị xóa. Bạn có muốn xóa?' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-info m-1" data-bs-dismiss="modal">No</button>' +
            '<a href="<?php echo BASE_URL ?>/admin/newdt/deletenewdt/' + newdt.id_post + '" type="button" class="btn btn-danger">Yes</a>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<a href="<?php echo BASE_URL ?>/admin/newdt/editnewdt/' + newdt.id_post + '" class="btn btn-info btn-sm ">Sửa</a>' +
            '</td>' +
            '</tr>';

            tbody.append(row);
        });
    }

        $('.hidden-newdt-list').on('click', '.toggle-show-status', function() {
            var newdtId = $(this).attr('data-brand-id');
            // alert(newdtId);
            // Gửi yêu cầu AJAX để thay đổi trạng thái và cập nhật lại bảng
            $.ajax({
                type: 'GET',
                url: '<?php echo BASE_URL ?>/admin/newdt/toggleShowStatus/' + newdtId,
                success: function(response) {
                    if (response.success) {
                        // updateHiddenNewdtTable(response.hiddenNewdts);
                        location.reload();
                        // updatePostTable(responre.newdts);
                        // Sau khi cập nhật, bạn có thể thực hiện các hành động khác (nếu cần)
                    } else {
                        alert('Lỗi khi thay đổi trạng thái');
                    }
                },
                error: function() {
                    alert('Lỗi kết nối máy chủ');
                }
            });
        });
    // ====================================================================================================================================
    $('.newdt-list').on('click', '.toggle-hidden-status', function() {
        var newdtId = $(this).attr('data-newdt-id');
        // alert(newdtId);
        $.ajax({
            type: 'GET',
            url: '<?php echo BASE_URL ?>/admin/newdt/toggleStatus/'+newdtId,

            success: function(responre){
                if(responre.success){
                    // updatePostTable(responre.newdts);
                    // updateHiddenNewdtTable(response.hiddenNewdts);
                    location.reload();
                }else{
                    alert('Lỗi khi thay đổi trạng thái');
                }
            },
            error:function(){
                alert('Lỗi kết nối máy chủ');
            }
        })
    })
});

