<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Thông tin Website
                        <a href="<?php echo BASE_URL ?>/admin/setting/addsetting" class="btn btn-success btn-sm float-end">Thêm thông tin</a>
                    </h5>
                </div>
                <div class="card-body">
                <table class="table table-success table-striped">
                    <thead>
                        <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên website</th>
                        <th scope="col">URL</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Email</th>
                        <th scope="col">Facebook</th>
                        <th scope="col">Sử lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $j=0;
                            foreach($settings as $keys => $i){
                                $j++;
                        ?>
                        <tr>
                            <td><?php echo $j ?></td>
                            <td><?php echo $i['website_name'] ?></td>
                            <td><?php echo $i['website_url'] ?></td>
                            <td><?php echo $i['phone'] ?></td>
                            <td><?php echo $i['email'] ?></td>
                            <td><?php echo $i['facebook'] ?></td>
                            <td>
                            <button  data-bs-toggle="modal" data-bs-target="#deletesetting" class="btn btn-danger btn-sm m-2">
                                            Xóa
                                        </button>
                                        <div class="modal fade" id="deletesetting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Xóa setting</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Dữ liệu setting sẽ bị xóa. Bạn có muốn xóa?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">No</button>
                                                    <a href="<?php echo BASE_URL ?>/admin/setting/deletesetting/<?php echo $i['id'] ?>" type="button" class="btn btn-danger">Yes</a>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <a href="<?php echo BASE_URL ?>/admin/setting/editsetting/<?php echo $i['id'] ?>"
                                        class="btn btn-info btn-sm m-2">Sửa</a>
                        </td>
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