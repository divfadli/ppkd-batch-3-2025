<?php
// Ambil data FAQ
$qFaqs = mysqli_query($koneksi, "SELECT * FROM faqs ORDER BY created_at DESC");
?>

<div class="container mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">
            <i class="bi bi-question-circle-fill"></i> Manajemen FAQ
        </h3>
        <a href="?page=faq-form" class="btn btn-primary rounded-pill shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah FAQ
        </a>
    </div>

    <!-- Notifikasi -->
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> 
            Data berhasil <strong><?= htmlspecialchars($_GET['success']) ?></strong>.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Data FAQ -->
    <div class="card shadow-sm border-0">
        <div class="card-body mt-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th width="50" class="text-center">#</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                            <th class="text-center">Status</th>
                            <th width="200" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($qFaqs) > 0): ?>
                            <?php $no=1; while ($row = mysqli_fetch_assoc($qFaqs)): ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td class="fw-semibold"><?= htmlspecialchars($row['question']) ?></td>
                                    <td><?= nl2br(htmlspecialchars(substr($row['answer'],0,100))) ?>...</td>
                                    <td class="text-center">
                                        <?php if ($row['is_active']): ?>
                                            <span class="badge bg-success px-3 py-2">
                                                <i class="bi bi-check-circle me-1"></i> Aktif
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary px-3 py-2">
                                                <i class="bi bi-x-circle me-1"></i> Nonaktif
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="?page=faq-form&id=<?= $row['id'] ?>" 
                                               class="btn btn-sm btn-warning rounded-pill shadow-sm" 
                                               data-bs-toggle="tooltip" title="Edit FAQ">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="?page=faq-form&delete=<?= $row['id'] ?>" 
                                               onclick="return confirm('Yakin ingin menghapus FAQ ini?')" 
                                               class="btn btn-sm btn-danger rounded-pill shadow-sm ms-1"
                                               data-bs-toggle="tooltip" title="Hapus FAQ">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-info-circle"></i> Belum ada data FAQ.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>