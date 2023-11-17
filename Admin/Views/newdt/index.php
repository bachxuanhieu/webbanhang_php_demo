<div>
    <div class="container-fluild p-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Tất Cả Bài Viết
                            <form id="searchForm"  class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-end">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Tìm kiếm bài viết...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <button class="btn btn-info ml-2 float-end"  data-bs-toggle="modal"
                                            data-bs-target="#hiddenNewDtModal">
                                    Danh mục đã ẩn
                            </button>
                            <div class="modal fade" id="hiddenNewDtModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="hiddenNewDtModal">Danh mục đã ẩn</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table  table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Bài Viết</th>
                                                        <th>Sử lý</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="hidden-newdt-list">
                                                    <?php foreach ($hiddenNewdts as $i): ?>

                                                    <tr>
                                                        <td>
                                                            <?php echo $i['id_post'] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $i['title_post'] ?>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm toggle-show-status m-2"
                                                                data-brand-id="<?php echo $i['id_post']; ?>">
                                                                Hiển thị
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                                <a href="<?php echo BASE_URL ?>/admin/newdt/addnewdt"
                                    class="btn btn-success float-end">Thêm Danh Bài Viết</a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Hình Ảnh Bài Viết</th>
                                <th>Têm Bài Viết</th>
                                <th>Danh Mục Bài Viết</th>
                                <th>Sử Lý</th>
                            </tr>
                        </thead>
                        <tbody class="newdt-list">
                            <?php 
                                    foreach($newdts as $i){
                                ?>
                            <tr>
                                <td><?php echo $i['id_post']?></td>
                                <td><img src="<?php echo BASE_URL ?>/public/uploads/new/<?php echo $i['image_post']; ?>"
                                        height="100" width="100" alt=""></td>
                                <td style="width: 400px"><?php echo $i['title_post']?></td>
                                <td><?php echo $i['title_category_post']; ?></td>





                                <td>
                                    <button class="btn btn-warning btn-sm toggle-hidden-status"
                                       data-newdt-id="<?php echo $i['id_post'] ?>"
                                    >
                                    Ẩn     
                                    </button>
                                    <button data-bs-toggle="modal" data-bs-target="#deletepost"
                                        class="btn btn-danger btn-sm">
                                        Xóa
                                    </button>
                                    <div class="modal fade" id="deletepost" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <button type="button" class="btn btn-info"
                                                        data-bs-dismiss="modal">No</button>
                                                    <a href="<?php echo BASE_URL ?>/admin/newdt/deletenewdt/<?php echo $i['id_post']?>"
                                                        type="button" class="btn btn-danger">Yes</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?php echo BASE_URL ?>/admin/newdt/editnewdt/<?php echo $i['id_post']?>"
                                        class="btn btn-info btn-sm">Sửa</a>
                                </td>
                            </tr>
                            <?php 
                                    };
                                ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    <?php include('newdt.js') ?>
</script>