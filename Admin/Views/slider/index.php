<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Slider
                        <a href="<?php echo BASE_URL ?>/admin/slider/addslider"
                            class="btn btn-success btn-sm float-end">Thêm Slider</a>
                    </h4>
                    <?php
                        if(!empty($_GET['msg'])){
                            $msg=unserialize(urldecode($_GET['msg']));
                            foreach($msg as $key => $value){
                                echo '<span style="color:blue;">'.$value.'</span>';
                            }
                        }

                    ?>
                </div>
                <div class="card-body">
                    <table class="table table-success table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Hình ảnh</th>

                                <th scope="col">Tiêu đề</th>

                                <th scope="col">Hiện thị</th>
                                <th scope="col">Sử lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($sliders)){
                                foreach($sliders as $keys => $i){
                            
                        ?>
                            <tr>
                                <td><?php echo $i['id_slider'] ?></td>
                                <td><img src="<?php echo BASE_URL ?>/public/uploads/slider/<?php echo $i['image_slider'] ?>"
                                        style="width:100px; height: 100px;" alt=""></td>

                                <td><?php echo $i['title_slider'] ?></td>

                                <td>
                                    <?php 
                                        if($i['status_slider']==1){
                                     ?>
                                        Không
                                    <?php
                                        }else{
                                    ?>
                                        Có
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td>
                                    <!-- =============================Xóa==================================================================================== -->
                                    <button data-bs-toggle="modal" data-bs-target="#deleteslider<?php echo $i['id_slider']?>"
                                        class="btn btn-danger btn-sm m-1">
                                        Xóa
                                    </button>
                                    <div class="modal fade deleteslider" id="deleteslider<?php echo $i['id_slider']?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteslider<?php echo $i['id_slider']?>">Xóa slider</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Dữ liệu slider sẽ bị xóa. Bạn có muốn xóa?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info"
                                                        data-bs-dismiss="modal">No</button>
                                                    <button data-slider-id="<?php echo $i['id_slider'] ?>"
                                                        type="button" class="btn btn-danger delete-slider" >Yes
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--=============================Sửa=====================================================================================  -->
                                    <a href="<?php echo BASE_URL ?>/admin/slider/editslider/<?php echo $i['id_slider'] ?>"
                                        class="btn btn-info btn-sm m-1">Sửa</a>
                                    <!-- ============================Ẩn======================================================================================= -->
                                    <?php 
                                        if($i['status_slider']==1){
                                    ?>
                                           <button class="btn btn-success btn-sm toggle-show-status"
                                                data-slider-id="<?php echo $i['id_slider'] ?>">
                                            Hiển thị
                                            </button>

                                    <?php
                                        }else{
                                    ?>
                                            <button class="btn btn-warning btn-sm toggle-hidden-status"
                                                data-slider-id="<?php echo $i['id_slider'] ?>">
                                            Ẩn
                                            </button>

                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            }
                        }else{
                        ?>
                            <td colspan="6">Chưa có slider nào</td>
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
    <?php include('slider.js') ?>
</script>