<div>
    <div class="row">
        <div class="col-mb-12">
            <div class="card-header">
                <h3>Sửa sản phẩm
                    <a href="<?php echo BASE_URL ?>/admin/product" class="btn btn-primary btn-sm float-end">Quay lại</a>
                </h3>
            </div>
            <div class="card-body">
                <?php
                    foreach($productbyid as $key => $pro){
                ?>
                    <form action="<?php echo BASE_URL ?>/admin/product/updateproduct/<?php echo $pro['id_product']?>"
                        method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Chọn danh mục sản phẩm</label><br>
                                    <select style="width:300px" id="category" name="category_product" id=""
                                        class="form-select">
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
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Chọn thương hiệu</label><br>
                                    <select style="width:300px" name="brand_product" id="brand_product" class="form-select">
                                        <option value="">Chọn nhãn hàng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Chọn dòng sản phẩm</label><br>
                                    <select style="width:300px" name="seri_product" id="seri_product" class="form-select">
                                        <option value="">Chọn dòng sản phẩm</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                      
                        <div class="row">
                            <div class="col-md-8">
                                <label class="form-label">Tên Sản Phẩm</label>
                                <input type="text" class="form-control" value="<?php echo $pro['title_product']?>"
                                    name="title_product">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Số Lượng</label>
                                <input type="number" class="form-control" value="<?php echo $pro['quanlity_product']?>"
                                    name="quanlity_product">
                            </div>
                        </div>
                 
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Giá Sản Phẩm</label>
                                    <input type="text" class="form-control" value="<?php echo $pro['price_product']?>"
                                        name="price_product">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Giá Sale Sản Phẩm</label>
                                    <input type="text" class="form-control" value="<?php echo $pro['selling_product']?>"
                                        name="selling_product">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Sản phẩm nổi bật</label>
                                    <select name="hot_product" class="form-select">
                                        <option value="1" <?php if ($pro['hot_product'] == 1) echo 'selected'; ?>>Có
                                        </option>
                                        <option value="0" <?php if ($pro['hot_product'] == 0) echo 'selected'; ?>>Không
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Bộ nhớ</label>
                                    <input type="text" class="form-control" value="<?php echo $pro['memory_product']?>"
                                        name="memory_product">
                                </div>
                            </div>
                        </div>

                        <!-- ///////////////////////////////////////////// Màu sản phẩm \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
                        <div class="row">
                            <?php
                                    foreach($color_product as $keys => $i){
                                ?>
                            <div class="col-md-4" id="color_product_item_<?php echo $i['id']; ?>">
                                <div class="mb-3">
                                    <div class="card border-warning">
                                        <div class="card-header">
                                            <label for="">Mùa sản phẩm:</label>
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" name="ids[]" value="<?php echo $i['id']; ?>">
                                            <span class="text-danger">Tên sản phẩm:</span> <input type="text"
                                                value="<?php echo $i['title_product']; ?>"
                                                name="title_products[<?php echo $i['id']; ?>]" id="" class="form-control">

                                            Giá: <input type="text" class="form-control"
                                                value="<?php echo $i['price_product']; ?>"
                                                name="prices[<?php echo $i['id']; ?>]">
                                            Màu: <input type="hidden" name="colors[]" class=""
                                                value="<?php echo $i['color_id'] ?>"><?php echo $i['color_id'] ?>

                                            <br />
                                            Số lượng: <input type="number" value="<?php echo $i['quanlity']; ?>"
                                                name="colorquanlity[<?php echo $i['id'] ?>]"
                                                style="width: 70px; border:1px soild"><br />
                                            Hình ảnh:
                                            <img src="<?php echo BASE_URL ?>/public/uploads/product_color/<?php echo $i['image'] ?>"
                                                height="200px" width="maxwidth" alt="">
                                            <input type="file" class="form-control" name="images[<?php echo $i['id']; ?>]">
                                            <!-- ///////////////////////////////////////////Xóa màu\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
                                            <button type="button" class="btn btn-danger btn-sm mt-2 float-end"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deletColorModal_<?php echo $i['id']; ?>">Xóa màu</button>
                                            <div class="modal fade" id="deletColorModal_<?php echo $i['id']; ?>"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Xóa màu sản phẩm
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Dữ liệu màu sẽ bị xóa, bạn có chắc?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm btn-delete-color"
                                                                data-color_id="<?php echo $i['id']; ?>">Có</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ======================================================================================================================================================= -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    }
                                ?>
                        </div>
                        <!-- //////////////////////////////////////////////////////////// Thêm màu \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
                        <div class="row">
                            <button style="width:350px" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#add-color">Thêm màu</button>
                            <div class="modal fade" id="add-color" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Thêm màu sản phẩm</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="category_product" class="form-label">Chọn màu</label>
                                                <select id="color_id" name="color_id" class="form-select" required>
                                                    <?php
                                                        foreach ($colors as $key => $co) {
                                                    ?>
                                                    <option value="<?php echo $co['id'] ?>">
                                                        <?php echo $co['name'] ?>
                                                    </option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" placeholder="Tên sản phẩm" name="title_product_color"
                                                    id="title_product_color" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" placeholder="Giá sản phẩm" class="form-control"
                                                    name="price_product_color" id="price_product_color">
                                            </div>
                                            <div class="mb-3">
                                                <input type="number" placeholder="Số lượng" class="form-control"
                                                    name="quanlity_color" id="quanlity_color">
                                            </div>
                                            <div class="mb-3">
                                                <input type="file" placeholder="Hình ảnh" class="form-control" name="image"
                                                    id="image">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="" data-product-id="<?php echo $pro['id_product']?>"
                                                class="btn btn-success btn-block btn-add-color">Lưu</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- //////////////////////////////////////////////////////////// Kết thúc Thêm màu \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->


            
                        <div class="row">
                            <div class="mb-3">
                                <label class="form-label">Miêu tả nhỏ</label>
                                <textarea name="small_desc" class="form-control" rows="3"><?php echo $pro['small_desc']?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label class="form-label">Miêu tả chi tiết</label>
                                <textarea id="myTextarea" name="desc_product" class="form-control"
                                    rows="5"><?php echo $pro['desc_product']?></textarea>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh sản phẩm</label>
                                <input type="file" name="image_product" class="form-control">
                                <p> <img src="<?php echo BASE_URL ?>/public/uploads/product/<?php echo $pro['image_product']; ?>"
                                        height="100" width="100" alt=""> </p>
                            </div>
                        </div>

                      
                        <div class="m-3">
                            <div class="form-group">
                                <h5 for="">Thông số kỹ thuật</h5>
                                <div id="multi_properties">
                                    <a href="javascript:void(0)" onclick="craete()" class="btn btn-info btn-sm mb-3">Thêm</a>
                                    <?php
                                        foreach($data['arr_properties'] as $key => $value){
                                    ?>
                                    <div class="row items_properties m-2">
                                        <div class="col-5">
                                            <input type="text" value="<?= $value['name'] ?>" class="form-control"
                                                name="data_properties[<?=  $key ?>][name]">
                                        </div>
                                        <div class="col-5">
                                            <input type="text" value="<?= $value['value'] ?>" class="form-control"
                                                name="data_properties[<?= $key ?>][value]">
                                        </div>
                                        <div class="col-2">
                                            <a href="javascript:void(0)" onclick="delete_(this)" class="btn btn-danger d-block">Xóa</a>
                                        </div>
                                    </div>
                                    <?php 
                                        
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <button type="submit" class="btn btn-success btn-block">Lưu chỉnh sửa</button>
                    </form>
                <?php
                    };
                ?>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#category').on('change', function() {
        var id_category_product = $(this).val();
        // alert(id_category_product);
        $.ajax({
            url: '<?php echo BASE_URL ?>/admin/product/getBrand',
            method: 'GET',
            dataType: 'json',
            data: {
                id_category_product: id_category_product
            },
            success: function(data) {
                $('#brand_product').empty();
                $.each(data, function(i, brand) {
                    $('#brand_product').append($('<option>', {
                        value: brand.id_brand,
                        text: brand.title_brand
                    }))
                })
            },
            error: function() {
                alert('Lỗi rồi');
            }
        })
    });
    $('#brand_product').on('change', function() {
        var id_brand = $(this).val();
        // alert(district_id);
        if (id_brand) {
            $.ajax({
                url: '<?php echo BASE_URL ?>/admin/product/getSeri',
                type: 'GET',
                dataType: 'json',
                data: {
                    id_brand: id_brand
                },
                success: function(data) {
                    $('seri_product').empty();
                    // console.log(data);
                    $.each(data, function(i, seri) {
                        $('#seri_product').append($('<option>', {
                            value: seri.id,
                            text: seri.title_seri
                        }));
                    });
                },
                error: function() {
                    alert('lỗi rồi');
                }
            })
        }
    });
    $(".btn-add-color").on('click', function() {
        var product_id = $(this).attr('data-product-id');
        var color_id = $('#color_id').val();
        var title = $('#title_product_color').val();
        var price = $('#price_product_color').val();
        var quanlity = $('#quanlity_color').val();
        var image = $('#image')[0].files[0];

        var data = new FormData();
        data.append('product_id', product_id);
        data.append('color_id', color_id);
        data.append('title', title);
        data.append('price', price);
        data.append('quanlity', quanlity);
        data.append('image', image);

        $.ajax({
            url: '<?php echo BASE_URL ?>/admin/product/addColorProduct',
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    console.log(response);
                    // Xử lý phản hồi từ server, ví dụ: hiển thị thông báo hoặc làm gì đó khác
                    alert("Thêm màu sản phẩm thành công!");
                    // Đóng modal
                    $('#add-color').modal('hide');
                    location.reload();
                } else {
                    alert('Lỗi khi thêm màu sản phẩm.');
                }

            },
            error: function() {
                // Xử lý lỗi (nếu có)
                alert("Lỗi khi thêm màu sản phẩm");
            }
        });
    });
    $('.btn-delete-color').on('click', function() {
        var color_id_product = $(this).attr('data-color_id');
        var toRemove = document.querySelector('#color_product_item_' + color_id_product);
        //    alert(color_id_product);
        $.ajax({
            url: '<?php echo BASE_URL ?>/admin/product/deleteColorProduct',
            type: 'POST',
            data: {
                color_id_product: color_id_product
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                // Xử lý phản hồi từ máy chủ, ví dụ: cập nhật giao diện người dùng
                if (response.success === 'true') {
                    // Xóa card màu sau khi xóa thành công
                    alert("Xóa màu sản phẩm thành công!");
                    $('#deletColorModal_' + color_id_product).modal('hide');
                    toRemove.remove();
                } else {
                    alert('Lỗi khi xóa màu sản phẩm.');
                }
            },
            error: function() {
                // Xử lý lỗi (nếu có)
                alert('Lỗi khi gửi yêu cầu xóa màu sản phẩm.');
            }
        })
    })
});
</script>
<script>
function craete() {
    // alert("hieu dep trai");
    let count_items = document.querySelectorAll('.items_properties').length - 1;
    count_items++;
    console.log(count_items);
    $('#multi_properties').append(`
            <div class="row items_properties m-2">
                <div class="col-5">
                    <input type="text" placeholder="Tên thông số" class="form-control" name="data_properties[${count_items}][name]">
                </div>
                <div class="col-5">
                    <input type="text" placeholder="Giá trị" class="form-control" name="data_properties[${count_items}][value]">
                </div>
                <div class="col-2">
                    <a href="javascript: void(0)" onclick="delete_(this)" class="btn btn-danger  d-block">Xóa</a>
                </div>
            </div>
        
        `);
};

function delete_(___this) {
    let count_items = document.querySelectorAll('.items_properties').length - 1;
    count_items--;
    $(___this).closest('.items_properties').remove();
}
</script>