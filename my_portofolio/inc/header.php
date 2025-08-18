<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">
            <img src="admin/uploads/<?= $rowSetting['logo']?>" alt="" class="img-fluid" style="max-height:80px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" 
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php
            // Ambil parameter page (default 'home')
            $currentPage = $_GET['page'] ?? 'home';
            $currentPage = htmlspecialchars($currentPage, ENT_QUOTES, 'UTF-8');

            // Menu navigasi
            $menu = [
                'home'        => 'Beranda',
                'about'       => 'Tentang',
                'skills'      => 'Keahlian',
                'portofolio'  => 'Portfolio',
                'experience'  => 'Pengalaman',
                'contact'     => 'Kontak',
            ];
        ?>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php foreach ($menu as $key => $label): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentPage === $key ? 'active' : '') ?>" 
                           href="<?= ($key === 'home') ? '/' : '/?page=' . $key ?>">
                            <?= $label ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>
