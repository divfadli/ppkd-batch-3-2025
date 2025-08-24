<?php
// --- Fetch Data ---
// 1. Typing texts
$queryTypingText = mysqli_query($koneksi, "SELECT name FROM sections WHERE type='typing-text' ORDER BY id ASC");
$typingTexts = array_column(mysqli_fetch_all($queryTypingText, MYSQLI_ASSOC), 'name');

// 2. Floating cards
$qFloating = mysqli_query($koneksi, "
    SELECT icon, title, content 
    FROM floating_card 
    WHERE is_active = 1 
    ORDER BY id DESC
    LIMIT 3
");
$floatingCards = mysqli_fetch_all($qFloating, MYSQLI_ASSOC);

// 3. Stats data
$projects      = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM projects"))['total'] ?? 0;
$technologies  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM skills_items"))['total'] ?? 0;
$experience    = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT MIN(start_year) as start, MAX(end_year) as end FROM experiences"));
$clients       = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM testimonials"))['total'] ?? 0;

// Calculate years of experience
$yearsExperience = 0;
if (!empty($experience['start']) && !empty($experience['end'])) {
    $yearsExperience = (int)$experience['end'] - (int)$experience['start'];
}

// Services
$queryServices = mysqli_query($koneksi, "SELECT * FROM services WHERE is_active = 1 ORDER BY id ASC");
$servicesHome = mysqli_fetch_all($queryServices, MYSQLI_ASSOC);
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-particles"></div>
    <div class="container">
        <div class="row align-items-center min-vh-100">

            <!-- Hero Content -->
            <div class="col-lg-8 col-xl-7">
                <div class="hero-content">
                    <h1 class="hero-title">
                        Halo, Saya <span class="text-gradient"><?= htmlspecialchars($rowAbout['name_user']) ?></span>
                        <div class="title-decoration"></div>
                    </h1>

                    <!-- Typing Subtitle -->
                    <div class="hero-subtitle-wrapper">
                        <span class="subtitle-prefix">Saya seorang</span>
                        <div class="typing-wrap">
                            <span class="typing-text" data-text='<?= json_encode($typingTexts, JSON_UNESCAPED_UNICODE) ?>'></span>
                            <span class="typing-cursor">|</span>
                        </div>
                    </div>

                    <p class="hero-description"><?= $rowAbout['short_description'] ?></p>

                    <!-- Hero Buttons -->
                    <div class="hero-buttons">
                        <a href="?page=portofolio" class="btn btn-primary btn-lg hero-btn-primary">
                            <i class="fas fa-eye"></i> Lihat Portfolio
                        </a>
                        <a href="?page=contact" class="btn btn-primary btn-lg hero-btn-secondary">
                            <i class="fas fa-envelope"></i> Hubungi Saya
                        </a>
                    </div>

                    <!-- Social Links -->
                    <div class="social-links-wrapper">
                        <span class="social-label">Follow me:</span>
                        <div class="social-links">
                            <?php foreach ([
                                'linkedin' => 'fab fa-linkedin-in',
                                'github'   => 'fab fa-github',
                                'twitter'  => 'fab fa-x-twitter',
                                'instagram'=> 'fab fa-instagram'] as $platform => $icon): ?>
                                <a href="<?= htmlspecialchars($rowSetting[$platform]) ?>" class="social-link-hero <?= $platform ?>" data-tooltip="<?= ucfirst($platform) ?>">
                                    <i class="<?= $icon ?>"></i>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero Image -->
            <div class="col-lg-4 col-xl-4">
                <div class="hero-image">
                    <div class="image-container">
                        <div class="profile-img-wrapper">
                            <img src="admin/uploads/<?= htmlspecialchars($rowAbout['image']) ?>" alt="<?= htmlspecialchars($rowAbout['name_user']) ?>" class="profile-img">
                            <div class="profile-ring"></div>
                            <div class="profile-ring-2"></div>
                        </div>

                        <!-- Floating Cards -->
                        <?php foreach ($floatingCards as $i => $card): ?>
                            <div class="floating-card card-<?= $i+1 ?>">
                                <div class="card-icon"><i class="<?= htmlspecialchars($card['icon']) ?>"></i></div>
                                <div class="card-content">
                                    <span class="card-title"><?= htmlspecialchars($card['title']) ?></span>
                                    <span class="card-subtitle"><?= htmlspecialchars($card['content']) ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="scroll-indicator">
            <div class="scroll-mouse"><div class="scroll-wheel"></div></div>
            <span class="scroll-text">Scroll to explore</span>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section section-padding">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="section-title">Pencapaian dalam Angka</h2>
                <p class="section-subtitle">Hasil kerja keras dan dedikasi selama bertahun-tahun</p>
            </div>
        </div>

        <div class="row g-4">
            <?php
            $stats = [
                ['icon' => 'fas fa-project-diagram', 'number' => $projects,       'label' => 'Projects Completed', 'desc' => 'Berbagai jenis project web & mobile'],
                ['icon' => 'fas fa-users',           'number' => $clients,        'label' => 'Happy Clients',      'desc' => 'Klien puas dengan hasil kerja'],
                ['icon' => 'fas fa-calendar-alt',    'number' => $yearsExperience,'label' => 'Years Experience',   'desc' => 'Pengalaman di bidang development'],
                ['icon' => 'fas fa-code',            'number' => $technologies,   'label' => 'Technologies',       'desc' => 'Teknologi yang dikuasai']
            ];
            foreach ($stats as $stat): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="<?= $stat['icon'] ?>"></i><div class="icon-bg"></div></div>
                        <div class="stat-content">
                            <div class="stat-number" data-count="<?= $stat['number'] ?>">0</div>
                            <div class="stat-label"><?= $stat['label'] ?></div>
                            <div class="stat-description"><?= $stat['desc'] ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">Layanan Profesional</h2>
                <p class="section-subtitle">Solusi digital terbaik untuk mengembangkan bisnis Anda dengan teknologi terdepan</p>
            </div>
        </div>

        <div class="row g-4">
            <?php foreach ($servicesHome as $index => $service): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                        <div class="service-icon">
                            <i class="<?= htmlspecialchars($service['icon']) ?>"></i>
                            <div class="service-icon-bg"></div>
                        </div>
                        <div class="service-content">
                            <h4 class="service-title"><?= htmlspecialchars($service['title']) ?></h4>
                            <p class="service-description"><?= htmlspecialchars($service['content']) ?></p>
                            <a href="?page=portofolio" class="btn btn-outline-primary">Lihat Project</a>
                        </div>
                        <div class="service-hover-effect"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container text-center">
        <h2 class="cta-title">Siap Memulai Project Bersama?</h2>
        <p class="cta-description">Mari diskusikan ide Anda dan wujudkan solusi digital yang tepat untuk bisnis Anda.</p>
        <div class="cta-buttons">
            <a href="?page=contact" class="btn btn-primary btn-lg me-3"><i class="fas fa-envelope me-2"></i>Hubungi Saya</a>
            <a href="?page=about" class="btn btn-outline-light btn-lg"><i class="fas fa-user me-2"></i>Tentang Saya</a>
        </div>
    </div>
</section>

<!-- Scripts -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    // Typing Effect
    class TypeWriter {
        constructor(element, words, wait = 2000) {
            this.element = element;
            this.words = words;
            this.txt = '';
            this.wordIndex = 0;
            this.wait = parseInt(wait, 10);
            this.isDeleting = false;
            this.type();
        }
        type() {
            const current = this.wordIndex % this.words.length;
            const fullTxt = this.words[current];
            this.txt = this.isDeleting ? fullTxt.substring(0, this.txt.length - 1) : fullTxt.substring(0, this.txt.length + 1);
            this.element.textContent = this.txt;

            let speed = this.isDeleting ? 50 : 100;
            if (!this.isDeleting && this.txt === fullTxt) { speed = this.wait; this.isDeleting = true; }
            else if (this.isDeleting && this.txt === '') { this.isDeleting = false; this.wordIndex++; speed = 500; }
            setTimeout(() => this.type(), speed);
        }
    }

    const typingElement = document.querySelector(".typing-text");
    if (typingElement) new TypeWriter(typingElement, JSON.parse(typingElement.getAttribute("data-text")));

    // Counter Animation
    function animateCounters() {
        document.querySelectorAll('.stat-number').forEach(counter => {
            const target = +counter.getAttribute('data-count');
            let current = 0;
            const increment = target / (2000 / 16);
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) { counter.textContent = target + '+'; clearInterval(timer); }
                else { counter.textContent = Math.floor(current); }
            }, 16);
        });
    }

    // Intersection Observer
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (entry.target.classList.contains('stats-section')) animateCounters();
                entry.target.classList.add('animate-in');
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.stats-section, .services-section').forEach(sec => observer.observe(sec));

    // Smooth scroll
    document.querySelector('.scroll-indicator')?.addEventListener('click', () => {
        document.querySelector('.stats-section').scrollIntoView({ behavior: 'smooth' });
    });

    // Parallax Hero
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        document.querySelector('.hero-content')?.style.setProperty('transform', `translateY(${scrolled * 0.1}px)`);
        document.querySelector('.hero-image')?.style.setProperty('transform', `translateY(${scrolled * 0.05}px)`);
    });
});
</script>
