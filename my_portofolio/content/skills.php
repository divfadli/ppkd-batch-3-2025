<?php

// ============================
// Ambil data sections & skills
// ============================

// Ambil semua section yang tipe-nya 'skills', 'technology', 'development', 'prolanguage', dll
$qSections = mysqli_query($koneksi, "SELECT * FROM sections WHERE type IN ('skills','prolanguage','technology','development')");
$sections = [];
while ($row = mysqli_fetch_assoc($qSections)) {
    $sections[$row['id']] = $row; // simpan info section
    $sections[$row['id']]['items'] = []; // buat slot item skills
}

// Ambil semua skill_items
$qSkills = mysqli_query($koneksi, "SELECT * FROM skills_items ORDER BY section_id, id ASC");
while ($skill = mysqli_fetch_assoc($qSkills)) {
    if (isset($sections[$skill['section_id']])) {
        $sections[$skill['section_id']]['items'][] = $skill;
    }
}

// ============================
// Fungsi render skill
// ============================
function renderSkills($skills, $colClass = "col-lg-6 mb-4") {
    foreach($skills as $skill): ?>
        <div class="<?= $colClass ?>">
            <div class="skill-item">
                <div class="skill-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="<?= $skill['icon']; ?> skill-icon" style="color: <?= $skill['color'] ?? '#333'; ?>"></i>
                        <span class="skill-name"><?= $skill['name']; ?></span>
                    </div>
                    <span class="skill-percentage"><?= $skill['percentage']; ?>%</span>
                </div>
                <div class="progress">
                    <div class="progress-bar" data-width="<?= $skill['percentage']; ?>" 
                         style="background-color: <?= $skill['color'] ?? '#0d6efd'; ?>"></div>
                </div>
            </div>
        </div>
    <?php endforeach;
}
?>

<!-- Page Header -->
<section class="page-header text-center">
    <div class="container">
        <h1 class="page-title">Keahlian Teknis</h1>
        <p class="page-subtitle">Teknologi dan tools yang saya kuasai untuk menciptakan solusi digital terbaik</p>
    </div>
</section>

<!-- Programming Languages -->
<section class="section-padding">
    <div class="container">
        <h2 class="section-title text-center mb-5">Programming Languages</h2>
        <div class="row">
            <?php renderSkills($sections[4]['items']); ?>
        </div>
    </div>
</section>

<!-- Frontend -->
<section class="section-padding bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-5">Frontend Technologies</h2>
        <div class="row">
            <?php renderSkills($sections[5]['items']); ?>
        </div>
    </div>
</section>

<!-- Backend -->
<section class="section-padding">
    <div class="container">
        <h2 class="section-title text-center mb-5">Backend Technologies</h2>
        <div class="row">
            <?php renderSkills($sections[6]['items']); ?>
        </div>
    </div>
</section>

<!-- Database & Tools -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5">
                <h3 class="mb-4">Database Technologies</h3>
                <?php renderSkills($sections[7]['items'], "col-12 mb-3"); ?>
            </div>
            <div class="col-lg-6 mb-5">
                <h3 class="mb-4">Development Tools</h3>
                <?php renderSkills($sections[8]['items'], "col-12 mb-3"); ?>
            </div>
        </div>
    </div>
</section>

<!-- Soft Skills -->
<section class="section-padding">
    <div class="container text-center">
        <h2 class="section-title mb-3">Soft Skills</h2>
        <p class="section-subtitle mb-5">Kemampuan non-teknis yang mendukung kesuksesan project</p>
        <div class="row">
            <?php
            $qSoft = mysqli_query($koneksi, "SELECT * FROM soft_skills WHERE is_active = 1"); // jika ada tabel khusus soft skills
            while ($s = mysqli_fetch_assoc($qSoft)): ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="soft-skill-card">
                        <div class="soft-skill-icon"><i class="<?= $s['icon']; ?>"></i></div>
                        <h5><?= $s['title']; ?></h5>
                        <p><?= $s['content']; ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
