<?php
// Inisialisasi
$id = isset($_GET['id']) ? intval($_GET['id']) : null;
$faq = ['question' => '', 'answer' => '', 'is_active' => 1];

// Jika edit → ambil data
if ($id) {
    $q = mysqli_query($koneksi, "SELECT * FROM faqs WHERE id=$id");
    if ($q && mysqli_num_rows($q) > 0) {
        $faq = mysqli_fetch_assoc($q);
    }
}

// Simpan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = mysqli_real_escape_string($koneksi, $_POST['question']);
    $answer   = mysqli_real_escape_string($koneksi, $_POST['answer']);
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    if ($id) {
        $sql = "UPDATE faqs SET 
                question='$question',
                answer='$answer',
                is_active='$is_active',
                updated_at=NOW()
                WHERE id=$id";
        $msg = 'diubah';
    } else {
        $sql = "INSERT INTO faqs (question, answer, is_active, created_at) 
                VALUES ('$question','$answer','$is_active',NOW())";
        $msg = 'ditambahkan';
    }

    mysqli_query($koneksi, $sql);
    header("Location: ?page=faq&success=$msg");
    exit;
}

// Hapus data
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($koneksi, "DELETE FROM faqs WHERE id=$id");
    header("Location: ?page=faq&success=dihapus");
    exit;
}
?>

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold">
                <i class="bi bi-question-circle-fill me-2"></i> <?= $id ? "Edit" : "Tambah" ?> FAQ
            </h4>
            <a href="?page=faq" class="btn btn-light btn-sm rounded-pill shadow-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body p-4">
            <form method="POST" class="needs-validation" novalidate>
                
                <!-- Pertanyaan -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Pertanyaan <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="question" 
                           class="form-control form-control-lg shadow-sm" 
                           placeholder="Tulis pertanyaan di sini..." 
                           value="<?= htmlspecialchars($faq['question']) ?>" 
                           required>
                    <div class="invalid-feedback">Pertanyaan tidak boleh kosong.</div>
                </div>

                <!-- Jawaban -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jawaban <span class="text-danger">*</span></label>
                    <textarea name="answer" 
                              class="form-control shadow-sm" 
                              rows="6" 
                              placeholder="Tuliskan jawaban secara jelas..."
                              required><?= htmlspecialchars($faq['answer']) ?></textarea>
                    <div class="invalid-feedback">Jawaban tidak boleh kosong.</div>
                </div>

                <!-- Status -->
                <div class="form-check form-switch mb-4">
                    <input type="checkbox" 
                           name="is_active" 
                           id="is_active" 
                           class="form-check-input" 
                           <?= $faq['is_active'] ? 'checked' : '' ?>>
                    <label for="is_active" class="form-check-label fw-semibold">
                        <i class="bi bi-toggle-on me-1"></i> Aktifkan FAQ
                    </label>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end gap-2">
                    <a href="?page=faq" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm">
                        <i class="bi bi-save2 me-1"></i> Simpan FAQ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap Form Validation -->
<script>
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
