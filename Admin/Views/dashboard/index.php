<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Trang quản lý:</h1>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Danh Mục Sản Phẩm</div>
                            <a href="<?php echo BASE_URL ?>/admin/category" class="btn btn-success btn-sm"> Số lượng:
                                <?php echo $categoryCount ?></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Sản phẩm</div>
                            <a href="<?php echo BASE_URL ?>/admin/product" class="btn btn-danger btn-sm"> Số lượng:
                                <?php echo $productCount ?></a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Danh mục bài viết</div>
                            <a href="<?php echo BASE_URL ?>/admin/new" class="btn btn-info btn-sm"> Số lượng:
                                <?php echo $newCount ?></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Bài viết</div>
                            <a href="<?php echo BASE_URL ?>/admin/newdt" class="btn btn-warning btn-sm"> Số lượng:
                                <?php echo $newdtCount ?></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Danh Mục Đơn Hàng</div>
                            <a href="<?php echo BASE_URL ?>/admin/order" class="btn btn-secondary btn-sm"> Số lượng:
                                <?php echo $orderCount ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Người Dùng</div>
                            <a href="<?php echo BASE_URL ?>/admin/user" class="btn btn-info btn-sm"> Số lượng:
                                <?php echo $userCount ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
