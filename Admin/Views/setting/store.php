<div>
    <div class="row p-2">
        <div class="col-mb-12">
            <div class="card-header">
                <h3>Thêm thông tin website
                <a  href="<?php echo BASE_URL ?>/admin/setting" class="btn btn-primary btn-sm float-end">Quay lại</a>
                </h3>
            </div>
            <div class="card-body">
            <form  action="<?php echo BASE_URL ?>/admin/setting/insertsetting" method="POST">
                <div class="mb-3">
                    <label class="form-label">Tên website</label>
                    <input type="text" class="form-control" name="website_name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Đường dẫn</label>
                    <input type="text" class="form-control" name="website_url">
                </div>
                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="number" class="form-control" name="phone">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">FaceBook</label>
                    <input type="text" class="form-control" name="facebook">
                </div>
               
                <div class="mb-3">
                    <label  class="form-label">Hiện thị</label>
                    <select name="status" id="" class="form-label">
                        <option value="1">có</option>
                        <option value="0">không</option>
                    </select>

                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
                </form>
            </div>
        </div>
        
    </div>
</div>