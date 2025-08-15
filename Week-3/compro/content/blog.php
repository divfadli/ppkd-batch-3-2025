<?php
    $queryBlogsCategories = mysqli_query($koneksi, "SELECT categories.name as category_name, blogs.* FROM blogs JOIN categories ON categories.id = blogs.category_id WHERE is_active = 1 ORDER BY blogs.id DESC");
    // All (Data lebih dari satu)
    $rowBlogsCategories = mysqli_fetch_all($queryBlogsCategories, MYSQLI_ASSOC);


?>

<!-- Page Title -->
<div class="page-title accent-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Blog</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="index.html">Home</a></li>
                <li class="current">Blog</li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->

<!-- Blog Posts Section -->
<section id="blog-posts" class="blog-posts section">

    <div class="container">
        <div class="row gy-4">

            <?php foreach($rowBlogsCategories as $val): ?>
            <div class="col-lg-4">
                <article class="position-relative h-100">
                    <?php 
                    $date_blog = $val['created_at'];
                    $date_blog = date("M d", strtotime($date_blog));
                    ?>

                    <div class="post-img position-relative overflow-hidden">
                        <img src="admin/uploads/<?= $val['image']?>" class="img-fluid" alt="">
                        <span class="post-date"><?= $date_blog ?></span>
                    </div>

                    <div class="post-content d-flex flex-column">

                        <h3 class="post-title"><?= $val['title']?></h3>

                        <div class="meta d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person"></i> <span class="ps-2"><?= $val['penulis']?></span>
                            </div>
                            <span class="px-3 text-black-50">/</span>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-folder2"></i> <span class="ps-2"><?= $val['category_name']?></span>
                            </div>
                        </div>

                        <?= $val['content'] ?>
                        <hr>

                        <a href="?page=blog-detail&id=<?= $val['id']?>" class="readmore stretched-link"><span>Read
                                More</span><i class="bi bi-arrow-right"></i></a>

                    </div>

                </article>
            </div><!-- End post list item -->
            <?php endforeach; ?>
        </div>
    </div>

</section><!-- /Blog Posts Section -->

<!-- Blog Pagination Section -->
<section id="blog-pagination" class="blog-pagination section">

    <div class="container">
        <div class="d-flex justify-content-center">
            <ul>
                <li><a href="#"><i class="bi bi-chevron-left"></i></a></li>
                <li><a href="#">1</a></li>
                <li><a href="#" class="active">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li>...</li>
                <li><a href="#">10</a></li>
                <li><a href="#"><i class="bi bi-chevron-right"></i></a></li>
            </ul>
        </div>
    </div>

</section><!-- /Blog Pagination Section -->