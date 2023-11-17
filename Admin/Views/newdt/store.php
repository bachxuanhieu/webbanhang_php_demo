
<div>
    <div class="row p-1 m-2">
        <div class="col-mb-12">
            <div class="card-header">
                <h3>Thêm bài viết
                <a  href="<?php echo BASE_URL ?>/admin/newdt" class="btn btn-primary btn-sm float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
            <form  action="<?php echo BASE_URL ?>/admin/newdt/insertnewdt" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Tên Bài Viết</label>
                    <input type="text" class="form-control" name="title_post">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nội Dung Bài Viết</label>
                   <textarea id="myTextarea" name="content_post" id="" class="form-control" rows="10"></textarea>
                </div>
                    <label class="form-label">Hình ảnh</label>
                    <input type="file" class="form-control" name="image_post" >
                </div>
                <div class="mb-3">
                    <label  class="form-label">Danh mục  bài viết</label>
                    <select name="category_post" id="" class="form-label">
                    <?php
                    foreach($news as $key => $i){
                    ?>
                    <option value="<?php echo $i['id_category_post'] ?>"><?php echo $i['title_category_post'] ?></option>
                    <?php
                    }
                    ?>
                    </select>
                </div>
                    <button type="submit" class="btn btn-success float-end">Lưu</button>
                </form>
            </div>
        </div>
        
    </div>
</div>

