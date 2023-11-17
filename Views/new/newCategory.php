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
          <div class="col-md-9">
            <h3 class="category-title">Bài Viết</h3>
            <?php
                foreach($newCategory as $keys => $i){
            ?>
            <div class="d-md-flex post-entry-2 small-img">
              <a href="<?php echo BASE_URL ?>/new/newDetail/<?php echo $i['id_post'] ?>" class="me-4 thumbnail">
                <img src="<?php echo BASE_URL ?>/public/uploads/new/<?php echo $i['image_post'] ?>" alt="" class="img-fluid">
              </a>
              <div>
                <h3><a href="<?php echo BASE_URL ?>/new/newDetail/<?php echo $i['id_post'] ?>"><?php echo $i['title_post'] ?></a></h3>
                <div class="d-flex align-items-center author">
                  <div class="photo"><img src="assets/img/person-2.jpg" alt="" class="img-fluid"></div>
                  
                </div>
              </div>
            </div>
            <?php
                }
            ?>


            <!-- Paging -->
            <!-- <div class="text-start py-4">
              <div class="custom-pagination">
                <a href="#" class="prev">Prevous</a>
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#" class="next">Next</a>
              </div>
            </div>End Paging -->

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
