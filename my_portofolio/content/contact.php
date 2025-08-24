<?php
include 'inc/helpers.php'; // pastikan $koneksi ada di sini

// Inisialisasi form
$name = $email = $subject = $messageText = '';
$message = '';
$messageType = '';

// Handle form submission
if ($_POST) {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $subject = htmlspecialchars($_POST['subject'] ?? '');
    $messageText = htmlspecialchars($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($subject) || empty($messageText)) {
        $message = 'Semua field harus diisi!';
        $messageType = 'danger';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Format email tidak valid!';
        $messageType = 'danger';
    } else {
        $safe_name = mysqli_real_escape_string($koneksi, $name);
        $safe_email = mysqli_real_escape_string($koneksi, $email);
        $safe_subject = mysqli_real_escape_string($koneksi, $subject);
        $safe_message = mysqli_real_escape_string($koneksi, $messageText);

        $qInsert = mysqli_query($koneksi, "
            INSERT INTO messages (name, email, subject, message)
            VALUES ('$safe_name','$safe_email','$safe_subject','$safe_message')
        ");

        if ($qInsert) {
            $message = 'Pesan berhasil dikirim! Terima kasih, saya akan merespon dalam 24 jam.';
            $messageType = 'success';
            $name = $email = $subject = $messageText = '';
        } else {
            $message = 'Terjadi kesalahan saat menyimpan pesan. Silakan coba lagi.';
            $messageType = 'danger';
        }
    }
}

$qFaQs = mysqli_query($koneksi, "SELECT * FROM faqs WHERE is_active=1 ORDER BY created_at DESC LIMIT 5");
$rowFaq = mysqli_fetch_all($qFaQs, MYSQLI_ASSOC);
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="page-title">Hubungi Saya</h1>
                <p class="page-subtitle">Mari diskusikan project Anda dan wujudkan ide digital bersama</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="section-padding py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if ($message): ?>
                    <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show shadow-sm rounded-3" role="alert">
                        <i class="fas fa-info-circle me-2"></i><?php echo $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4">
                        <h4 class="mb-4 text-center">Kirim Pesan</h4>
                        <form method="POST" action="" class="needs-validation" novalidate>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nama Lengkap *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label for="subject" class="form-label">Subject *</label>
                                <select class="form-select" id="subject" name="subject" required>
                                    <option value="">Pilih Subject</option>
                                    <?php
                                    $subjects = ['Web Development', 'Mobile App Development', 'UI/UX Design', 'Consultation', 'Partnership', 'Other'];
                                    foreach ($subjects as $subj) {
                                        $selected = ($subject === $subj) ? 'selected' : '';
                                        echo "<option value=\"$subj\" $selected>$subj</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mt-3">
                                <label for="message" class="form-label">Pesan *</label>
                                <textarea class="form-control" id="message" name="message" rows="6" placeholder="Ceritakan tentang project Anda..." required><?php echo $messageText; ?></textarea>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info -->
<section class="section-padding bg-light py-5">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-lg-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <i class="fas fa-map-marker-alt fa-2x text-primary mb-3"></i>
                    <h5 class="fw-bold">Alamat</h5>
                    <p class="mb-0"><?= $rowSetting['address'] ?></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <i class="fas fa-phone fa-2x text-primary mb-3"></i>
                    <h5 class="fw-bold">Telepon</h5>
                    <p class="mb-0"><?= formatPhone($rowSetting['phone'], $countries); ?><br><small>Available 9 AM - 6 PM</small></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                    <h5 class="fw-bold">Email</h5>
                    <p class="mb-0"><?= $rowSetting['email'] ?><br><small>Response within 24 hours</small></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section-padding py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-12 text-center">
                <h2 class="fw-bold">Frequently Asked Questions</h2>
                <p class="text-muted">Pertanyaan yang sering diajukan tentang layanan saya</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion accordion-flush" id="faqAccordion">
                    <?php foreach ($rowFaq as $index => $faq): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq<?= $index ?>">
                                <button class="accordion-button <?= $index > 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>">
                                    <i class="fas fa-question-circle me-2 text-primary"></i><?= htmlspecialchars($faq['question']) ?>
                                </button>
                            </h2>
                            <div id="collapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <?= nl2br(htmlspecialchars($faq['answer'])) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5 bg-primary text-white text-center">
    <div class="container">
        <h2 class="fw-bold mb-3">Siap Memulai Project Bersama?</h2>
        <p class="lead mb-4">Jangan ragu untuk menghubungi saya. Mari diskusikan ide Anda dan wujudkan solusi digital yang tepat.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="https://wa.me/<?= $rowSetting['phone'] ?>" class="btn btn-success btn-lg px-4" target="_blank">
                <i class="fab fa-whatsapp me-2"></i>WhatsApp
            </a>
            <a href="mailto:<?= $rowSetting['email'] ?>" class="btn btn-outline-light btn-lg px-4">
                <i class="fas fa-envelope me-2"></i>Email
            </a>
        </div>
    </div>
</section>