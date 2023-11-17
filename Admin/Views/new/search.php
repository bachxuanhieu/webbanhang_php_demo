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
                                    <form action="<?php echo BASE_URL; ?>/admin/new/search_new" method="GET"
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
                                    <a href="<?php echo BASE_URL ?>/admin/new" class="btn btn-danger float-end">Quay lại</a>
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
                            <?php 
                                foreach($news as $keys => $i){
                            ?>
                            <tr>
                                <td><?php echo $i['id_category_post'] ?></td>
                                <td><?php echo $i['title_category_post'] ?></td>
                                <td><?php echo $i['desc_category_post'] ?></td>

                                <td>
                                    <button data-bs-toggle="modal"
                                        data-bs-target="#deletenewModal<?php echo $i['id_category_post']?>"
                                        class="btn btn-danger btn-sm m-1">
                                        Xóa
                                    </button>
                                    <div class="modal fade" id="deletenewModal<?php echo $i['id_category_post'] ?>"
                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Xóa bài viết</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Dữ liệu bài viết sẽ bị xóa. Bạn có muốn xóa?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info btn-sm"
                                                        data-bs-dismiss="modal">No</button>
                                                    <button data-new-id="<?php echo $i['id_category_post']; ?>"
                                                        class="btn btn-danger btn-sm m-2 delete-new">
                                                        <?php echo $i['id_category_post']; ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="<?php echo BASE_URL ?>/admin/new/edit_new/<?php echo $i['id_category_post'];?>"
                                        class="btn btn-info btn-sm m-1">Sửa
                                    </a>

                                    <button class="btn btn-warning btn-sm toggle-hidden-status m-1" data-new-id="<?php echo $i['id_category_post']; ?>">
                                            Ẩn
                                    </button>
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

    <?php include('new.js') ?>
</script>