<?php
// Ambil data testimonial
$qTesti = mysqli_query($koneksi, "SELECT * FROM testimonials ORDER BY id DESC");
$testimonials = mysqli_fetch_all($qTesti, MYSQLI_ASSOC);
$total = count($testimonials);
?>

<div class="container mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 fw-bold">
                <i class="bi bi-chat-quote-fill text-primary"></i> Daftar Testimonial
            </h2>
            <small class="text-muted">Total <span class="badge bg-primary"><?= $total ?></span> testimonial</small>
        </div>
        <a href="?page=testimonial-form" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Testimonial
        </a>
    </div>

    <!-- Table -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <div class="table-responsive mt-2">
                <table class="table align-middle table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <th style="width: 35%;">Isi Testimonial</th>
                            <th style="width: 25%;">Identitas</th>
                            <th style="width: 20%;">Role</th>
                            <th style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($testimonials)): ?>
                        <?php foreach($testimonials as $t): ?>
                        <tr>
                            <!-- Isi testimonial -->
                            <td>
                                <span class="fst-italic text-muted">
                                    "<?= htmlspecialchars(mb_strimwidth($t['content'], 0, 80, '...')) ?>"
                                </span>
                            </td>

                            <!-- Identitas (foto + nama) -->
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="<?= htmlspecialchars($t['img']) ?>" 
                                         class="rounded-circle border me-2 shadow-sm"
                                         alt="foto" width="50" height="50">
                                    <div class="text-start">
                                        <strong><?= htmlspecialchars($t['name']) ?></strong><br>
                                        <small class="text-muted">#<?= $t['id'] ?></small>
                                    </div>
                                </div>
                            </td>

                            <!-- Role -->
                            <td class="text-center">
                                <span class="badge bg-info text-dark px-3 py-2">
                                    <?= htmlspecialchars($t['role']) ?>
                                </span>
                            </td>

                            <!-- Aksi -->
                            <td class="text-center">
                                <a href="?page=testimonial-form&id=<?= $t['id'] ?>" 
                                   class="btn btn-sm btn-warning me-1" 
                                   data-bs-toggle="tooltip" title="Edit Testimonial">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="?page=testimonial&delete=<?= $t['id'] ?>" 
                                   onclick="return confirm('Yakin hapus testimonial ini?')" 
                                   class="btn btn-sm btn-danger" 
                                   data-bs-toggle="tooltip" title="Hapus Testimonial">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <!-- Empty State -->
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">
                                <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                <p class="mb-1">Belum ada testimonial</p>
                                <a href="?page=testimonial-form" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-plus-circle"></i> Tambah Testimonial Pertama
                                </a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
// Hapus data
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($koneksi, "DELETE FROM testimonials WHERE id=$id");
    echo "<script>alert('Testimonial berhasil dihapus');window.location='?page=testimonial';</script>";
}
?>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(el => new bootstrap.Tooltip(el))
})
</script>
