<?php
    // Ambil halaman aktif dari parameter GET
    $currentPage = $_GET['page'] ?? 'home';
    $currentPage = htmlspecialchars($currentPage, ENT_QUOTES, 'UTF-8');

    include 'admin/koneksi.php';

    // Settings
    $querySetting = mysqli_query($koneksi,'SELECT * FROM settings LIMIT 1');
    $rowSetting = mysqli_fetch_assoc($querySetting);
    
    // Abouts
    $queryAbout = mysqli_query($koneksi, "
        SELECT a.*, u.name AS name_user 
        FROM abouts a 
        JOIN users u ON u.id = a.created_by 
        WHERE a.is_active = 1 
        ORDER BY a.id DESC 
        LIMIT 1
    ");
    $rowAbout   = mysqli_fetch_assoc($queryAbout);
    // Jika kosong, beri fallback
    if (!$rowAbout) {
        $rowAbout = [
            'name_user' => 'Guest',
            'image' => 'assets/profil/default.jpg'
        ];
    }

    // Services
    $queryServices = mysqli_query($koneksi, "SELECT * FROM services WHERE is_active = 1 ORDER BY id ASC");
    $servicesHome = mysqli_fetch_all($queryServices, MYSQLI_ASSOC);

    // Values Kerja
    $queryValuesKerja = mysqli_query($koneksi, "SELECT * FROM values_section WHERE is_active = 1 ORDER BY id ASC");
    $valuesKerja = mysqli_fetch_all($queryValuesKerja, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $rowAbout['name_user']?> - Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7a57a04210.js" crossorigin="anonymous"></script>
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body data-page="<?= $currentPage ?>">
    <?php include 'inc/header.php'; ?>

    <main class="main">
        <?php
            if(isset($_GET['page'])){
                if(file_exists('content/' . $_GET['page'] . '.php')){
                    include 'content/' . $_GET['page'] . '.php';
                } else {
                    include 'content/notfound.php';
                }
            } else {
                include 'content/home.php';
            }
        ?>
    </main>

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>
</body>
</html>