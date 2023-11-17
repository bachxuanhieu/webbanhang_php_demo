
<div>
    <div class="container-fluild p-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3>Từ khóa:
                                        <?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>
                                    </h3>
                                </div>
                                <div class="col-lg-6">
                                    <form action="<?php echo BASE_URL; ?>/admin/category/search_category" method="GET"
                                        autocomplete="off"
                                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-end">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small"
                                                name="keyword" placeholder="Tìm kiếm sản phẩm..." aria-label="Search"
                                                aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <a href="<?php echo BASE_URL ?>/admin/category/index" class="btn btn-success float-end">Quay lại</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Danh mục sản phẩm</th>
                            <th>Miêu tả</th>
                            <th>Xử lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($category as $i): ?>

                            <tr>
                                <td>
                                    <?php echo $i['id_category_product'] ?>
                                </td>
                                <td>
                                    <?php echo $i['title_category_product'] ?>
                                </td>
                                <td>
                                    <?php echo $i['desc_category_product'] ?>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm toggle-status m-2"
                                        data-category-id="<?php echo $i['id_category_product']; ?>">
                                        Ẩn
                                    </button>
                                    <!-- Nút xóa -->
                                    <button data-bs-toggle="modal" data-bs-target="#deletecategory"
                                        class="btn btn-danger btn-sm m-2">
                                        Xóa
                                    </button>
                                    <div class="modal fade" id="deletecategory" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Xóa danh mục</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Dữ liệu danh mục sẽ bị xóa. Bạn có muốn xóa?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info"
                                                        data-bs-dismiss="modal">No</button>
                                                    <button data-category-id="<?php echo $i['id_category_product'];?>"
                                                    class="btn btn-danger btn-sm m-2 delete-category">Yes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <!-- Nút sửa-->
                                        <button data-category-id="<?php echo $i['id_category_product']; ?>"  class="btn btn-info btn-sm m-2 edit-category"
                                            data-bs-toggle="modal" data-bs-target="#editCategoryModal">
                                            Sửa
                                        </button>
                                        <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa danh mục</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                        <form method="POST" id="edit_category_form">
                                                            <div class="mb-3">
                                                                <input type="hidden" class="form-control" id="edit_id_category_product" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Tên danh mục sản phẩm</label>
                                                                <input type="text" class="form-control" id="edit_title_category_product" required>
                                                            </div>
                                                            <div class="form-check m-2">
                                                                <input class="form-check-input" type="checkbox" value="1" id="edit_status_checkbox">
                                                                <label class="form-check-label" for="edit_status_checkbox">
                                                                    Ẩn danh mục sản phẩm
                                                                </label>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Miêu tả</label>
                                                                <input type="text" class="form-control" id="edit_desc_category_product" required>
                                                            </div>
                                                            <input type="hidden" id="edit_category_id">
                                                            <div class="from-group">
                                                                <input type="button" class="btn btn-success btn-block" id="button_edit" value="Lưu">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
            </div>
        </div>
    </div>
</div>


<script>
        <?php
            include('category.js');
        ?>
</script>  