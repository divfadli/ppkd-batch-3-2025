<?php 
  session_start(); 
  ob_start();
  include 'koneksi.php';
  if(empty($_SESSION['ID_USER'])){
    // header("location:index.php?access=failed");
    header("location:./?access=failed");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Components / Accordion - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <?php include '../admin/inc/css.php'?>

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <!-- Summernote BootStrap-lite -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <!-- END Summernote BootStrap-lite -->

    <!-- InputTags JQuery -->
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/jquery.tagsinput.min.css" />
    <script src="assets/js/jquery.tagsinput.min.js"></script> -->
    <script src="assets/js/tagify/tagify.js"></script>
    <link rel="stylesheet" href="assets/js/tagify/tagify.css">
    <!-- END InputTags JQuery -->
</head>

<body>

    <!-- ======= Header ======= -->
    <?php include '../admin/inc/header.php'?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php include '../admin/inc/sidebar.php'?>
    <!-- End Sidebar-->

    <main id="main" class="main">
        <?php
            if(isset($_GET['page'])){
              if(file_exists('content/' . $_GET['page'] . '.php')){
                include 'content/' . $_GET['page'] . '.php';
              }else{
                include 'content/notfound.php';
              }
            }else{
              include 'content/dashboard.php';
            }
          ?>



    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include '../admin/inc/footer.php'?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <?php include '../admin/inc/js.php'?>

    <script>
    $('#summernote').summernote({
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
    });

    // $('#tags').tagsInput();
    let input = document.querySelector('#tags');
    var tagify = new Tagify(input)
    </script>

</body>

</html>