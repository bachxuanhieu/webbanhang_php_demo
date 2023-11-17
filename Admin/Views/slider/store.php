
<div>
    <div class="row p-2">
        <div class="col-mb-12">
            <div class="card-header">
                <h3>Thêm Slider
                <a  href="<?php echo BASE_URL ?>/admin/slider" class="btn btn-primary btn-sm float-end">Quay lại</a>
                </h3>
            </div>
            <div class="card-body">
            <form  action="<?php echo BASE_URL ?>/admin/slider/insertslider" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control" name="title_slider">
                </div>
               
                <div class="mb-3">
                    <label  class="form-label">Hiện thị</label>
                    <select name="status_slider" id="" class="form-label">
                        <option value="1">có</option>
                        <option value="0">không</option>
                    </select>

                    </div>

                <div class="mb-3">
                    <label class="form-label">Miêu tả</label>
                    <textarea id="editor" name="desc_slider"  class="form-control" rows="5"></textarea>
                </div>
            
                <div class="mb-3">
                    <label class="form-label">Hình ảnh</label>
                    <input type="file" class="form-control" name="image_slider" >
                </div>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </form>
            </div>
        </div>
        
    </div>
</div>