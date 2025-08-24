<?php
$qSections = mysqli_query($koneksi, "SELECT * FROM sections WHERE type IN ('skills','prolanguage','technology','development')");
$sections = [];
while ($row = mysqli_fetch_assoc($qSections)) {
    $sections[$row['id']] = $row;
    $sections[$row['id']]['items'] = [];
}

$qSkills = mysqli_query($koneksi, "SELECT * FROM skills_items ORDER BY section_id, id ASC");
while ($skill = mysqli_fetch_assoc($qSkills)) {
    if (isset($sections[$skill['section_id']])) {
        $sections[$skill['section_id']]['items'][] = $skill;
    }
}

// ============================
// Fungsi render skill card
// ============================
function renderSkills($skills, $colClass = "col-lg-6 col-md-6 col-sm-12 mb-4") {
    foreach($skills as $skill): ?>
        <div class="<?= $colClass ?>">
            <div class="skill-item h-100">
                <div class="skill-header">
                    <div class="skill-icon-wrapper" style="background: <?= $skill['color'] ?? '#0d6efd'; ?>15;">
                        <i class="<?= $skill['icon']; ?> skill-icon" style="color: <?= $skill['color'] ?? '#0d6efd'; ?>"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="skill-name"><?= $skill['name']; ?></span>
                            <span class="skill-percentage"><?= $skill['percentage']; ?>%</span>
                        </div>
                        <div class="progress mt-2">
                            <div class="progress-bar"
                                 data-width="<?= $skill['percentage']; ?>"
                                 style="background: linear-gradient(90deg, <?= $skill['color'] ?? '#0d6efd'; ?>, #1e40af);">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;
}
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container text-center">
        <h1 class="page-title">💡 Keahlian Teknis</h1>
        <p class="page-subtitle">Teknologi dan tools yang saya kuasai untuk menciptakan solusi digital terbaik</p>
    </div>
</section>

<!-- Technical Skills Sections (Dinamis) -->
<?php foreach ($sections as $sec): ?>
    <?php if (!empty($sec['items'])): ?>
        <section class="section-padding <?= ($sec['id'] % 2 == 0) ? 'bg-light' : ''; ?>">
            <div class="container">
                <h2 class="section-title text-center"><?= $sec['name']; ?></h2>
                <div class="row mt-4">
                    <?php renderSkills($sec['items']); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endforeach; ?>

<!-- Soft Skills -->
<section class="section-padding bg-gradient-soft">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="section-title">🤝 Soft Skills</h2>
                <p class="section-subtitle">Kemampuan non-teknis yang mendukung kesuksesan project</p>
            </div>
        </div>
        <div class="row">
            <?php
            $qSoft = mysqli_query($koneksi, "SELECT * FROM soft_skills WHERE is_active = 1");
            while ($s = mysqli_fetch_assoc($qSoft)): ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="soft-skill-card h-100">
                        <div class="soft-skill-icon"><i class="<?= $s['icon']; ?>"></i></div>
                        <h5><?= $s['title']; ?></h5>
                        <p><?= $s['content']; ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
      const bars = document.querySelectorAll(".progress-bar");
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const bar = entry.target;
            bar.style.width = bar.dataset.width + "%";
            observer.unobserve(bar);
          }
        });
      }, { threshold: 0.3 });
      bars.forEach(bar => observer.observe(bar));
    });
</script>
