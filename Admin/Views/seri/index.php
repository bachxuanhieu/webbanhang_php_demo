<div>
    <div class="container-fluild p-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Dòng sản phẩm
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                    data-bs-target="#addSeriModal">
                                    Thêm dòng sản phẩm
                            </button>   
                            <div class="modal fade" id="addSeriModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Thêm dòng sản phẩm</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" id="add_seri" method="POST">
                                                    <div class="mb-3">
                                                        <label for="title_brand">Tên</label>
                                                        <input type="text" class="form-control" id="title_seri"
                                                            name="title_seri" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="category_product">Danh mục sản phẩm</label>
                                                        <select id="category" name="category"
                                                            class="form-select" required>
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
                                                    <div class="mb-3">
                                                        <label class="form-label">Chọn thương hiệu</label><br>
                                                        <select name="brand_product" id="brand_product" class="form-select">
                                                            <option value="">Chọn nhãn hàng</option>
                                                        </select>
                                                    </div>
                                                    <button id="add_seri_button" type="submit"
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
                                <th>Tên dòng sản phẩm</th>
                                <th>Nhãn hàng</th>
                                <th>Sử Lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        <?php 
                            foreach ($series as $keys => $i){
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $i['id'] ?>
                                    </td>
                                    <td>
                                        <?php echo $i['title_seri'] ?>
                                    </td>
                                    <td>
                                        <?php echo $i['id_brand'] ?>
                                    </td>
                                    <td>
                                        xử lý
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
    $(document).ready(function(){
        $('#category').on('change',function(){
            var id_category_product = $(this).val();
            // alert(id_category_product);
            $.ajax({
                url:'<?php echo BASE_URL ?>/admin/product/getBrand',
                method:'GET',
                dataType:'json',
                data:{
                    id_category_product:id_category_product
                },
                success:function(data){
                    $('#brand_product').empty();
                    $.each(data, function(i, brand){
                        $('#brand_product').append($('<option>',{
                            value: brand.id_brand,
                            text: brand.title_brand
                        }))
                    })
                },error:function(){
                    alert('Lỗi rồi');
                }
            })
        });


    $('#add_seri_button').click(function() {
        var title = $('#title_seri').val();

        var id_brand = $('#brand_product').val();

        // alert(id_brand);
     
        var data = {
            title: title,
            id_brand: id_brand
        };

            $.ajax({
                type: 'POST',
                url: '<?php echo BASE_URL ?>/admin/seri/addSeri', 
                data: data,
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        // Thêm dòng mới vào bảng dữ liệu
                        var newRow = '<tr>' +
                            '<td>' + response.id + '</td>' +
                            '<td>' + title_seri + '</td>' +
                            '<td>' + id_brand + '</td>' +
                            '<td>' +
                            // Thêm các nút sửa và xóa
                            '</td>' +
                            '</tr>';
                        $('table tbody').append(newRow);

                        // // Đóng modal và xóa dữ liệu trong form
                        alert('Thêm thành công');
                        $('#addSeriModal').modal('hide');
                    
                    } else {
                        alert("Lỗi thêm nhãn hàng");
                    }
                },
                error: function() {
                    alert('Lỗi kết nối máy chủ');
                }
            });
        });
    })
</script>
                            
                        