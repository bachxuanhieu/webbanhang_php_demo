<div class="section">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="section-title">
               <h3 class="title">Từ khóa: <?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?></h3>
            </div>
         </div>
         <div class="col-md-12">
            <div class="container">
               <div id="store" class="col-md-12">
                  <div class="row">
                     <!-- product -->
                     <?php
                        foreach ($products as $key => $i): 
                           $sale = (($i['price_product'] - $i['selling_product']) / $i['price_product']) * 100;
                           $sale = ceil($sale);
                        
                        ?>
                     <div class="col-md-3 col-xs-6">
                        <div class="product">
                           <div class="product-img">
                              <img src="<?php echo BASE_URL ?>/public/uploads/product/<?php echo $i['image_product'] ?>" style="height:230px" alt="">
                              <div class="product-label">
                                 <span class="sale">-<?php echo $sale ?>%</span>
                                 <span class="new">NEW</span>
                              </div>
                           </div>
                           <div class="product-body">
                              <h3 class="product-name"><a href="#"><?php echo $i['title_product']?></a></h3>
                              <h4 class="product-price">$<?php echo $i['selling_product']?><del class="product-old-price">$<?php echo $i['price_product']?></del></h4>
                              <div class="product-rating">
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                              </div>
                              <div class="product-btns">
                                 <a  class="btn btn-danger btn-sm" href="<?php echo BASE_URL ?>/product/productdetail/<?php echo $i['id_category_product'] ?>/<?php echo $i['id_product'] ?>">Xem chi tiết</a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php
                        endforeach;
                        ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>