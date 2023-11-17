
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
                                    <form action="<?php echo BASE_URL; ?>/admin/product/search_product" method="GET"
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
                                    <a href="<?php echo BASE_URL ?>/admin/product" class="btn btn-danger float-end">Quay lại</a>
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
                                <th>Hình Ảnh</th>
                                <th>Têm Sản Phẩm</th>
                                <th>Danh Mục Sản Phẩm</th>
                                <th>Tên Nhãn Hàng</th>
                                <th>Giá</th>
                                <th>Giá sale</th>
                                <!-- <th>Sản phẩm hot</th>
                               
                                <th>Miêu Tả</th> -->
                        
                                <th>Số Lượng</th>

                                <th>Sử Lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($products)): ?>
                                <?php foreach ($products as $keys => $i): ?>
                                    <tr>
                                    
                                        <td>
                                            <?php echo $i['id_product'] ?>
                                        </td>
                                        <td>
                                            <img src="<?php echo BASE_URL ?>/public/uploads/product/<?php echo $i['image_product']; ?>"
                                                height="100" width="100" alt="">
                                        </td>
                                        <td>
                                            <?php echo $i['title_product'] ?>
                                        </td>
                                        <td>
                                            <?php echo $i['title_category_product']; ?>
                                        </td>
                                        <td>
                                            <?php echo $i['brand_product']; ?>
                                        </td>
                                        <td>
                                            <?php echo $i['price_product'] ?>
                                        </td>
                                        <td>
                                            <?php echo isset($i['selling_product']) ? $i['selling_product'] : $i['price_product']; ?>
                                        </td>
                                
                                     
                                        <td>
                                            <?php echo $i['quanlity_product'] ?>
                                        </td>
                                        <td>
                                            <button data-bs-toggle="modal" data-bs-target="#deleteproduct"
                                                class="btn btn-danger btn-sm m-1">
                                                Xóa
                                            </button>
                                            <div class="modal fade" id="deleteproduct" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Xóa sản phẩm</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Dữ liệu sản phẩm sẽ bị xóa. Bạn có muốn xóa?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-info"
                                                                data-bs-dismiss="modal">No</button>
                                                            <a href="<?php echo BASE_URL ?>/admin/product/deleteproduct/<?php echo $i['id_product'] ?>"
                                                                type="button" class="btn btn-danger">Yes</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="<?php echo BASE_URL ?>/admin/product/editproduct/<?php echo $i['id_product'] ?>"
                                                class="btn btn-info btn-sm m-1">Sửa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="13">Không có sản phẩm</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>


                    </table>
                </div>
            </div>

        </div>
    </div>
</div>