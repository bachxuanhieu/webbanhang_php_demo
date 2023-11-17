<div>

    <div class="container-fluild p-3">


        <div class="row">
            <div class="col-sm-12">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3>Tất Cả Sản Phẩm</h3>
                                </div>
                                <div class="col-lg-6">
                                    <form action="<?php echo BASE_URL; ?>/admin/product/search_product" method="GET"
                                        class="d-none d-sm-inline-block form-inline mr-auto  ml-md-3 my-2 my-md-0 mw-100 navbar-search float-end">
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
                                    <a href="<?php echo BASE_URL ?>/admin/product/addproduct"
                                        class="btn btn-success float-end ">Thêm Sản Phẩm</a>
                                    <div
                                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 float-end">
                                        <a href="<?php echo BASE_URL ?>/admin/product/listHiddenProduct" class="btn btn-info">Danh sách ẩn</a>
                                    </div>
                                    
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
                                <th>Hình ảnh</th>
                                <th>Têm Sản Phẩm</th>
                                <!-- <th>Giá</th> -->
                                <th>Màu sản phẩm</th>
                                <th>Giá sale</th>
                                <th>Số Lượng</th>
                                <th>Sử Lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($productsPT) || $products == null): ?>
                                <?php foreach ($productsPT as $i): ?>
                            <tr>
                                <td><?php echo $i['id_product'] ?></td>
                                <td><img src="<?php echo BASE_URL ?>/public/uploads/product/<?php echo $i['image_product']; ?>"
                                        height="100" width="100" alt="">
                                </td>
                            
                                <td><?php echo $i['title_product'] ?></td>
                                <!-- <td><?php echo $i['price_product'] ?></td> -->
                                <td>
                                    <?php
                                        foreach($product_colors as $keys => $j){
                                            foreach($colors as $keys =>$y){
                                            if($i['id_product']==$j['product_id'] && $j['color_id']==$y['id']){
                                    ?>
                                        <?php echo $y['name'] ?><br>
                                        <?php 
                                            if(isset($j['image'])){
                                        ?>
                                        <img src="<?php echo BASE_URL ?>/public/uploads/product_color/<?php echo $j['image'] ?>" height="50" width="50" alt=""> <br>
                                        <?php
                                            }
                                        ?>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                                <td><?php echo isset($i['selling_product']) ? $i['selling_product'] : $i['price_product']; ?>
                                </td>
                                <td><?php echo $i['quanlity_product'] ?></td>
                                <td>
                                    <button data-bs-toggle="modal" data-bs-target="#deleteproduct<?php echo $i['id_product'] ?>"
                                        class="btn btn-danger btn-sm m-1">
                                        Xóa
                                    </button>
                                    <div class="modal fade" id="deleteproduct<?php echo $i['id_product'] ?>" tabindex="-1"
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
                                        class="btn btn-warning btn-sm m-1">Sửa</a>

                                    <button class="btn btn-info btn-sm toogle-hidden-status"
                                        data-product-id="<?php echo $i['id_product'] ?>">
                                        Ẩn
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="10">Chưa có sản phẩm</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>


                    </table>
                </div>
                <div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination float-end">
                            <?php
                            for($j=1;$j<=$product_button;$j++){ 
                        ?>
                            <li class="page-item"><a class="page-link"
                                    href="<?php echo BASE_URL ?>/admin/product/listproduct?trang=<?php echo $j ?>"><?php echo $j ?></a>
                            </li>
                            <?php
                            }
                        ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.toogle-hidden-status').on('click',function(){
            var productId = $(this).attr('data-product-id');
            $.ajax({
                type: 'GET',
                url: '<?php echo BASE_URL ?>/admin/product/toggleStatus/'+productId,
                success:function(response){
                    if(response.success){
                        alert('Đã ẩn sản phẩm');
                        location.reload();
                    }
                    else(
                        alert('Lỗi khi ẩn sản phẩm')
                    )
                },
                error:function(){
                    alert('Lỗi kết nối máy chủ');
                }
            })
        })        
    })
</script>