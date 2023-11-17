<div>
    <div class="row">
        <div class="col-mb-12">
            <div class="card-header">
                <h3>Sửa danh sách bài viết
                <a href="<?php echo BASE_URL ?>/admin/new/index" class="btn btn-primary btn-sm float-end">Quay lại</a>
                </h3>
            </div>
            <div class="card-body">
                <?php
                foreach($new as $key => $i){
                ?>
                    <form  action="<?php echo BASE_URL ?>/admin/new/updatenew/<?php echo $i['id_category_post'] ?>" method="POST">
                    
                        <div class="mb-3">
                            <label class="form-label">Tên Danh Mục Bài Viết</label>
                            <input type="text" class="form-control" value="<?php echo $i['title_category_post'] ?>" name="title_category_post">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Miêu tả</label>
                            <textarea id="myTextarea" type="text" class="form-control"  name="desc_category_post" ><?php echo $i['desc_category_post'] ?></textarea>
                        </div>
                            <button type="submit" class="btn btn-success float-end">Lưu</button>
                    </form>
                <?php
                    };
                ?>
              
            </div>
        </div>
        
    </div>
</div>