
$(document).ready(function () {
    var table = $('#tbodyTableUser');

    // =======================================================thêm user======================================================
    $('#add_user_button').click(function (event) { // Thêm đối số event
        event.preventDefault(); // Ngăn chặn hành vi mặc định của nút submit

        // Bây giờ bạn có thể tiếp tục với việc kiểm tra và gửi AJAX request
        var name = $('#name').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var password2 = $('#password2').val();
        var address = $('#address').val();

        if (name.trim() === '') {
            alert('Vui lòng nhập tên người dùng.');
            return;
        }

        var phonePattern = /^\d{10}$/;
        if (!phonePattern.test(phone)) {
            alert('Vui lòng nhập số điện thoại gồm 10 chữ số.');
            return;
        }

        // Kiểm tra định dạng email
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!emailPattern.test(email)) {
            alert('Vui lòng nhập một địa chỉ email hợp lệ.');
            return;
        }

        if (password.trim() === '' || password !== password2) {
            alert('Nhập lại mật khẩu không khớp.');
            return;
        }

        var data = {
            name: name,
            email: email,
            phone: phone,
            password: password,
            address: address
        };


        $.ajax({
            type: 'POST',
            url: '<?php echo BASE_URL ?>/admin/user/add_user',
            data: data,
            success: function (response) {
                if (response.success) {
                    // Phản hồi thành công từ máy chủ
                    alert('Thêm người dùng thành công');
                    // Tùy chỉnh các hành động khác (ví dụ: làm mới danh sách người dùng)
                    var modal = $('#addUserModal');
                    modal.modal('hide');
                    location.reload();
                } else {
                    // Xử lý lỗi nếu cần
                    alert("email hoặc số điện thoại đã sử dụng");
                    // console.log(response);
                }
            },
            error: function () {
                // Xử lý lỗi kết nối
                alert('Lỗi kết nối đến máy chủ');
            }
        });
    });

    $('#searchUserForm').submit(function (event) {
        event.preventDefault();
        var keyword = $('#searchInput').val();

        $.ajax({
            type: 'GET',
            url: '<?php echo BASE_URL ?>/admin/user/searchUser',
            data: {
                keyword: keyword
            },
            success: function (response) {
                if (response.success) {
                    updateUserTable(response.users);
                } else {
                    alert('Không tìm thấy người dùng');
                }
            },
            error: function () {
                alert('Lỗi kết nối đến máy chủ');
            }
        });
    });

    // =======================================================sửa user======================================================



    // Bắt sự kiện khi nút chỉnh sửa được nhấn
    $('.edit_user_button').on('click', function (event) {
        event.preventDefault();

        // Lấy thông tin từ các trường trong modal
        var id = $('.edit-id').val();
        var name = $('.edit-name').val();
        var phone = $('.edit-phone').val();
        var email = $('.edit-email').val();
        var password = $('.edit-password').val();

        // Tạo object data để gửi dữ liệu qua AJAX
        var data = {
            id: id,
            name: name,
            phone: phone,
            email: email,
            password: password
        };

        // Gửi AJAX request
        $.ajax({
            type: 'POST',
            url: '<?php echo BASE_URL ?>/admin/user/update_user',
            data: data,
            success: function (response) {
                if (response.success) {
                    // console.log(response);
                    alert(response.message);
                    $('#editUserModal_' + id).modal('hide');
                    location.reload();
                } else {
                    alert(response.message);
                    console.log(response);
                }
            },
            error: function () {
                alert("Kết nối máy chủ thất bại");
            }
        });
    });


   // Sử dụng sự kiện "delegate" để xử lý sự kiện click cho các nút "Xóa"
        $('tbody').on('click', '.deleteUser_button', function () {
            var userId = $(this).attr('data-user-id');
            var rowToRemove = $(this).closest('tr');

            $.ajax({
                type: "POST",
                url: '<?php echo BASE_URL ?>/admin/user/deleteUser',
                data: {
                    userId: userId
                },
                dataType: 'json',
                success: function (data) {
                    if (data.status === 'true') {
                        $('#deleteuers_' + userId).modal('hide');
                        rowToRemove.remove();
                    } else {
                        alert(data.message);
                    }
                },
                error: function () {
                    alert('Có lỗi xảy ra khi xóa người dùng');
                }
            });
        });


    // tìm kiếm người dùng===========================================================


    function updateUserTable(users) {
        var tbody = $('tbody');
        tbody.empty();

        $.each(users, function(index, user) {
                var row = 
                    '<tr>' +
                        '<td>' + user.id_user + '</td>' +
                        '<td>' + user.name + '</td>' +
                        '<td>' + user.phone + '</td>' +
                        '<td>' + user.email + '</td>' +
                        '<td>' +
                        '<button class="btn btn-info btn-sm edit-user m-1" data-bs-toggle="modal" ' +
                            'data-bs-target="#editUserModal_' + user.id_user + '"' +
                            'data-user-id="' + user.id_user + '">Sửa</button>' +
                        



                        '<button data-bs-toggle="modal" data-bs-target="#deleteuers_'+ user.id_user+'" class="btn btn-danger btn-sm m-1">Xóa</button>' +
                        '<div class="modal fade" id="deleteuers_' +user.id_user+'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">' +
                        '<div class="modal-dialog">' +
                        '<div class="modal-content">' +
                        '<div class="modal-header">' +
                        '<h5 class="modal-title" id="deleteuers_'+ user.id_user+'">Xóa bài viết</h5>' +
                        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                        '</div>' +
                        '<div class="modal-body">' +
                        'Dữ liệu bài viết sẽ bị xóa. Bạn có muốn xóa?' +
                        '</div>' +
                        '<div class="modal-footer">' +
                        '<button type="button" class="btn btn-info m-1" data-bs-dismiss="modal">No</button>' +
                        '<button data-user-id="'+ user.id_user+'" type="button" class="btn btn-danger deleteUser_button">Yes</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                    '</tr>';
                tbody.append(row);
            });
        }



});
