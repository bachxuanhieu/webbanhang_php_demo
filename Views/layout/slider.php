<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Các phần tử slider -->
    <div class="carousel-inner" role="listbox">
        <?php foreach ($sliders as $key => $slider) : ?>
            <div class="item <?= $key === 0 ? 'active' : '' ?>">
                <img src="<?php echo BASE_URL ?>/public/uploads/slider/<?= $slider['image_slider'] ?>" style="width: 100%; height:700px" alt="<?= $slider['title_slider'] ?>">
                <div class="container">
                    <div class="carousel-caption">
                        <h1 style="color:red">
                            <?= $slider['title_slider'] ?>
                        </h1>
                        <h3 style="color:white"><?= $slider['desc_slider'] ?></h3>
                        <!-- Các nút điều hướng và nút xem chi tiết khác -->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    
    <!-- Nút điều hướng sau -->
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
