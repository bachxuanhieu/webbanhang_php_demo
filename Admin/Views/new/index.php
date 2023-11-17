
<div>
    <div class="row">
        <div class="col-mb-12">
            <div class="card-header">
                <h3>Danh Mục Bài Viết
                        
                            <form action="<?php echo BASE_URL; ?>/admin/new/search_new" method="GET"
                                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-end">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" name="keyword"
                                        placeholder="Tìm kiếm danh mục..." aria-label="Search"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        
                <button class="btn btn-info ml-2 float-end"  data-bs-toggle="modal"
                                data-bs-target="#hiddenNewModal">
                        Danh mục đã ẩn
                </button>
                <div class="modal fade" id="hiddenNewModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                                        <th>Danh mục</th>
                                                        <th>Sử lý</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="hidden-category-list">
                                                    <?php foreach ($hiddenNews as $keys => $i): ?>

                                                    <tr>
                                                        <td>
                                                            <?php echo $i['id_category_post'] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $i['title_category_post'] ?>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm toggle-show-status m-2"
                                                                data-new-id="<?php echo $i['id_category_post']; ?>">
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
                <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#addNewModal">
                    Thêm danh mục bài viết
                </button>
                    <!-- Modal -->
                <div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <div class="modal-body">
                                <form  action="<?php echo BASE_URL ?>/admin/new/insertnew" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Tên Danh Mục Bài Viết</label>
                                        <input type="text" class="form-control" name="title_category_post">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Miêu tả</label>
                                        <input type="text" class="form-control" name="desc_category_post" >
                                    </div>
                                        <button type="submit" class="btn btn-success btn-block">Lưu</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- =============================================================================== -->
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Miêu tả</th>
                            <th>Sử lý</th>
                        </tr>
                    </thead>
                    <tbody>
                                <?php foreach($news as $keys => $i):?>
                                
                                <tr>
                                    <td> <?php echo $i['id_category_post']?></td>
                                    <td><?php echo $i['title_category_post']?></td>
                                    <td><?php echo $i['desc_category_post']?></td>
                                    <td>
                                    <button data-bs-toggle="modal" data-bs-target="#deletenewModal<?php echo $i['id_category_post']?>" class="btn btn-danger btn-sm m-1">
                                        Xóa
                                    </button>
                                        <div class="modal fade" id="deletenewModal<?php echo $i['id_category_post'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Xóa bài viết</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Dữ liệu bài viết sẽ bị xóa. Bạn có muốn xóa?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info btn-sm" data-bs-dismiss="modal">No</button>
                                                        <button data-new-id="<?php echo $i['id_category_post']; ?>" class="btn btn-danger btn-sm m-2 delete-new">
                                                            Xóa
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                        <a href="<?php echo BASE_URL ?>/admin/new/edit_new/<?php echo $i['id_category_post'];?>" class="btn btn-info btn-sm m-1">Sửa</a>

                                        <button class="btn btn-warning btn-sm toggle-hidden-status m-1" data-new-id="<?php echo $i['id_category_post']; ?>">
                                            Ẩn
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                    </tbody>

                </table>
            </div>
        </div>
        
    </div>
</div>


<script><?php include('new.js') ?></script>