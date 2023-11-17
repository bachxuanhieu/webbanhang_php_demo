<footer id="footer">
 
   <div class="section">
 
      <div class="container">
  
         <div class="row">
            <div class="col-md-4 col-xs-6">
               <div class="footer">
                  <h3 class="footer-title">Thông tin</h3>
                  <p>Yasuo là vị tướng quốc dân của Việt Nam, giúp bạn trải nghiệm cảm giác ăn hành ngập mồm.</p>
                  <ul class="footer-links">
                  <?php
                     foreach($setting as $keys => $i){
                     ?>
                     <li><a href="<?php echo $i['website_url']?>"><i class="fa fa-map-marker"></i><?php echo $i['website_name'] ?></a></li>
                     <?php
                     }
                     ?>
                     <?php
                     foreach($setting as $keys => $i){
                     ?>
                     <li><a href="#"><i class="fa fa-phone"></i><?php echo $i['phone'] ?></a></li>
                     <?php
                     }
                     ?>
                     <?php
                     foreach($setting as $keys => $i){
                     ?>
                     <li><a href="<?php echo $i['facebook']?>"><i class="fa fa-envelope-o"></i><?php echo $i['email'] ?></a></li>
                     <?php
                     }
                     ?>
       
                  </ul>
               </div>
            </div>

            <div class="col-md-4 col-xs-6">
               <div class="footer">
                  <h3 class="footer-title">Danh Mục Sản Phẩm</h3>
                  <ul class="footer-links">
                  <?php
                     foreach($category as $key => $cate):
                  ?>
						   <li><a href="<?php echo BASE_URL ?>/product/product_category/<?php echo $cate['id_category_product'] ?>"><?php echo $cate['title_category_product'] ?></a></li>
                  <?php
                     endforeach;
                  ?>
                  </ul>
               </div>
            </div>

            <div class="clearfix visible-xs"></div>


            <div class="col-md-4 col-xs-6">
               <div class="footer">
                  <h3 class="footer-title">Thông Tin</h3>
                  <ul class="footer-links">
                     <li><a href="#">My Account</a></li>
                     <li><a href="#">View Cart</a></li>
                     <li><a href="#">Wishlist</a></li>
                     <li><a href="#">Track My Order</a></li>
                     <li><a href="#">Help</a></li>
                  </ul>
               </div>
            </div>
         </div>
     
      </div>
   
   </div>


 
</footer>
<!-- /FOOTER -->


<!-- jQuery Plugins -->
<script src="<?php echo BASE_URL ?>/public/views/js/jquery.min.js"></script>
<script src="<?php echo BASE_URL ?>/public/views/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_URL ?>/public/views/js/slick.min.js"></script>
<script src="<?php echo BASE_URL ?>/public/views/js/nouislider.min.js"></script>
<script src="<?php echo BASE_URL ?>/public/views/js/jquery.zoom.min.js"></script>
<script src="<?php echo BASE_URL ?>/public/views/js/main.js"></script>



</body>
</html>