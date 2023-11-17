
<div>
    <div class="row">
        <div class="col-mb-12">
            <div class="card-header">
                <h3>Sửa bài viết
                <a  href="<?php echo BASE_URL ?>/admin/newdt" class="btn btn-primary btn-sm float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
            <?php
                foreach($postbyid as $key => $i){
            ?>
            <form  action="<?php echo BASE_URL ?>/admin/newdt/updatenewdt/<?php echo $i['id_post']?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Tên bài viết</label>
                    <input type="text" class="form-control" value="<?php echo $i['title_post']?>" name="title_post">
                </div>
            
                <div class="mb-3">
                    <label class="form-label">Nội dung bài viết</label>
                    <textarea id="myTextarea" name="content_post"  class="form-control" rows="5"><?php echo $i['content_post']?></textarea>
                </div>
                <div class="mb-3">
                    <label  class="form-label">Hình ảnh bài viết</label>
                    <input type="file" name="image_post" class="form-control" >
                    <p> <img src="<?php echo BASE_URL ?>/public/uploads/new/<?php echo $i['image_post']; ?>" height="100" width="100" alt=""> </p>
                </div>
                <div class="mb-3">
                    <label  class="form-label">Danh mục  bài viết</label>
                    <select name="category_post" id="" class="form-label">
                    <?php
                    foreach($new as $key => $i){
                    ?>
                    <option value="<?php echo $i['id_category_post'] ?>"><?php echo $i['title_category_post'] ?></option>
                    <?php
                    }
                    ?>
                    </select>
                </div>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </form>

            <?php
                };
            ?>
            </div>
        </div>
        
    </div>
</div>