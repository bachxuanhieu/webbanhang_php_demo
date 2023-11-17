<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <h5>Danh sách người dùng</h5>
                        </div>
                        <div class="col-md-8">
                            <!-- ==============================================Tìm kiếm ngươi dùng======================================================================= -->
                            <div>
                                <form action="" id="searchUserForm" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-end">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="searchInput" placeholder="Tìm kiếm người dùng...">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- ==============================================Thêm người dùng=========================================================================== -->
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#addUserModal">
                                Thêm người dùng
                            </button>
                            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addUserModal">Thêm người dùng</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" id="add_user" method="POST">
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Nhập tên người dụng" id="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="phone" class="form-control"
                                                        placeholder="Nhập số điện thoại" id="phone" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="email" class="form-control"
                                                        placeholder="Nhập Email" id="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="password" class="form-control"
                                                        placeholder="Nhập mật khẩu" id="password" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="password2" class="form-control"
                                                        placeholder="Nhập lại mật khẩu" id="password2" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="address" class="form-control"
                                                        placeholder="Nhập địa chỉ" id="address" required>
                                                </div>
                                                <div class="from-group">
                                                    <button type="submit" class="btn btn-success btn-block"
                                                        id="add_user_button">Thêm người
                                                        dùng </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <table class="table table-success table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyTableUser">
                            <?php
                            foreach($users as $keys => $i){
                        ?>
                            <tr>
                                <td><?php echo $i['id_user'] ?></td>
                                <td><?php echo $i['name'] ?></td>
                                <td><?php echo $i['phone'] ?></td>
                                <td><?php echo $i['email'] ?></td>
                                <td>
                                    <!-- ========================================================chỉnh sửa user============================================================================================ -->
                                    <button class="btn btn-info btn-sm edit-user" data-bs-toggle="modal"
                                        data-bs-target="#editUserModal_<?php echo $i['id_user']; ?>"
                                        data-user-id="<?php echo $i['id_user']; ?>">
                                        Sửa
                                    </button>
                                    <div class="modal fade" id="editUserModal_<?php echo $i['id_user']; ?>"
                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh Sửa Người Dùng
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" class="edit_user_form" method="POST">
                                                        <input type="hidden" value="<?php echo $i['id_user']; ?>"
                                                            class="form-control edit-id" name="edit-id">
                                                        <div class="mb-3">
                                                            <label class="form-label">Tên Người Dùng</label>
                                                            <input type="text" value="<?php echo $i['name']; ?>"
                                                                class="form-control edit-name" name="edit-name"
                                                                required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Số điện thoại</label>
                                                            <input type="text" value="<?php echo $i['phone']; ?>"
                                                                class="form-control edit-phone" name="edit-phone"
                                                                required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Email</label>
                                                            <input type="text" value="<?php echo $i['email']; ?>"
                                                                class="form-control edit-email" name="edit-email"
                                                                required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Mật khẩu</label>
                                                            <input type="password" class="form-control edit-password"
                                                                name="edit-password"
                                                                placeholder="Nhập mật khẩu mới (để trống nếu không muốn thay đổi)">
                                                        </div>

                                                        <!-- Đổi nút thành type="submit" để kích hoạt sự kiện submit -->
                                                        <button type="button"  class="btn btn-primary edit_user_button">Lưu Thay
                                                            Đổi</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    

                                    <!-- ===================================================Xóa=============================================================== -->





                                    <button data-bs-toggle="modal" data-bs-target="#deleteuers_<?php echo $i['id_user'] ?>"
                                        class="btn btn-danger btn-sm">
                                        Xóa
                                    </button>
                                    <div class="modal fade" id="deleteuers_<?php echo $i['id_user'] ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Xóa ngươi dùng</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Dữ liệu người dùng sẽ bị xóa. Bạn có muốn xóa?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-seccess"
                                                        data-bs-dismiss="modal">No</button>
                                                    <button  class="btn btn-danger deleteUser_button" data-user-id="<?php echo $i['id_user'] ?>">Yes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--  -->
                                </td>
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
</div>

<script>
    <?php include('user.js') ?>
</script>