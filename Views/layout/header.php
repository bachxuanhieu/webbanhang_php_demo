<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
       <title>Electro - HTML Ecommerce Template</title>


<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">


<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL ?>/public/views/css/bootstrap.min.css"/>


<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL ?>/public/views/css/slick.css"/>
<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL ?>/public/views/css/slick-theme.css"/>


<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL ?>/public/views/css/nouislider.min.css"/>


<link rel="stylesheet" href="<?php echo BASE_URL ?>/public/views/css/font-awesome.min.css">


<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL ?>/public/views/css/style.css"/>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="<?php echo BASE_URL ?>/public/tinymce/tinymce.min.js"></script>
<!-- <script>
        tinymce.init({
            selector: '#comment_content', // Chọn phần tử có id là 'myTextarea' để biến đổi thành trình soạn thảo
            plugins: 'advlist autolink lists link image charmap print preview',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            menubar: true, // Tắt thanh menu trên trình soạn thảo
        });
</script> -->
<style>
   .rating_product{
      display: flex;
      margin-bottom: 5px;
   }
   
   
#product-imgs{
 height: 600px;
 
}
  
</style>



</head>
<body>        
<header>

<div id="top-header">
   <div class="container">
      <ul class="header-links pull-left">
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
      <ul class="header-links pull-right">
    

                                 <?php
                                 if (Session::get('users')){
                                 ?>
                                 <li><a href="<?php echo BASE_URL ?>/cart/listorder"><i class="fa fa-list"></i>Đơn Hàng</a></li>
                                 <li><a href="<?php echo BASE_URL ?>/user/logout"><i class="fa fa-user-o"></i>Đăng Xuất</a></li>
                                 <?php
                                 }else{
                                 ?>
                                  <li><a href="<?php echo BASE_URL ?>/user"><i class="fa fa-user-o"></i>Tài khoản</a></li>
                                 <?php
                                 }
                                 ?>

       
      </ul>
   </div>
</div>
<!-- /TOP HEADER -->

<!-- MAIN HEADER -->
<div id="header">
   <!-- container -->
   <div class="container">
      <!-- row -->
      <div class="row">
         <!-- LOGO -->
         <div class="col-md-3">
            <div class="header-logo">
               <a href="<?php echo BASE_URL ?>" class="logo">
                  <img src="<?php echo BASE_URL ?>/public/uploads/img_logo/logo2.jpg" style="height: 80px; width:150px; border-radius:30px" alt="">
               </a>
            </div>
         </div>
         <!-- /LOGO -->

         <!-- SEARCH BAR -->
         <div class="col-md-6">
            <div class="header-search">
            <form action="<?php echo BASE_URL; ?>/product/search_product" method="GET">
                  <input class="input"  name="keyword" placeholder="Tìm kiếm sản phẩm.....">
                  <button class="search-btn" type="submit">Search</button>
               </form>
            </div>
         </div>
         <!-- /SEARCH BAR -->

         <!-- ACCOUNT -->
         <div class="col-md-3 clearfix">
            <div class="header-ctn">
               <!-- Wishlist -->
               <div>
                  <a href="<?php echo BASE_URL ?>/wishlist/wishlist">
                     <i class="fa fa-heart-o"></i>
                     <?php
                         if (Session::get('users')){
                     ?>
                       <span>Yêu thích</span>
                       
                     <?php
                         }else{
                     ?>
                     <span>Yêu thích</span>
                     <div class="qty">0</div>
                     <?php
                         }
                     ?>
                  </a>
               </div>
               <!-- /Wishlist -->
             
               <!-- Cart -->
               <div>
                  <a href="<?php echo BASE_URL ?>/cart/index">
                     <i class="fa fa-shopping-cart"></i>
                     <?php
                         if (Session::get('users')){
                     ?>
                       <span>Giỏ hàng</span>
                        
                     <?php
                         }else{
                     ?>
                     <span>Giỏ hàng</span>
                     <div class="qty">0</div>
                     <?php
                         }
                     ?>
                  </a>
               </div>
               <!-- /Cart -->

               <!-- Menu Toogle -->
               <div class="menu-toggle">
                  <a href="#">
                     <i class="fa fa-bars"></i>
                     <span>Menu</span>
                  </a>
               </div>
               <!-- /Menu Toogle -->
            </div>
         </div>
         <!-- /ACCOUNT -->
      </div>
      <!-- row -->
   </div>
   <!-- container -->
</div>
<!-- /MAIN HEADER -->
<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="<?php echo BASE_URL ?>/home/index">Trang Chủ</a></li>
                  <?php
                     foreach($category as $key => $cate):
                  ?>
                  	<li><a href="<?php echo BASE_URL ?>/product/product_category/<?php echo $cate['id_category_product'] ?>"><?php echo $cate['title_category_product'] ?></a>

						   <!-- <li><a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo BASE_URL ?>/product/product_category/<?php echo $cate['id_category_product'] ?>"><?php echo $cate['title_category_product'] ?></a>
                              <ul class="dropdown-menu">
                                 <li><a href="<?php echo BASE_URL ?>/product/product_category/<?php echo $cate['id_category_product'] ?>">Tất cả <?php echo $cate['title_category_product'] ?></a></li>
                                 <?php
                                    foreach($brands as $i){
                                       if($i['id_category_product'] == $cate['id_category_product']){
                                 ?>
                                       <li><a href="#"><?php echo $i['title_brand'] ?></a></li>
                                 <?php
                                    }
                                 }
                                 ?>
                              </ul>
                     </li> -->
                  <?php
                     endforeach;
                  ?>
						<li><a href="<?php echo BASE_URL ?>/new/index">Tin Tức</a></li>
             
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
</header>






