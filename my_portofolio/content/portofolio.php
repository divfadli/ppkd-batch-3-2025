<?php
// Ambil semua project aktif join sections
$qProjects = mysqli_query($koneksi, "
    SELECT p.*, s.name AS section_name 
    FROM projects p
    LEFT JOIN sections s ON p.section_id = s.id
    WHERE p.is_active=1
    ORDER BY p.created_at DESC
");

// Simpan semua data projects ke array biar bisa dipakai ulang
$projects = [];
$categories = [];
while($row = mysqli_fetch_assoc($qProjects)){
    $projects[] = $row;
    if(!in_array($row['section_name'], $categories)) {
        $categories[] = $row['section_name'];
    }
}
?>

<!-- Page Header -->
<section class="page-header py-5 bg-light text-center">
    <div class="container">
        <h1 class="page-title">Portfolio</h1>
        <p class="page-subtitle">Koleksi project terbaik yang telah saya kerjakan</p>
    </div>
</section>

<!-- Portfolio Filter -->
<section class="section-padding">
    <div class="container">
        <div class="text-center mb-4">
            <button class="btn btn-outline-primary btn-sm me-2 filter-btn active" data-filter="all">Semua</button>
            <?php foreach($categories as $cat): ?>
                <button class="btn btn-outline-primary btn-sm me-2 filter-btn" data-filter="<?= htmlspecialchars($cat); ?>">
                    <?= htmlspecialchars($cat); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div class="row g-4 portfolio-grid">
            <?php foreach($projects as $project): 
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
            ?>
            <div class="col-lg-4 col-md-6 portfolio-item" data-category="<?= htmlspecialchars($project['section_name']); ?>">
                <div class="card h-100 shadow-sm portfolio-card">
                    <div class="position-relative overflow-hidden">
                        <img src="admin/uploads/<?= htmlspecialchars($project['image']); ?>" 
                             class="card-img-top portfolio-img <?= ($project['section_name'] === 'Mobile Apps') ? 'img-mobile' : ''; ?>" 
                             alt="<?= htmlspecialchars($project['title']); ?>">
                        <div class="portfolio-overlay d-flex justify-content-center align-items-center">
                            <button class="btn btn-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#portfolioModal<?= $project['id']; ?>">
                                <i class="fas fa-eye"></i>
                            </button>
                            <?php if(!empty($project['link'])): ?>
                            <a href="<?= htmlspecialchars($project['link']); ?>" target="_blank" class="btn btn-light btn-sm">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($project['title']); ?></h5>
                        <small class="text-muted"><?= htmlspecialchars($project['year']); ?> | <?= htmlspecialchars($project['section_name']); ?></small>
                        <p class="card-text text-truncate mt-2"><?= htmlspecialchars($project['description']); ?></p>
                        <div class="mt-2">
                            <?php foreach(array_slice($techs, 0, 3) as $t): ?>
                                <span class="badge bg-info me-1"><?= htmlspecialchars($t); ?></span>
                            <?php endforeach; ?>
                            <?php if(count($techs) > 3): ?>
                                <span class="badge bg-secondary">+<?= count($techs)-3; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Detail -->
            <div class="modal fade" id="portfolioModal<?= $project['id']; ?>" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?= htmlspecialchars($project['title']); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <img src="admin/uploads/<?= htmlspecialchars($project['image']); ?>" class="img-fluid mb-3 rounded" alt="<?= htmlspecialchars($project['title']); ?>">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6>Deskripsi Project</h6>
                                    <p><?= nl2br(htmlspecialchars($project['description'])); ?></p>
                                    <h6>Teknologi</h6>
                                    <div class="mb-2">
                                        <?php foreach($techs as $t): ?>
                                            <span class="badge bg-info me-2 mb-2"><?= htmlspecialchars($t); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h6>Detail Project</h6>
                                    <?php if(!empty($project['client'])): ?>
                                        <p><strong>Client:</strong> <?= htmlspecialchars($project['client']); ?></p>
                                    <?php endif; ?>
                                    <p><strong>Tahun:</strong> <?= htmlspecialchars($project['year']); ?></p>
                                    <p><strong>Kategori:</strong> <?= htmlspecialchars($project['section_name']); ?></p>
                                    <?php if(!empty($project['link'])): ?>
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
<section class="cta-section py-5 bg-primary text-white text-center">
    <div class="container">
        <h2 class="cta-title">Tertarik dengan Project Saya?</h2>
        <p class="mb-4">Mari diskusikan bagaimana saya dapat membantu mewujudkan ide digital Anda menjadi kenyataan.</p>
        <a href="?page=contact" class="btn btn-light btn-lg me-3"><i class="fas fa-envelope me-2"></i>Mulai Project</a>
        <a href="?page=skills" class="btn btn-outline-light btn-lg"><i class="fas fa-code me-2"></i>Lihat Keahlian</a>
    </div>
</section>

<!-- Filter JS -->
<script>
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const filter = btn.dataset.filter;
        document.querySelectorAll('.portfolio-item').forEach(item => {
            item.style.display = (filter==='all' || item.dataset.category===filter) ? 'block' : 'none';
        });
    });
});
</script>

<style>
.portfolio-overlay {
    position: absolute;
    top:0; left:0; width:100%; height:100%;
    display:flex; justify-content:center; align-items:center;
    background: rgba(0,0,0,.5);
    opacity:0; transition: .3s;
}
.portfolio-card:hover .portfolio-overlay { opacity:1; }
.text-truncate { display: -webkit-box; -webkit-line-clamp:3; -webkit-box-orient: vertical; overflow:hidden; }
.badge { font-size:.75rem; }

/* Tambahan styling gambar */
.portfolio-img {
    width: 100%;
    height: 250px;            /* tinggi seragam */
    object-fit: cover;        /* crop default */
    object-position: center;
    border-radius: .5rem;
}

.img-mobile {
    object-fit: contain !important; /* biar tidak kepotong */
    background: #f8f9fa;            /* kasih background netral */
    padding: 10px;
}
</style>
