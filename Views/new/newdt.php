<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tin tức</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo BASE_URL ?>/public/new/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo BASE_URL ?>/public/new/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo BASE_URL ?>/public/new/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="<?php echo BASE_URL ?>/public/new/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?php echo BASE_URL ?>/public/new/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS Files -->
  <link href="<?php echo BASE_URL ?>/public/new/assets/css/variables.css" rel="stylesheet">
  <link href="<?php echo BASE_URL ?>/public/new/assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: ZenBlog
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
  * Author: BootstrapMade.com
  * License: https:///bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="<?php echo BASE_URL ?>/home/index" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>Trang chủ</h1>
      </a>

 

      <div class="position-relative">
        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <form action="search-result.html" class="search-form">
            <span class="icon bi-search"></span>
            <input type="text" placeholder="Search" class="form-control">
            <button class="btn js-search-close"><span class="bi-x"></span></button>
          </form>
        </div><!-- End Search Form -->

      </div>

    </div>

  </header><!-- End Header -->

  <main id="main">

  <section id="search-result" class="search-result">
      <div class="container">
        <div class="row">
        <div class="col-md-9 post-content" data-aos="fade-up">

<!-- ======= Single Post Content ======= -->
<?php
foreach($postDetail as $keys => $i){
    $firstCharacter = substr($i['content_post'], 0, 1);
?>
<div class="single-post">
  <h1 class="mb-5"><?php echo $i['title_post'] ?></h1>
  

  <figure class="my-4">
    <img style="padding: 20px; width: 900px" src="<?php echo BASE_URL ?>/public/uploads/new/<?php echo $i['image_post'] ?>" alt="" class="img-fluid">
    
  </figure>
  <p><span class="firstcharacter"><?php echo $firstCharacter  ?></span><?php echo $i['content_post'] ?>.</p>
</div><!-- End Single Post Content -->
<?php
}
?>

<!-- <div class="comments">
  <h5 class="comment-title py-4">2 Comments</h5>
  <div class="comment d-flex mb-4">
    <div class="flex-shrink-0">
      <div class="avatar avatar-sm rounded-circle">
        <img class="avatar-img" src="assets/img/person-5.jpg" alt="" class="img-fluid">
      </div>
    </div>
    <div class="flex-grow-1 ms-2 ms-sm-3">
      <div class="comment-meta d-flex align-items-baseline">
        <h6 class="me-2">Jordan Singer</h6>
        <span class="text-muted">2d</span>
      </div>
      <div class="comment-body">
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non minima ipsum at amet doloremque qui magni, placeat deserunt pariatur itaque laudantium impedit aliquam eligendi repellendus excepturi quibusdam nobis esse accusantium.
      </div>

      <div class="comment-replies bg-light p-3 mt-3 rounded">
        <h6 class="comment-replies-title mb-4 text-muted text-uppercase">2 replies</h6>

        <div class="reply d-flex mb-4">
          <div class="flex-shrink-0">
            <div class="avatar avatar-sm rounded-circle">
              <img class="avatar-img" src="assets/img/person-4.jpg" alt="" class="img-fluid">
            </div>
          </div>
          <div class="flex-grow-1 ms-2 ms-sm-3">
            <div class="reply-meta d-flex align-items-baseline">
              <h6 class="mb-0 me-2">Brandon Smith</h6>
              <span class="text-muted">2d</span>
            </div>
            <div class="reply-body">
              Lorem ipsum dolor sit, amet consectetur adipisicing elit.
            </div>
          </div>
        </div>
        <div class="reply d-flex">
          <div class="flex-shrink-0">
            <div class="avatar avatar-sm rounded-circle">
              <img class="avatar-img" src="assets/img/person-3.jpg" alt="" class="img-fluid">
            </div>
          </div>
          <div class="flex-grow-1 ms-2 ms-sm-3">
            <div class="reply-meta d-flex align-items-baseline">
              <h6 class="mb-0 me-2">James Parsons</h6>
              <span class="text-muted">1d</span>
            </div>
            <div class="reply-body">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio dolore sed eos sapiente, praesentium.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="comment d-flex">
    <div class="flex-shrink-0">
      <div class="avatar avatar-sm rounded-circle">
        <img class="avatar-img" src="assets/img/person-2.jpg" alt="" class="img-fluid">
      </div>
    </div>
    <div class="flex-shrink-1 ms-2 ms-sm-3">
      <div class="comment-meta d-flex">
        <h6 class="me-2">Santiago Roberts</h6>
        <span class="text-muted">4d</span>
      </div>
      <div class="comment-body">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto laborum in corrupti dolorum, quas delectus nobis porro accusantium molestias sequi.
      </div>
    </div>
  </div>
</div> -->


<!-- <div class="row justify-content-center mt-5">

  <div class="col-lg-12">
    <h5 class="comment-title">Leave a Comment</h5>
    <div class="row">
      <div class="col-lg-6 mb-3">
        <label for="comment-name">Name</label>
        <input type="text" class="form-control" id="comment-name" placeholder="Enter your name">
      </div>
      <div class="col-lg-6 mb-3">
        <label for="comment-email">Email</label>
        <input type="text" class="form-control" id="comment-email" placeholder="Enter your email">
      </div>
      <div class="col-12 mb-3">
        <label for="comment-message">Message</label>

        <textarea class="form-control" id="comment-message" placeholder="Enter your name" cols="30" rows="10"></textarea>
      </div>
      <div class="col-12">
        <input type="submit" class="btn btn-primary" value="Post comment">
      </div>
    </div>
  </div>
</div> -->

</div>

          <div class="col-md-3">
            <!-- ======= Sidebar ======= -->
            <div class="aside-block">

              <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <h3>Danh mục bài viết</h3>
                </li>
              </ul>

              <div class="tab-content" id="pills-tabContent">

                <!-- Popular -->
                <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
                    <?php
                        foreach($category_post as $keys => $i){
                    ?>
                  <div class="post-entry-1 border-bottom">
                    <h2 class="mb-2"><a href="<?php echo BASE_URL ?>/new/newCategory/<?php echo $i['id_category_post'] ?>"><?php echo $i['title_category_post'] ?></a></h2>
                    <span class="author mb-3 d-block"><?php echo $i['desc_category_post'] ?></span>
                  </div>
                    <?php
                        }
                    ?>
                
                </div> <!-- End Popular -->

            
              </div>
            </div>


          </div>

        </div>
      </div>
    </section> <!-- End Search Result -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

   

    <div class="footer-legal">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <div class="copyright">
              © Copyright <strong><span>ZenBlog</span></strong>. All Rights Reserved
            </div>

            <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>

          </div>

          </div>

        </div>

      </div>
    </div>

  </footer>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo BASE_URL ?>/public/new/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo BASE_URL ?>/public/new/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?php echo BASE_URL ?>/public/new/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?php echo BASE_URL ?>/public/new/assets/vendor/aos/aos.js"></script>
  <script src="<?php echo BASE_URL ?>/public/new/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo BASE_URL ?>/public/new/assets/js/main.js"></script>

</body>

</html>