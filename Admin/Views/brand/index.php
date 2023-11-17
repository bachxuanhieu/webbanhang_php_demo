<div>

    <div class="container-fluild p-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Tất Cả nhãn hàng
                            <form action="<?php echo BASE_URL; ?>/admin/brand/search_brand" method="GET"
                                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-end">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                        name="keyword" placeholder="Tìm kiếm nhãn hàng..." aria-label="Search"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <button class="btn btn-success ml-2 float-end " data-bs-toggle="modal"
                                data-bs-target="#hiddenBrandModal">Nhãn hàng đã ẩn
                            </button>
                            <div class="modal fade" id="hiddenBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Danh mục đã ẩn</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table  table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nhãn hàng</th>
                                                        <th>Sử lý</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="hidden-category-list">
                                                    <?php foreach ($hiddenBrands as $i): ?>

                                                    <tr>
                                                        <td>
                                                            <?php echo $i['id_brand'] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $i['title_brand'] ?>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm toggle-show-status m-2"
                                                                data-brand-id="<?php echo $i['id_brand']; ?>">
                                                                Hiển thị
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <!-- =====================================================Thêm nhãn hàng====================================================================== -->
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                    data-bs-target="#addBrandModal">
                                    Thêm nhãn hàng
                                </button>                               
                                <div class="modal fade" id="addBrandModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Thêm nhãn hàng</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" id="add_brand" method="POST">
                                                    <div class="mb-3">
                                                        <label for="title_brand">Tên nhãn hàng</label>
                                                        <input type="text" class="form-control" id="title_brand"
                                                            name="title_brand" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="desc_brand">Miêu tả nhãn hàng</label>
                                                        <textarea id="desc_brand" class="form-control" name="desc_brand"
                                                            required></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="category_product">Danh mục sản phẩm</label>
                                                        <select id="category_product" name="category_product"
                                                            class="form-label" required>
                                                            <?php
                                                        foreach ($categories as $key => $i) {
                                                            ?>
                                                            <option value="<?php echo $i['id_category_product'] ?>">
                                                                <?php echo $i['title_category_product'] ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                    <button id="add_brand_button" type="submit"
                                                        class="btn btn-success btn-sm float-end">Lưu thông tin</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ============================================================================================================================================== -->

                            </h3>
                        </div>
                    </div>


                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Têm sản phẩm</th>
                                <th>Miêu tả</th>
                                <th>Danh mục sản phẩm</th>
                                
                                <th>Sử Lý</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                            foreach ($brands as $keys => $i){
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $i['id_brand'] ?>
                                    </td>
                                    <td>
                                        <?php echo $i['title_brand'] ?>
                                    </td>
                                    <td>
                                        <?php echo $i['desc_brand'] ?>
                                    </td>
                                    <td>
                                        <?php echo $i['title_category_product'] ?>
                                    </td>
                                    <td>
                                    


                                
                                        <!-- xóa nhãn hàng  ------------------------------------------------------------------------------------------------------>
                                        <button data-bs-toggle="modal" data-bs-target="#deleteBrandModal<?php echo $i['id_brand']; ?>"
                                            class="btn btn-danger btn-sm m-2">
                                            Xóa
                                        </button>

                                        <div class="modal fade" id="deleteBrandModal<?php echo $i['id_brand']; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Xóa danh mục</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Dữ liệu nhãn hàng sẽ bị xóa. Bạn có muốn xóa?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info"
                                                            data-bs-dismiss="modal">No</button>
                                                        <button data-delete-brand-id="<?php echo $i['id_brand']; ?>"
                                                            class="btn btn-danger m-2 delete-brand">Yes 
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================================================================================== -->
                                        <button class="btn btn-info btn-sm toggle-hiden-status"
                                                data-brandstatus-id="<?php echo $i['id_brand']; ?>">
                                                Ẩn
                                        </button>
                                        <!-- =========================================================================================================================== -->
                                        <button data-bs-toggle="modal"
                                            data-bs-target="#editBrandModal_<?php echo $i['id_brand']; ?>" data-id-brand="<?php echo $i['id_brand']; ?>" class="btn btn-warning btn-sm m-2 edit-brand">
                                            Sửa
                                        </button>
                                        <div class="modal fade" id="editBrandModal_<?php echo $i['id_brand']; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Sửa nhãn hàng</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form  id="edit_brand" method="POST">
                                                            <!-- <input type="hidden" id="edit_id_brand" value="<?php echo $i['id_brand'] ?>" > -->
                                                            <div class="mb-3">
                                                            <input type="hidden" class="form-control"
                                                                id="edit_id_brand" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Tên nhãn hàng</label>
                                                                <input type="text" class="form-control"
                                                                    id="edit_title_brand" value="<?php echo $i['title_brand'] ?>" >
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Miêu tả nhãn hàng</label>
                                                                <textarea id="edit_desc_brand" class="form-control"
                                                                    ><?php echo $i['desc_brand'] ?></textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Danh mục sản phẩm</label>
                                                                <select id="edit_category_product"
                                                                    class="form-label">
                                                                    <?php
                                                                    foreach ($categories as $key => $i) {
                                                                    ?>
                                                                    <option value="<?php echo $i['id_category_product'] ?>">
                                                                        <?php echo $i['title_category_product'] ?>
                                                                    </option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <button  type="button"
                                                                class="btn btn-success btn-block edit_brand_button">
                                                                Lưu thông tin
                                                            </button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ========================================Sửa nhãn hàng================================================================= -->

                                    </td>
                                </tr>
                            <?php }; ?>


                        </tbody>


                    </table>
                </div>
            </div>

        </div>
    </div>
</div>




<!-- javascript sử lý thêm sửa xóa -->

<script>
    <?php include('brand.js') ?>
</script>