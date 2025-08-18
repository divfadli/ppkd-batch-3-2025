   <?php
   include 'inc/helpers.php';

   // Ambil section id untuk Education & Certification
$qSectionEdu = mysqli_query($koneksi, "SELECT id FROM sections WHERE type='education' LIMIT 1");
$sectionEdu = mysqli_fetch_assoc($qSectionEdu);

$qSectionCert = mysqli_query($koneksi, "SELECT id FROM sections WHERE type='certification' LIMIT 1");
$sectionCert = mysqli_fetch_assoc($qSectionCert);

// Ambil data Education
$qEducation = mysqli_query($koneksi, "SELECT * FROM education WHERE section_id=" . intval($sectionEdu['id']) . " ORDER BY start_year DESC");
$sectionEducation = mysqli_fetch_all($qEducation, MYSQLI_ASSOC);

// Ambil data Certification
$qCertification = mysqli_query($koneksi, "SELECT * FROM certification WHERE section_id=" . intval($sectionCert['id']) . " ORDER BY year DESC");
$certifications = mysqli_fetch_all($qCertification, MYSQLI_ASSOC);
   
   ?>
   
   <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="page-title">Tentang Saya</h1>
                    <p class="page-subtitle">Mengenal lebih dekat dengan background dan passion saya</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Content -->
    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <div class="about-image">
                        <img src="admin/uploads/<?= $rowAbout['image']?>?auto=compress&cs=tinysrgb&w=600" 
                             alt="About Me" class="img-fluid rounded-3 shadow">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <h2 class="mb-4"><?= $rowAbout['title']?></h2>
                        <p class="mb-4">
                            <?= $rowAbout['content']?>
                        </p>
                        <div class="row mb-4">
                            <div class="col-6">
                                <div class="info-item">
                                    <strong>Nama:</strong> <?= $rowAbout['name_user']?>
                                </div>
                                <div class="info-item">
                                    <strong>Email:</strong> <?= $rowSetting['email']?>
                                </div>
                                <div class="info-item">
                                    <strong>Phone:</strong> <?= formatPhone($rowSetting['phone'], $countries); ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="info-item">
                                    <strong>Lokasi:</strong> <?= $rowAbout['location']?>
                                </div>
                                <div class="info-item">
                                    <strong>Status:</strong> <?= $rowAbout['freelance_status'] ? 'Available' : 'Not Available'; ?> for Work
                                </div>
                                <div class="info-item">
                                    <strong>Freelance:</strong> <?= $rowAbout['freelance_status'] ? 'Available' : 'Not Available'; ?>
                                </div>
                            </div>
                        </div>
                        <a href="admin/uploads/cv/<?= $rowAbout['cv']?>" class="btn btn-primary me-3" download>
                            <i class="fas fa-download me-2"></i>Download CV
                        </a>
                        <a href="?page=contact" class="btn btn-outline-primary">
                            <i class="fas fa-envelope me-2"></i>Hubungi Saya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="section-title">Nilai & Prinsip Kerja</h2>
                    <p class="section-subtitle">Fondasi yang memandu setiap project yang saya kerjakan</p>
                </div>
            </div>
            <div class="row">
                <?php foreach($valuesKerja as $val): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="<?= $val['icon']?>"></i>
                        </div>
                        <h4><?= $val['title']?></h4>
                        <p><?= $val['content']?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Education & Certifications -->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5">
                    <h3 class="mb-4">Pendidikan</h3>
                    <?php foreach($sectionEducation as $edu): ?>
                        <div class="education-item">
                            <div class="education-year"><?= $edu['start_year'] . " - " . $edu['end_year'] ?></div>
                            <h5><?= $edu['degree'] ?></h5>
                            <p class="education-school"><?= $edu['school'] ?></p>
                            <p class="text-justify"><?= $edu['description'] ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="col-lg-6 mb-5">
                    <h3 class="mb-4">Sertifikasi</h3>
                    <?php foreach($certifications as $cert): ?>
                    <div class="certification-item">
                        <div class="cert-icon">
                            <i class="<?= $cert['icon']?>"></i>
                        </div>
                        <div class="cert-content">
                            <h5><?= $cert['title']?></h5>
                            <p><?= $cert['provider']?> - <?= $cert['year']?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </section>