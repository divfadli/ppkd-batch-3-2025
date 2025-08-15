<?php
        $queryCategories = mysqli_query($koneksi, "SELECT DISTINCT categories.id AS id_category, categories.name AS category_name FROM categories INNER JOIN portofolio ON portofolio.category_id = categories.id WHERE type = 'portofolio' ORDER BY categories.id DESC");
        $rowCategories = mysqli_fetch_all($queryCategories, MYSQLI_ASSOC);

        $queryPortofolios = mysqli_query($koneksi, "SELECT categories.name as category_name, categories.id as id_category, portofolio.* FROM portofolio LEFT JOIN categories ON categories.id = portofolio.category_id WHERE is_active = 1 ORDER BY portofolio.id DESC");
        $rowPortofolios = mysqli_fetch_all($queryPortofolios, MYSQLI_ASSOC);
    ?>

<!-- Page Title -->
<div class="page-title accent-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Portfolio</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="index.html">Home</a></li>
                <li class="current">Portfolio</li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->

<!-- Portfolio Section -->
<section id="portfolio" class="portfolio section">

    <div class="container">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

            <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                <li data-filter="*" class="filter-active">All</li>
                <?php foreach($rowCategories as $val): ?>
                <li data-filter=".filter-<?= $val['category_name']?>"><?= $val['category_name']?></li>
                <?php endforeach ?>
                <!-- <?php foreach($rowPortofolios as $key => $val):?>
                    <li data-filter=".filter-<?= $val['id_category']?>"><?= $val['category_name']?></li>
                    <?php endforeach ?> -->
            </ul><!-- End Portfolio Filters -->

            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                <?php foreach($rowPortofolios as $key => $val): ?>
                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-<?= $val['category_name']?>">
                    <img src="admin/uploads/<?= $val['image']?>" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4><?= $val['title']?></h4>
                        <p><?= $val['content']?></p>
                        <a href="admin/uploads/<?= $val['image']?>"
                            title="<?= $val['category_name'] . " ". ($key+=1) ?>"
                            data-gallery="portfolio-gallery-<?= $val['category_name'] ?>"
                            class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                        <a href="?page=portofolio-detail&id=<?= $val['id']?>" title="More Details"
                            class="details-link"><i class="bi bi-link-45deg"></i></a>
                    </div>
                </div><!-- End Portfolio Item -->
                <?php endforeach ?>
            </div><!-- End Portfolio Container -->

        </div>

    </div>

</section><!-- /Portfolio Section -->