<div>
    <div class="row p-2">
        <div class="col-mb-12">
            <div class="card-header">
                <h3>Thêm sản phẩm
                    <a href="<?php echo BASE_URL ?>/admin/product" class="btn btn-primary btn-sm float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="<?php echo BASE_URL ?>/admin/product/insertproduct" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Chọn danh mục sản phẩm</label><br>
                                <select style="width:300px" id="category" name="category_product" id="" class="form-select">
                                    <?php
                                    foreach ($categories as $key => $i) {
                                        ?>
                                    <option  value="<?php echo $i['id_category_product'] ?>">
                                        <?php echo $i['title_category_product'] ?></option>
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
                    <div class="mb-3">
                        <label class="form-label">Tên Sản Phẩm</label>
                        <input type="text" class="form-control" name="title_product">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Giá Sản Phẩm</label>
                                <input type="text" class="form-control" name="price_product">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Giá Sale Sản Phẩm</label>
                                <input type="text" class="form-control" name="selling_product">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Dung lượng</label>
                                <input type="text" class="form-control" name="memory_product">
                            </div>
                        </div>
                    </div>
              

                    <div class="mb-3">
                        <div class="row ">                 
                            <div class="col-md-6">
                                <h5>Chọn màu</h5>
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                <?php
                                    $j=0;
                                    foreach($colors as $keys => $i){
                                ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading<?php echo $j ?>">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $j ?>"
                                                aria-expanded="false" aria-controls="flush-collapse<?php echo $j ?>">
                                                <?php echo $i['name'] ?>
                                            </button>
                                        </h2>
                                        <div id="flush-collapse<?php echo $j ?>" class="accordion-collapse collapse"
                                            aria-labelledby="flush-heading<?php echo $j ?>"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <div class="col-md-4 mb-5">
                                                    Chọn: <input type="checkbox" name="colors[]" multiple class=""
                                                        value="<?php echo $i['id'] ?>"><br>
                                                    <input type="text" placeholder="Tên sản phẩm"
                                                        name="title_products[<?php echo $i['id']; ?>]" id=""
                                                        class="form-control">
                                                    <input type="text" placeholder="Giá sản phẩm" class="form-control"
                                                        name="prices[<?php echo $i['id']; ?>]">

                                                    Số lượng: <input type="number"
                                                        name="colorquanlity[<?php echo $i['id'] ?>]"
                                                        style="width: 70px; border:1px soild"><br />
                                                    Hình ảnh:<input type="file" class="form-control"
                                                        name="images[<?php echo $i['id']; ?>]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                $j++;
                                }
                                ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5 for="">Thêm thông số kỹ thuật</h5>
                                    <div id="multi_properties">
                                        <a href="javascript:void(0)" onclick="craete()" class="btn btn-info btn-sm mb-3">Thêm</a>

                                        <div class="row items_properties m-2">
                                            <div class="col-5">
                                              
                                                <input type="text" placeholder="Tên thông số" class="form-control" name="data_properties[0][name]">
                                            </div>
                                            <div class="col-5">
                                                <input type="text" placeholder="Giá trị" class="form-control" name="data_properties[0][value]">
                                            </div>
                                            <div class="col-2">
                                                <a href="javascript:void(0)" onclick="delete_(this)" class="btn btn-danger d-block">Xóa</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="mb-3">
                        <label class="form-label">Sản phẩm nổi bật</label>
                        <select name="hot_product" id="" class="form-label">
                            <option value="1">có</option>
                            <option value="0">không</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Miêu tả nhỏ</label>
                        <textarea name="small_desc" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Miêu tả chi tiết</label>
                        <textarea id="myTextarea" name="desc_product" class="form-control" rows="5"></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Số Lượng</label>
                                <input type="number" class="form-control" name="quanlity_product">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control" id="image_input" name="image_product">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh xem trước</label><br>
                                <img id="image-preview" src="#" alt="Image Preview" style="max-width: 100%; max-height: 200px;">
                                <!-- <button id="clear-image" type="button">Xóa hình</button> -->
                            </div>
                        </div>
                        <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Những hình ảnh chi tiết</label>
                                <input type="file" multiple class="form-control" name="product_images[]" id="product-images" accept="image/*">
                        </div>
                        <div id="image-previews" class="d-flex flex-wrap"></div>
                        </div>
                    </div>
                    <!-- <div class="mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Thuộc tính</h5>
                                </div>
                                <div class="card-body">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Thuộc tính 1</span>
                                        <input type="text" id="input1" class="form-control" aria-describedby="basic-addon1">
                                    </div>
                                    <div id="result"></div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon2">Thuộc tính 2</span>
                                        <input type="text" id="input2" class="form-control" aria-describedby="basic-addon2">
                                    </div>
                                    <div id="result2"></div>
                                </div>
                            </div>
                    </div> -->
                    <!-- <div class="mb-3">
                        <div class="card">
                                <div class="card-header">
                                    <h5>Thuộc tính đã max</h5>
                                </div>
                                <div class="card-body">
                                    <div id="result-container">
                                      
                                    </div>
                                </div>
                            </div>
                    </div> -->
                    <button type="submit" class="btn btn-success btn-block btn-insert-product">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <script>
$(document).ready(function() {
    var input1Array = [];
    var input2Array = [];
    var combinedArray = [];

  
    // Hàm tạo mảng combinedArray từ input1Array và input2Array
    function generateCombinedArray() {
        var combinedArray = [];
        if (input1Array.length === 0) {
            combinedArray = input2Array.slice(); // Sử dụng bản sao của input2Array
        } else if (input2Array.length === 0) {
            combinedArray = input1Array.slice(); // Sử dụng bản sao của input1Array
        } else {
            for (var i = 0; i < input1Array.length; i++) {
                for (var j = 0; j < input2Array.length; j++) {
                    var combination = input1Array[i] + " | " + input2Array[j];
                    combinedArray.push(combination);
                }
            }
        }
        return combinedArray;
    }
    // Hàm cập nhật kết quả và hiển thị
    function updateResult() {
        combinedArray = generateCombinedArray();
        createResultUI(combinedArray);
    }

    // Hàm tạo giao diện dựa trên mảng được truyền vào
    function createResultUI(array) {
        var resultContainer = document.getElementById("result-container");
        resultContainer.innerHTML = ""; // Xóa bất kỳ nội dung nào cũ trong container
        var html = '<table class="table table-dark table-striped">' +
            '<thead>' +
            '<tr>' +
            '<th>Cặp thuộc tính:</th>' +
            '<th>Giá Tiền:</th>' +
            '<th>Sử Lý</th>' +
            '</tr>' +
            '</thead>' +
            '<tbody>';
        for (var k = 0; k < array.length; k++) {
            html += '<tr>';
            html += '<td>' + array[k] + '</td>';
            html += '<td><input></input></td>';
            html += '<td><button class="delete-button" data-index="' + k + '">Xóa</button></td>';
            html += '</tr>';
        }
        html += '</tbody>' +
            '</table';
        resultContainer.innerHTML = html;
        var deleteButtons = document.getElementsByClassName("delete-button");
        for (var i = 0; i < deleteButtons.length; i++) {
            deleteButtons[i].addEventListener("click", function (event) {
                var index = event.target.getAttribute("data-index");
                deleteItem(index);
            });
        }
        console.log(combinedArray);
        return combinedArray;
    }
    // Hàm cập nhật kết quả
  

    function deleteItem(index) {
        index = parseInt(index, 10);
        if (!isNaN(index) && index >= 0 && index < combinedArray.length) {
            combinedArray.splice(index, 1);
            createResultUI(combinedArray);
        }
    }

    $('#input1').on('keyup', function(event) {
    if (event.key === "Enter") {
            event.preventDefault();
            var input1 = document.getElementById('input1').value;
            input1Array.push(input1);
            document.getElementById('input1').value = '';

            var buttonHTML = '';
            for (var i = 0; i < input1Array.length; i++) {
                buttonHTML += '<button class="btn btn-info m-1 delete-input1" data-index-button="'+ i +'">' + input1Array[i] + '</button>';
            }
            document.getElementById('result').innerHTML = buttonHTML;

            var deleteButtonInputs = document.getElementsByClassName("delete-input1");

            for (var j = 0; j < deleteButtonInputs.length; j++) {
                deleteButtonInputs[j].addEventListener("click", function (event) {
                var index = event.target.getAttribute("data-index-button");
                deleteItemInput1(index);
                event.target.remove();
            });
        }
            updateResult(); // Cập nhật kết quả khi thêm phần tử mới
        }
    });

    function deleteItemInput1(index) {
        index = parseInt(index, 10);
        if (!isNaN(index) && index >= 0 && index < combinedArray.length) {
            input1Array.splice(index, 1);
            console.log(input1Array);
            generateCombinedArray();
            updateResult()
        }
    }
    function deleteItemInput2(index) {
        index = parseInt(index, 10);
        if (!isNaN(index) && index >= 0 && index < combinedArray.length) {
            input2Array.splice(index, 1);
            console.log(input1Array);
            generateCombinedArray();
            updateResult()
        }
    }

    $('#input2').on('keyup', function(event) {
    if (event.key === "Enter") {
            event.preventDefault();
            var input2 = document.getElementById('input2').value;
            input2Array.push(input2);
            document.getElementById('input2').value = '';

            var buttonHTML = '';
            for (var i = 0; i < input2Array.length; i++) {
                buttonHTML += '<button class="btn btn-success m-1 delete-input2" data-index-button="'+ i +'">' + input2Array[i] + '</button>';
            }
            document.getElementById('result2').innerHTML = buttonHTML;
            var deleteButtonInputs = document.getElementsByClassName("delete-input2");
            for (var j = 0; j < deleteButtonInputs.length; j++){
                deleteButtonInputs[j].addEventListener("click", function (event) {
                var index = event.target.getAttribute("data-index-button");
                deleteItemInput2(index);

                event.target.remove();
            });
        }
            updateResult(); // Cập nhật kết quả khi thêm phần tử mới
        }
    });


});

</script> -->

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
        $('#brand_product').on('change',function(){
            var id_brand= $(this).val();
            // alert(district_id);
            if(id_brand){
                $.ajax({
                    url:'<?php echo BASE_URL ?>/admin/product/getSeri',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        id_brand: id_brand
                    },
                    success: function(data){
                    $('seri_product').empty();
                    // console.log(data);
                    $.each(data, function(i, seri){
                        $('#seri_product').append($('<option>',{
                            value: seri.id,
                            text: seri.title_seri
                        }));
                    });
                    },error: function(){
                    alert('lỗi rồi');
                    }
                })
            }
        });
        $('#image_input').on('change',function(e){
            const fileInput = event.target;
            const imagePreview = document.getElementById('image-preview');
            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });
        $('#image-preview').on('click', function() {
            const imagePreview = document.getElementById('image-preview');
            // const clearImageBtn = document.getElementById('clear-image');
            const imageInput = document.getElementById('image_input');

            imagePreview.src = ''; // Xóa hình ảnh trước
            // clearImageBtn.style.display = 'none'; // Ẩn nút xóa
            imageInput.value = null; // Xóa giá trị trong input file để người dùng có thể chọn lại tệp khác
        });
        $('#product-images').on('change', function() {
            var imagePreview = document.getElementById('image-previews');
                imagePreview.innerHTML = ''; // Xóa bất kỳ hình ảnh trước đó
                

                var files = this.files;
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    if (file.type.match('image.*')) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            var image = new Image();
                            image.src = e.target.result;
                            image.style.maxWidth = '100px'; // Tùy chỉnh kích thước hiển thị hình ảnh
                            image.style.marginRight = '10px'; // Tùy chỉnh khoảng cách giữa các hình ảnh
                            imagePreview.appendChild(image);

                            // Tạo nút xóa
                           
                            imagePreview.appendChild(image).addEventListener('click', function() {
                                imagePreview.removeChild(image);
                            
                            });
                        };
                        reader.readAsDataURL(file);
                    }
                }
        });
    })
</script>

<script>
    function craete(){
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
    function delete_(___this){
        let count_items = document.querySelectorAll('.items_properties').length - 1;
        count_items--;
        $(___this).closest('.items_properties').remove();
    }

</script>








