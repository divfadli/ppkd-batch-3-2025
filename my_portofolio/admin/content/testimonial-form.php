<?php
$id   = isset($_GET['id']) ? intval($_GET['id']) : 0;
$data = ["content" => "", "img" => "", "name" => "", "role" => ""];

// Ambil data jika edit
if ($id) {
    $q    = mysqli_query($koneksi, "SELECT * FROM testimonials WHERE id=$id LIMIT 1");
    $data = mysqli_fetch_assoc($q) ?: $data;
}

// Simpan data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = mysqli_real_escape_string($koneksi, $_POST['content'] ?? "");
    $img     = mysqli_real_escape_string($koneksi, $_POST['img'] ?? "");
    $name    = mysqli_real_escape_string($koneksi, $_POST['name'] ?? "");
    $role    = mysqli_real_escape_string($koneksi, $_POST['role'] ?? "");

    if ($id) {
        $sql = "UPDATE testimonials 
                SET content='$content', img='$img', name='$name', role='$role' 
                WHERE id=$id";
    } else {
        $sql = "INSERT INTO testimonials (content, img, name, role) 
                VALUES ('$content','$img','$name','$role')";
    }

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>
                alert('Data testimonial berhasil disimpan');
                window.location='?page=testimonial';
              </script>";
        exit;
    } else {
        echo "<div class='alert alert-danger'>Gagal menyimpan data! " . mysqli_error($koneksi) . "</div>";
    }
}
?>

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <h3 class="mb-4 fw-bold text-primary">
                <i class="bi bi-chat-quote-fill"></i> 
                <?= $id ? "Edit Testimonial" : "Tambah Testimonial" ?>
            </h3>

            <form method="post" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Isi Testimonial</label>
                    <textarea name="content" class="form-control rounded-3 shadow-sm" rows="4" 
                              placeholder="Tulis pengalaman atau kesan Anda..." required><?= htmlspecialchars($data['content']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Foto (URL)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-image"></i></span>
                        <input type="text" name="img" class="form-control rounded-end shadow-sm" 
                               value="<?= htmlspecialchars($data['img']) ?>" 
                               placeholder="https://example.com/foto.jpg" required
                               oninput="document.getElementById('previewImg').src=this.value">
                    </div>
                    <small class="text-muted">Gunakan link gambar (contoh: dari Pexels/Unsplash)</small>
                    <div class="mt-3 text-center">
                        <img id="previewImg" src="<?= htmlspecialchars($data['img']) ?: 'https://via.placeholder.com/150x150?text=Preview' ?>" 
                             class="img-thumbnail rounded-circle shadow-sm" width="120" height="120" alt="Preview">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" name="name" class="form-control rounded-3 shadow-sm" 
                               value="<?= htmlspecialchars($data['name']) ?>" 
                               placeholder="Masukkan nama Anda" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Role</label>
                        <input type="text" name="role" class="form-control rounded-3 shadow-sm" 
                               value="<?= htmlspecialchars($data['role']) ?>" 
                               placeholder="Contoh: Mahasiswa, CEO, Designer" required>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="?page=testimonial" class="btn btn-outline-secondary rounded-3">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success rounded-3 px-4">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
