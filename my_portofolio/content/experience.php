<?php
// ============================
// Ambil data pengalaman kerja dari database
// ============================
$qExp = mysqli_query($koneksi, "SELECT * FROM experiences ORDER BY start_year ASC");
$experiences = [];
while ($row = mysqli_fetch_assoc($qExp)) {
    $row['technologies'] = $row['technologies'] ? json_decode($row['technologies'], true) : [];
    $row['achievements'] = $row['achievements'] ? json_decode($row['achievements'], true) : [];
    $experiences[] = $row;
}

// ============================
// Ambil data perkembangan skill
// ============================
$qSkillsGrowth = mysqli_query($koneksi, "SELECT * FROM skill_growth ORDER BY start_year ASC");
$skillsGrowth = [];
while ($row = mysqli_fetch_assoc($qSkillsGrowth)) {
    $row['skills'] = $row['skills'] ? json_decode($row['skills'], true) : [];
    $skillsGrowth[] = $row;
}

// ============================
// Data statis untuk testimonial
// ============================
$qTestimonials = mysqli_query($koneksi, "SELECT * FROM testimonials ORDER BY id DESC");
$testimonials = mysqli_fetch_all($qTestimonials, MYSQLI_ASSOC);
?>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- ================= Page Header ================= -->
  <section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="page-title">Pengalaman & Skill</h1>
                <p class="page-subtitle">Perjalanan karir, pencapaian, dan evolusi keahlian saya</p>
            </div>
        </div>
    </div>
</section>

<!-- ================= Experience Timeline ================= -->
<section class="section-padding">
  <div class="container">
    <div class="section-heading text-center mb-5" data-aos="fade-up">
      <h2 class="fw-bold">Pengalaman Kerja</h2>
      <p class="text-muted">Ringkasan perjalanan profesional saya</p>
    </div>

    <div class="timeline">
      <?php foreach ($experiences as $index => $exp): ?>
      <div class="timeline-item <?= $index % 2 == 0 ? 'left' : 'right'; ?>" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
        <div class="timeline-card shadow-sm rounded-3 p-4">
          <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
            <span class="badge bg-gradient text-white px-3 py-2"><?= htmlspecialchars($exp['start_year']) ?> - <?= htmlspecialchars($exp['end_year']) ?></span>
            <span class="badge bg-dark px-3 py-2"><?= htmlspecialchars($exp['type']) ?></span>
          </div>
          <h4 class="fw-bold text-primary mb-1"><?= htmlspecialchars($exp['position']) ?></h4>
          <p class="text-muted mb-3"><i class="fas fa-building me-2 text-secondary"></i><?= htmlspecialchars($exp['company']) ?> · <?= htmlspecialchars($exp['location']) ?></p>
          <p><?= nl2br(htmlspecialchars($exp['description'])) ?></p>

          <?php if (!empty($exp['achievements'])): ?>
            <div class="mt-3">
              <h6 class="fw-bold text-success mb-2"><i class="fas fa-trophy me-2"></i>Pencapaian</h6>
              <ul class="list-unstyled ps-3">
                <?php foreach ($exp['achievements'] as $ach): ?>
                  <li class="mb-1">✅ <?= htmlspecialchars($ach['value']) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <?php if (!empty($exp['technologies'])): ?>
            <div class="mt-3">
              <h6 class="fw-bold text-info mb-2"><i class="fas fa-laptop-code me-2"></i>Teknologi</h6>
              <div class="d-flex flex-wrap gap-2">
                <?php foreach ($exp['technologies'] as $tech): ?>
                  <span class="badge bg-light text-dark border px-3 py-2"> <?= htmlspecialchars($tech['value']) ?> </span>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ================= Skills Growth ================= -->
<section class="section-padding bg-light">
  <div class="container">
    <div class="section-heading text-center mb-5" data-aos="fade-up">
      <h2 class="fw-bold">Perkembangan Keahlian</h2>
      <p class="text-muted">Teknologi dan skill yang berkembang seiring waktu</p>
    </div>
    <div class="row g-4">
      <?php foreach ($skillsGrowth as $index => $growth): ?>
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
        <div class="skill-evolution-card p-4 bg-white shadow-sm rounded-3 h-100 text-center">
          <div class="skill-year fw-bold mb-2"><?= htmlspecialchars($growth['start_year']) ?> - <?= htmlspecialchars($growth['end_year']) ?></div>
          <h5 class="fw-bold mb-3"><?= htmlspecialchars($growth['title']) ?></h5>
          <div class="skill-list d-flex flex-wrap justify-content-center gap-2">
            <?php foreach($growth['skills'] as $skill): ?>
              <span class="badge bg-info text-dark px-3 py-2"><?= htmlspecialchars($skill['value'] ?? $skill) ?></span>
            <?php endforeach ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ================= Testimonials (Swiper) ================= -->
<section class="section-padding bg-light">
  <div class="container">
    <div class="section-heading text-center mb-5" data-aos="fade-up">
      <h2 class="fw-bold">Testimoni</h2>
      <p class="text-muted">Pendapat rekan & klien tentang saya</p>
    </div>

    <?php if (!empty($testimonials)): ?>
    <div class="swiper testimonial-slider pb-5">
      <div class="swiper-wrapper">
        <?php foreach ($testimonials as $testi): ?>
        <div class="swiper-slide">
          <div class="testimonial-card p-4 bg-white shadow-sm rounded-4 h-100 d-flex flex-column position-relative hover-shadow">
            
            <!-- Quote -->
            <div class="testimonial-content mb-4">
              <i class="fas fa-quote-left fa-2x text-primary opacity-75"></i>
              <p class="mt-3 fst-italic text-muted">"<?= htmlspecialchars($testi['content']) ?>"</p>
            </div>

            <!-- Info -->
            <div class="d-flex align-items-center mt-auto pt-3 border-top">
              <img src="<?= htmlspecialchars($testi['img']) ?>" 
                   alt="<?= htmlspecialchars($testi['name']) ?>" 
                   class="rounded-circle me-3 border border-2 shadow-sm" 
                   width="60" height="60">
              <div>
                <h6 class="mb-1 fw-bold"><?= htmlspecialchars($testi['name']) ?></h6>
                <small class="text-muted"><?= htmlspecialchars($testi['role']) ?></small>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Custom Navigation -->
      <div class="swiper-pagination mt-4"></div>
      <div class="swiper-button-prev custom-nav"></div>
      <div class="swiper-button-next custom-nav"></div>
    </div>

    <?php else: ?>
    <!-- Empty State -->
    <div class="text-center py-5">
      <i class="bi bi-chat-left-quote display-4 text-muted d-block mb-3"></i>
      <p class="text-muted mb-2">Belum ada testimoni</p>
      <a href="?page=testimonial-form" class="btn btn-outline-primary btn-sm">
        <i class="bi bi-plus-circle"></i> Tambahkan Testimoni
      </a>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- ================= JS ================= -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
AOS.init({ duration: 900, once: true, offset: 80 });

const slidesCount = document.querySelectorAll('.testimonial-slider .swiper-slide').length;
if (slidesCount > 0) {
  new Swiper('.testimonial-slider', {
    loop: slidesCount > 3,
    grabCursor: true,
    spaceBetween: 30,
    slidesPerView: 1,
    autoplay: { delay: 4000, disableOnInteraction: false },
    pagination: { el: '.swiper-pagination', clickable: true },
    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
    breakpoints: { 768: { slidesPerView: 2 }, 1024: { slidesPerView: 3 } }
  });
}
</script>