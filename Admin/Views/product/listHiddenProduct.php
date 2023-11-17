<div>
    <div class="container-fluid p-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    <h3>Các sản phẩm đã ẩn
                        <a class="btn btn-success btn-sm float-end p-2" href="<?php echo BASE_URL ?>/admin/product/listproduct">Quay lại</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Sử lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($hiddenProducts as $keys => $i){ ?>
                            <tr>
                            <td><?php echo $i['id_product'] ?></td>
                                <td><img src="<?php echo BASE_URL ?>/public/uploads/product/<?php echo $i['image_product']; ?>"
                                        height="100" width="100" alt=""></td>
                                <td><?php echo $i['title_product'] ?></td>
                                <td><?php echo $i['price_product'] ?></td>
                                </td>
                               
                                <td>
                                    <button class="btn btn-success btn-sm toogle-show-status" data-product-id="<?php echo $i['id_product'] ?>">
                                        Hiện thị
                                    </button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function(){
        $('.toogle-show-status').on('click',function (){
            var productId = $(this).attr('data-product-id');
            // alert(productId);
            $.ajax({
                type: 'GET',
                url: '<?php echo BASE_URL ?>/admin/product/toggleStatus2/'+productId,
                success:function(response){
                    if(response.success){
                        alert('Đã hiển thị sản phẩm');
                        location.reload();
                    }
                    else(
                        alert('Lỗi khi hiện thị sản phẩm')
                    )
                },
                error:function(){
                    alert('Lỗi kết nối máy chủ');
                }
            })
        })
    })
</script>