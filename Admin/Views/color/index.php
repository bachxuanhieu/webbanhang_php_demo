<div>
    <div class="container-fluild p-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Màu sắc 
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                    data-bs-target="#addColorModal">
                                    Thêm Màu
                                </button>
                                <div class="modal fade" id="addColorModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Thêm màu</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" id="add_color_form" method="POST">
                                                    <div class="mb-3">
                                                        <label for="name">Tên màu</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="code">Code màu</label>
                                                        <input type="text" class="form-control" id="code"
                                                            name="code" required>
                                                    </div>
                                                    <div class="form-check m-2">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            id="status">
                                                        <label class="form-check-label" for="status">
                                                            Ẩn
                                                        </label>

                                                    </div>
                                                    <button id="add_color_button" type="submit"
                                                        class="btn btn-success btn-sm float-end">Lưu thông tin</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tên màu</th>
                                <th>Code màu</th>
                                <th>Hiển thị</th>
                                <th>Sử lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($colors as $keys => $i){
                            ?>
                            <tr>
                                <td><?php echo $i['id'] ?></td>
                                <td><?php echo $i['name'] ?></td>
                                <td><?php echo $i['code'] ?></td>
                                <td><?php echo $i['status'] == 0 ? 'Hiện thị' : 'Ẩn' ?></td>
                                <td>
                                    <button data-bs-toggle="modal" data-bs-target="#deletecolor<?php echo $i['id']?>"
                                            class="btn btn-danger btn-sm m-2">
                                            Xóa
                                    </button>
                                        <div class="modal fade" id="deletecolor<?php echo $i['id']?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Xóa màu</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Dữ liệu màu sẽ bị xóa. Bạn có muốn xóa?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info"
                                                            data-bs-dismiss="modal">No</button>
                                                        <button data-color-id="<?php echo $i['id'];?>"
                                                            class="btn btn-danger m-2 delete-color">Yes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ================ Nút sửa ======================================= -->
                                        <button data-color-id="<?php echo $i['id']; ?>" class="btn btn-warning btn-sm m-2 edit-color" data-bs-toggle="modal" 
                                            data-bs-target="#editColorModal">
                                            Sửa
                                        </button>
                                        <div class="modal fade" id="editColorModal"
                                         tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa màu
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" id="edit_category_form">
                                                            <div class="mb-3">
                                                                <input type="hidden" class="form-control"
                                                                    id="color_id" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Tên màu</label>
                                                                <input type="text" class="form-control"
                                                                    id="color_name" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Code</label>
                                                                <input type="text" class="form-control"
                                                                    id="color_code" required>
                                                            </div>
                                                            <div class="form-check m-2">
                                                                <input class="form-check-input" type="checkbox" value="1"
                                                                    id="color_status">
                                                                <label class="form-check-label" for="">
                                                                    Ẩn màu
                                                                </label>
                                                            </div>
                                                            <input type="hidden" id="color_id">
                                                            <div class="from-group">
                                                                <input type="button" class="btn btn-success btn-block"
                                                                    id="button_edit" value="Lưu">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
        $('#add_color_button').on('click',function(){
            // alert('hieu pro');
            name = $('#name').val();
            code = $('#code').val();
            status = $('#status').is(':checked') ? 1 : 0;
            
            $.ajax({
                type: 'POST',
                url: '<?php echo BASE_URL ?>/admin/color/insertColor',
                data:{
                    name: name,
                    code: code,
                    status: status
                },
                success:function(response){
                    if(response.success){
                        alert('Thêm màu thành công');
                        var modal = $('#addColorModal');
                        modal.modal('hide');
                        location.reload();
                    }else{
                        alert("Lỗi khi thêm màu");
                    }
                },error:function(){
                    alert('Lỗi kết nối máy chủ');
                }
            })
        });
        // =============================== xóa màu ==================================
        $('.delete-color').on('click',function(){
            var colorId = $(this).attr('data-color-id');
            var rowToRemove = $(this).closest('tr');
            // alert(rowToRemove);
            // alert(colorId);
            $.ajax({
                type: 'POST',
                url:'<?php echo BASE_URL ?>/admin/color/deleteColor',
                data:{
                    colorId: colorId
                },
                dataType: 'json',
                success:function(response){
                    console.log(response);
                    if(response.success=='true'){
                        var modal = $('#deletecolor'+colorId);
                        modal.modal('hide');
                        rowToRemove.remove();

                    }else{
                        alert(response.message);
                    }
                },error:function(){
                    alert('Lỗi kết nối máy chủ!')
                }
            });
        });

        // ================================= chỉnh sửa ===============================
        $('.edit-color').on('click',function(){
            var colorId = $(this).attr('data-color-id');
            // alert(colorId);
            $.ajax({
                type:'GET',
                url:'<?php echo BASE_URL ?>/admin/color/editColor/'+colorId,
                success:function(response){
                    // console.log(response);
                    if(response.success){
                        var colorsArray = response.colors;
                        if(colorsArray.length > 0){
                            colorsArray[0];
                            console.log(colorsArray[0]);
                            $('#color_id').val(colorsArray[0].id);
                            $('#color_name').val(colorsArray[0].name);
                            $('#color_code').val(colorsArray[0].code);
                            $('#color_status').prop('checked',colorsArray[0].status==1);
                            
                        }
                    }else{
                            alert(response.message);
                    }
                },error:function(){
                    alert('lỗi kết nối');
                }
            })
        })
    })
</script>