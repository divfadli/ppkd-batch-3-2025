<?php 
include 'inc/helpers.php';

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
        $message = 'Pesan berhasil dikirim! Terima kasih telah menghubungi saya. Saya akan merespon dalam 24 jam.';
        $messageType = 'success';
        $name = $email = $subject = $messageText = '';
    }
}
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
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <?php if ($message): ?>
                <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
                    <?php echo $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>

                <div class="contact-form">
                    <form method="POST" action="">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Lengkap *</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="<?php echo $name; ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?php echo $email; ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject *</label>
                            <select class="form-control" id="subject" name="subject" required>
                                <option value="">Pilih Subject</option>
                                <?php
                                $subjects = ['Web Development','Mobile App Development','UI/UX Design','Consultation','Partnership','Other'];
                                foreach ($subjects as $subj) {
                                    $selected = ($subject === $subj) ? 'selected' : '';
                                    echo "<option value=\"$subj\" $selected>$subj</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan *</label>
                            <textarea class="form-control" id="message" name="message" rows="6"
                                      placeholder="Ceritakan tentang project Anda..." required><?php echo $messageText; ?></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 text-center mb-4">
                <i class="fas fa-map-marker-alt fa-2x mb-2"></i>
                <h5>Alamat</h5>
                <p><?= $rowSetting['address'] ?></p>
            </div>
            <div class="col-lg-4 text-center mb-4">
                <i class="fas fa-phone fa-2x mb-2"></i>
                <h5>Telepon</h5>
                <p><?= formatPhone($rowSetting['phone'], $countries); ?><br>Available 9 AM - 6 PM</p>
            </div>
            <div class="col-lg-4 text-center mb-4">
                <i class="fas fa-envelope fa-2x mb-2"></i>
                <h5>Email</h5>
                <p><?= $rowSetting['email'] ?><br>Response within 24 hours</p>
            </div>
        </div>
    </div>
</section>

    <!-- FAQ Section -->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="section-title">Frequently Asked Questions</h2>
                    <p class="section-subtitle">Pertanyaan yang sering diajukan tentang layanan saya</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                    Berapa lama waktu pengerjaan project?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Waktu pengerjaan bervariasi tergantung kompleksitas project. Website sederhana biasanya 2-4 minggu, 
                                    aplikasi web kompleks 2-3 bulan, dan aplikasi mobile 3-6 bulan. Saya akan memberikan timeline 
                                    yang detail setelah diskusi requirement.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                    Apakah menyediakan maintenance setelah project selesai?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Ya, saya menyediakan layanan maintenance dan support. Termasuk bug fixes, security updates, 
                                    dan minor improvements. Paket maintenance dapat disesuaikan dengan kebutuhan dan budget Anda.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                    Bagaimana sistem pembayaran?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sistem pembayaran fleksibel: 50% di awal sebagai down payment, 50% setelah project selesai. 
                                    Untuk project besar, bisa dibagi dalam beberapa milestone. Pembayaran dapat melalui transfer bank 
                                    atau e-wallet.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                                    Apakah bisa bekerja remote?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Tentu saja! Saya berpengalaman bekerja remote dengan klien dari berbagai kota. 
                                    Komunikasi dilakukan melalui video call, chat, dan project management tools. 
                                    Progress report diberikan secara berkala.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5">
                                    Teknologi apa saja yang dikuasai?
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Saya menguasai berbagai teknologi modern: Frontend (React, Vue, Angular), 
                                    Backend (Node.js, PHP, Laravel), Database (MySQL, MongoDB), Mobile (React Native, Flutter), 
                                    dan Cloud (AWS, Google Cloud). Lihat halaman Skills untuk detail lengkap.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                        Jangan ragu untuk menghubungi saya. Mari diskusikan ide Anda dan wujudkan solusi digital yang tepat.
                    </p>
                    <div class="cta-buttons">
                        <a href="https://wa.me/<?= $rowSetting['phone']?>" class="btn btn-success btn-lg me-3" target="_blank">
                            <i class="fab fa-whatsapp me-2"></i>WhatsApp
                        </a>
                        <a href="mailto:<?= $rowSetting['email']?>" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-envelope me-2"></i>Email
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>