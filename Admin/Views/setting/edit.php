
<div>
    <div class="row">
        <div class="col-mb-12">
            <div class="card-header">
                <h3>Sửa setting
                <a  href="<?php echo BASE_URL ?>/admin/setting" class="btn btn-primary btn-sm float-end">Quay lại</a>
                </h3>
            </div>
            <div class="card-body">
            <?php
                foreach($setting as $key => $i){
            ?>
            <form  action="<?php echo BASE_URL ?>/admin/setting/updatesetting/<?php echo $i['id']?>" method="POST">
                <div class="mb-3">
                    <label class="form-label">Tên website</label>
                    <input type="text" class="form-control" value="<?php echo $i['website_name']?>" name="website_name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Đường dẫn</label>
                    <input type="text" class="form-control" value="<?php echo $i['website_url']?>" name="website_url">
                </div>
                <div class="mb-3">
                    <label class="form-label">Điện Thoại</label>
                    <input type="text" class="form-control" value="<?php echo $i['phone']?>" name="phone">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" value="<?php echo $i['email']?>" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Facebook</label>
                    <input type="text" class="form-control" value="<?php echo $i['facebook']?>" name="facebook">
                </div>
                <div class="mb-3">
                    <label class="form-label">Hiện thị</label>
                    <select name="status" class="form-select">
                        <option value="1" <?php if ($i['status'] == 1) echo 'selected'; ?>>Có</option>
                        <option value="0" <?php if ($i['status'] == 0) echo 'selected'; ?>>Không</option>
                    </select>
                </div>
                    <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
                </form>

            <?php
                };
            ?>
            </div>
        </div>
        
    </div>
</div>