<?php
// Ambil semua project aktif join sections
$qProjects = mysqli_query($koneksi, "
    SELECT p.*, s.name AS section_name 
    FROM projects p
    LEFT JOIN sections s ON p.section_id = s.id
    WHERE p.is_active=1
    ORDER BY p.created_at DESC
");

$projects = [];
$categories = [];
while ($row = mysqli_fetch_assoc($qProjects)) {
    $projects[] = $row;
    if (!in_array($row['section_name'], $categories)) {
        $categories[] = $row['section_name'];
    }
}
?>

<!-- Page Header -->
 <section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="page-title">Portfolio</h1>
                <p class="page-subtitle">Koleksi project terbaik yang telah saya kerjakan</p>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Filter -->
<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5 portfolio-filters">
            <button class="btn btn-outline-primary btn-sm me-2 filter-btn active" data-filter="all">Semua</button>
            <?php foreach ($categories as $cat): ?>
                <button class="btn btn-outline-primary btn-sm me-2 filter-btn" data-filter="<?= htmlspecialchars($cat); ?>">
                    <?= htmlspecialchars($cat); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div class="row g-4 portfolio-grid">
            <?php foreach ($projects as $project): 
                // Parse teknologi
                $techs = [];
                if (!empty($project['tech'])) {
                    $decoded = json_decode($project['tech'], true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        foreach ($decoded as $t) {
                            if (!empty($t['value'])) {
                                $techs[] = $t['value'];
                            }
                        }
                    } else {
                        $techs = array_map('trim', explode(',', $project['tech']));
                    }
                }

                // Deskripsi singkat max 130 karakter
                $shortDesc = mb_strimwidth($project['description'], 0, 130, '...');
            ?>
            <div class="col-lg-4 col-md-6 portfolio-item" data-category="<?= htmlspecialchars($project['section_name']); ?>">
                <div class="card h-100 shadow-lg border-0 portfolio-card">
                    <div class="portfolio-image position-relative overflow-hidden rounded-top">
                        <img src="admin/uploads/<?= htmlspecialchars($project['image']); ?>" 
                             class="portfolio-img <?= ($project['section_name'] === 'Mobile Apps') ? 'img-mobile' : ''; ?>" 
                             alt="<?= htmlspecialchars($project['title']); ?>"
                             loading="lazy">

                        <div class="portfolio-overlay d-flex justify-content-center align-items-center">
                            <button class="btn btn-light btn-sm rounded-circle shadow me-2" data-bs-toggle="modal" data-bs-target="#portfolioModal<?= $project['id']; ?>">
                                <i class="fas fa-eye"></i>
                            </button>
                            <?php if (!empty($project['link'])): ?>
                            <a href="<?= htmlspecialchars($project['link']); ?>" target="_blank" class="btn btn-light btn-sm rounded-circle shadow">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body text-center portfolio-content">
                        <h5 class="card-title fw-semibold portfolio-title"><?= htmlspecialchars($project['title']); ?></h5>
                        <small class="text-muted d-block mb-2 portfolio-meta">
                            <span class="portfolio-year"><?= htmlspecialchars($project['year']); ?></span> | 
                            <?= htmlspecialchars($project['section_name']); ?>
                        </small>
                        
                        <p class="card-text portfolio-description">
                            <?= htmlspecialchars($shortDesc); ?>
                            <a href="javascript:void(0)" 
                               class="read-more-inline" 
                               data-bs-toggle="modal" 
                               data-bs-target="#portfolioModal<?= $project['id']; ?>">
                               Read More
                            </a>
                        </p>

                        <!-- Teknologi -->
                        <div class="mt-3">
                            <?php foreach (array_slice($techs, 0, 3) as $t): ?>
                                <span class="tech-tag"><?= htmlspecialchars($t); ?></span>
                            <?php endforeach; ?>
                            <?php if (count($techs) > 3): ?>
                                <span class="badge bg-secondary">+<?= count($techs) - 3; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Detail -->
            <div class="modal fade" id="portfolioModal<?= $project['id']; ?>" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title"><?= htmlspecialchars($project['title']); ?></h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <img src="admin/uploads/<?= htmlspecialchars($project['image']); ?>" class="img-fluid mb-3 rounded shadow-sm" alt="<?= htmlspecialchars($project['title']); ?>" loading="lazy">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6 class="fw-bold">Deskripsi Project</h6>
                                    <p><?= nl2br(htmlspecialchars($project['description'])); ?></p>
                                    <h6 class="fw-bold">Teknologi</h6>
                                    <div class="mb-2">
                                        <?php foreach ($techs as $t): ?>
                                            <span class="tech-tag"><?= htmlspecialchars($t); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h6 class="fw-bold">Detail Project</h6>
                                    <?php if (!empty($project['client'])): ?>
                                        <p><strong>Client:</strong> <?= htmlspecialchars($project['client']); ?></p>
                                    <?php endif; ?>
                                    <p><strong>Tahun:</strong> <?= htmlspecialchars($project['year']); ?></p>
                                    <p><strong>Kategori:</strong> <?= htmlspecialchars($project['section_name']); ?></p>
                                    <?php if (!empty($project['link'])): ?>
                                    <a href="<?= htmlspecialchars($project['link']); ?>" target="_blank" class="btn btn-primary w-100 mt-2">
                                        <i class="fas fa-external-link-alt me-2"></i>Lihat Project
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2 class="cta-title">🚀 Tertarik dengan Project Saya?</h2>
        <p class="cta-description">
            Mari wujudkan ide digital Anda menjadi kenyataan dengan solusi modern & profesional.
        </p>
        <div class="cta-buttons">
            <a href="?page=contact" class="btn btn-primary btn-lg me-3 shadow">
                <i class="fas fa-envelope me-2"></i> Mulai Project
            </a>
            <a href="?page=skills" class="btn btn-outline-light btn-lg shadow-sm">
                <i class="fas fa-code me-2"></i> Lihat Keahlian
            </a>
        </div>
    </div>
</section>
