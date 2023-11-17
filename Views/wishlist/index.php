



<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
                <div class="col-md-12 order-details">
						<div class="section-title text-center">
							<h3 class="title text-info">Sản phẩm yêu thích</h3>
                            <?php
                            if(!empty($_GET['msg'])){
                                $msg=unserialize(urldecode($_GET['msg']));
                                foreach($msg as $key => $value){
                            ?>  
                                    <div class="alert alert-primary" role="alert">
                                        <?php echo $value?>
                                    </div>

                            <?php
                                }
                            }

                            ?>
						</div>
						<table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Sử lý</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                            if(isset($product)){
                            foreach($product as $keys => $pro){
                            ?>
                                <tr>
                                    <td></a><?php echo $pro['title_product'] ?></td>
                                    <td><img src="<?php echo BASE_URL ?>/public/uploads/product/<?php echo $pro['image_product'] ?>" style="width: 100px; height:100px" alt=""></td>
                                    <td>$ <?php echo number_format( $pro['price_product']) ?></td>
                                    <td><a href="<?php echo BASE_URL ?>/wishlist/DeleteWishlist/<?php echo $pro['id_product'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                                        <a class="btn btn-info btn-sm" href="<?php echo BASE_URL ?>/product/productdetail/<?php echo $pro['id_category_product'] ?>/<?php echo $pro['id_product'] ?>">Xem chi tiết</a>
                                    </td>
                                </tr>
                            <?php
                                }
                            }else{
                            ?>

                                <div>
                                    <h3>chưa có sản phâm yêu thích.</h3>
                                </div>    
                            <?php
                            }
                            ?>
                            </tbody>
                            </table>
					</div>
                </div>
            </div>
</div>
            