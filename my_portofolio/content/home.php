 <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-100 mt-5">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <h2 class="hero-title">
                            Halo, Saya <span class="text-primary"><?= $rowAbout['name_user']?></span>
                        </h2>
                        <h3 class="hero-subtitle">
                        <span class="typing-text" data-text='["Full Stack Developer", "Web Developer", "Mobile Developer"]'></span>
                        </h3>

                        <p class="hero-description">
                            Saya adalah seorang developer berpengalaman dengan passion dalam menciptakan 
                            solusi digital yang inovatif dan user-friendly. Spesialisasi dalam pengembangan 
                            web modern dan aplikasi mobile.
                        </p>
                        <div class="hero-buttons">
                            <a href="?page=portofolio" class="btn btn-primary btn-lg me-3">
                                <i class="fas fa-eye me-2"></i>Lihat Portfolio
                            </a>
                            <a href="?page=contact" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-envelope me-2"></i>Hubungi Saya
                            </a>
                        </div>
                        <div class="social-links mt-4">
                            <a href="<?= $rowSetting['linkedin'] ?>" class="social-link"><i class="fab fa-linkedin"></i></a>
                            <a href="<?= $rowSetting['github'] ?>" class="social-link"><i class="fab fa-github"></i></a>
                            <a href="<?= $rowSetting['twitter'] ?>" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="<?= $rowSetting['instagram'] ?>" class="social-link"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="hero-image">
                        <div class="image-container">
                            <img src="admin/uploads/<?= $rowAbout['image']?>?auto=compress&cs=tinysrgb&w=500" 
                                 alt="Profile" class="profile-img">
                            <div class="floating-card card-1">
                                <i class="fas fa-code"></i>
                                <span>Clean Code</span>
                            </div>
                            <div class="floating-card card-2">
                                <i class="fas fa-mobile-alt"></i>
                                <span>Responsive</span>
                            </div>
                            <div class="floating-card card-3">
                                <i class="fas fa-rocket"></i>
                                <span>Fast Loading</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Stats Section -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card text-center">
                        <div class="stat-icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <div class="stat-number" data-count="50">0</div>
                        <div class="stat-label">Projects Completed</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card text-center">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-number" data-count="30">0</div>
                        <div class="stat-label">Happy Clients</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card text-center">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stat-number" data-count="5">0</div>
                        <div class="stat-label">Years Experience</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card text-center">
                        <div class="stat-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="stat-number" data-count="15">0</div>
                        <div class="stat-label">Technologies</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="section-title">Layanan Saya</h2>
                    <p class="section-subtitle">Solusi digital terbaik untuk kebutuhan bisnis Anda</p>
                </div>
            </div>
            <div class="row">
                 <?php
                foreach ($servicesHome as $service): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="<?= $service['icon']; ?>"></i>
                        </div>
                        <h4><?= $service['title']; ?></h4>
                        <p><?= $service['content']; ?></p>
                        <a href="?page=portofolio" class="btn btn-outline-primary">Lihat Project</a>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="cta-title">Siap Memulai Project Bersama?</h2>
                    <p class="cta-description">
                        Mari diskusikan ide Anda dan wujudkan solusi digital yang tepat untuk bisnis Anda.
                    </p>
                    <div class="cta-buttons">
                        <a href="?page=contact" class="btn btn-primary btn-lg me-3">
                            <i class="fas fa-envelope me-2"></i>Hubungi Saya
                        </a>
                        <a href="?page=about" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-user me-2"></i>Tentang Saya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>