
<div>
    <div class="row">
        <div class="col-mb-12">
            <div class="card-header">
                <h3>Sửa slider
                <a  href="<?php echo BASE_URL ?>/admin/slider" class="btn btn-primary btn-sm float-end">Quay lại</a>
                </h3>
            </div>
            <div class="card-body">
            <?php
                foreach($sliders as $key => $i){
            ?>
            <form  action="<?php echo BASE_URL ?>/admin/slider/updateslider/<?php echo $i['id_slider']?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control" value="<?php echo $i['title_slider']?>" name="title_slider">
                </div>
                <div class="mb-3">
                    <label class="form-label">Hiện thị sản phẩm</label>
                    <select name="status_slider" class="form-select">
                        <option value="0" <?php if ($i['status_slider'] == 0) echo 'selected'; ?>>Có</option>
                        <option value="1" <?php if ($i['status_slider'] == 1) echo 'selected'; ?>>Không</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Miêu tả</label>
                    <textarea id="myTextarea" name="desc_slider"  class="form-control" rows="5"><?php echo $i['desc_slider']?></textarea>
                </div>
                <div class="mb-3">
                    <label  class="form-label">Hình ảnh slider</label>
                    <input type="file" name="image_slider" class="form-control" >
                    <p> <img src="<?php echo BASE_URL ?>/public/uploads/slider/<?php echo $i['image_slider']; ?>" height="100" width="100" alt=""> </p>
                </div>
                <div class="m-3">
                <button type="submit" class="btn btn-success float-end">Lưu</button>

                </div>
                </form>

            <?php
                };
            ?>
            </div>
        </div>
        
    </div>
</div>