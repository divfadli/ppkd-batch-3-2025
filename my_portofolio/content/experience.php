<?php
// ============================
// Ambil data pengalaman kerja
// ============================
$qExp = mysqli_query($koneksi, "SELECT * FROM experiences ORDER BY start_year ASC");
$experiences = mysqli_fetch_all($qExp, MYSQLI_ASSOC);

// ============================
// Data statis untuk skill growth
// ============================
$skillsGrowth = [
    [
        "start_year" => "2017",
        "end_year" => "2018",
        "title" => "Foundation",
        "skills" => ["HTML5", "CSS3", "JavaScript", "PHP", "MySQL"]
    ],
    [
        "start_year" => "2018",
        "end_year" => "2019",
        "title" => "Frontend Focus",
        "skills" => ["React.js", "SASS", "Webpack", "Git", "Bootstrap"]
    ],
    [
        "start_year" => "2019",
        "end_year" => "2021",
        "title" => "Full Stack",
        "skills" => ["Vue.js", "Laravel", "Node.js", "MongoDB", "REST API"]
    ],
    [
        "start_year" => "2021",
        "end_year" => "Now",
        "title" => "Advanced & Leadership",
        "skills" => ["AWS", "Docker", "Microservices", "Team Lead", "DevOps"]
    ],
];

// ============================
// Data statis untuk testimonial
// ============================
$testimonials = [
    [
        "text" => "John adalah developer yang sangat kompeten dan reliable. Kemampuan problem solving-nya luar biasa.",
        "img"  => "https://images.pexels.com/photos/3785079/pexels-photo-3785079.jpeg?auto=compress&cs=tinysrgb&w=100",
        "name" => "Sarah Johnson",
        "role" => "Project Manager - Tech Solutions Inc."
    ],
    [
        "text" => "Bekerja dengan John sangat menyenangkan. Dia skilled secara teknis, komunikatif, dan team player sejati.",
        "img"  => "https://images.pexels.com/photos/3785081/pexels-photo-3785081.jpeg?auto=compress&cs=tinysrgb&w=100",
        "name" => "Mike Chen",
        "role" => "Senior Developer - Digital Agency Pro"
    ],
    [
        "text" => "John berhasil mengembangkan website kami dengan hasil yang melebihi ekspektasi. Profesional & tepat waktu.",
        "img"  => "https://images.pexels.com/photos/3785083/pexels-photo-3785083.jpeg?auto=compress&cs=tinysrgb&w=100",
        "name" => "Lisa Wong",
        "role" => "CEO - StartUp Innovate"
    ],
];
?>

<!-- ================= Page Header ================= -->
<section class="page-header text-center py-5 bg-gradient">
    <div class="container">
        <h1 class="page-title display-5 fw-bold">Pengalaman Kerja</h1>
        <p class="page-subtitle text-light">Perjalanan karir & pencapaian profesional selama 5+ tahun</p>
    </div>
</section>

<!-- ================= Experience Timeline ================= -->
<section class="section-padding">
    <div class="container">
        <div class="section-heading text-center mb-5" data-aos="fade-up">
            <h2 class="section-title fw-bold">Pengalaman Kerja</h2>
            <p class="section-subtitle">Ringkasan pengalaman profesional saya</p>
        </div>

        <div class="timeline position-relative">
            <?php if ($experiences): ?>
            <?php foreach ($experiences as $index => $exp): 
                $techs = json_decode($exp['technologies'], true);
                $achievements = json_decode($exp['achievements'], true);
            ?>
            <div class="timeline-item <?= $index % 2 == 0 ? 'left' : 'right'; ?>" data-aos="fade-up"
                data-aos-delay="<?= $index * 100 ?>">
                <div class="timeline-card card shadow-lg rounded-4 p-4 border-0">

                    <!-- Tahun & Type -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-primary px-3 py-2">
                            <?= htmlspecialchars($exp['start_year']) ?> - <?= htmlspecialchars($exp['end_year']) ?>
                        </span>
                        <span class="badge bg-dark px-3 py-2"><?= htmlspecialchars($exp['type']) ?></span>
                    </div>

                    <!-- Position & Company -->
                    <h4 class="fw-bold"><?= htmlspecialchars($exp['position']) ?></h4>
                    <p class="text-muted mb-2">
                        <i class="fas fa-building me-2 text-primary"></i>
                        <?= htmlspecialchars($exp['company']) ?> · <?= htmlspecialchars($exp['location']) ?>
                    </p>

                    <!-- Description -->
                    <p><?= nl2br(htmlspecialchars($exp['description'])) ?></p>

                    <!-- Achievements -->
                    <?php if ($achievements && is_array($achievements)): ?>
                    <div class="mt-3">
                        <h6 class="fw-bold text-success"><i class="fas fa-trophy me-2"></i>Pencapaian Utama</h6>
                        <ul class="list-unstyled ps-3">
                            <?php foreach ($achievements as $ach): ?>
                            <li>✅ <?= htmlspecialchars($ach['value']) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <!-- Technologies -->
                    <?php if ($techs && is_array($techs)): ?>
                    <div class="mt-3">
                        <h6 class="fw-bold text-info"><i class="fas fa-laptop-code me-2"></i>Teknologi</h6>
                        <?php foreach ($techs as $tech): ?>
                        <span class="badge bg-light text-dark border me-1 mb-1 px-3 py-2">
                            <?= htmlspecialchars($tech['value']) ?>
                        </span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p class="text-center text-muted">Belum ada pengalaman kerja yang ditambahkan.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Skills Growth -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="section-title">Perkembangan Keahlian</h2>
                <p class="section-subtitle">Evolusi teknologi yang saya kuasai selama perjalanan karir</p>
            </div>
        </div>
        <div class="row">
            <?php if ($skillsGrowth): ?>
            <?php foreach ($skillsGrowth as $index => $growth): ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="skill-evolution-card">
                    <div class="skill-year"> <?= htmlspecialchars($growth['start_year']) ?> -
                        <?= htmlspecialchars($growth['end_year']) ?></div>
                    <h5><?= $growth['title'] ?></h5>
                    <div class="skill-list">
                        <?php foreach($growth['skills'] as $skillIndex => $skill): ?>
                        <span class="skill-badge"><?= $skill ?></span>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p class="text-center text-muted">Belum ada perkembangan skill yang ditambahkan.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ================= Testimonials ================= -->
<section class="section-padding">
    <div class="container">
        <div class="section-heading text-center mb-5" data-aos="fade-up">
            <h2 class="section-title fw-bold">Testimoni</h2>
            <p class="section-subtitle">Apa kata rekan & klien tentang saya</p>
        </div>
        <div class="row">
            <?php foreach ($testimonials as $i => $testi): ?>
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="<?= $i * 200 ?>">
                <div class="card testimonial-card shadow-lg border-0 rounded-4 h-100 p-4">
                    <div class="testimonial-content mb-3">
                        <i class="fas fa-quote-left fa-2x text-primary"></i>
                        <p class="mt-3 fst-italic">"<?= htmlspecialchars($testi['text']) ?>"</p>
                    </div>
                    <div class="d-flex align-items-center mt-auto">
                        <img src="<?= $testi['img'] ?>" alt="<?= htmlspecialchars($testi['name']) ?>"
                            class="rounded-circle me-3 border border-2" width="60" height="60">
                        <div>
                            <h6 class="mb-0 fw-bold"><?= htmlspecialchars($testi['name']) ?></h6>
                            <small class="text-muted"><?= htmlspecialchars($testi['role']) ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ================= AOS Animation Init ================= -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script>
AOS.init({
    duration: 800,
    once: true
});
</script>