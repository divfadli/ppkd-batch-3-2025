<?php
include 'inc/helpers.php';

// Handle delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($koneksi, "DELETE FROM messages WHERE id=$id");
    header("Location: messages.php?deleted=1");
    exit;
}

// Ambil semua pesan
$qMessages = mysqli_query($koneksi, "SELECT * FROM messages ORDER BY created_at DESC");
$rows = mysqli_fetch_all($qMessages, MYSQLI_ASSOC);

// Pesan yang dipilih dari header
$selectedId = $_GET['id'] ?? null;
?>

<div class="container py-4">
    <!-- Header -->
    <div class="d-flex align-items-center mb-4">
        <i class="fas fa-home text-muted me-2"></i>
        <a href="dashboard"><span class="text-muted me-2">Dashboard</span></a>/
        <span class="fw-semibold text-primary ms-2">Pesan Masuk</span>
    </div>

    <div class="d-flex align-items-center mb-4">
        <i class="fas fa-envelope-open text-primary fs-3 me-2"></i>
        <h3 class="fw-bold text-primary m-0">Pesan Masuk</h3>
    </div>

    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i>Pesan berhasil dihapus.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Card Tabel -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <table class="table align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th style="width:5%">#</th>
                        <th style="width:20%">Nama</th>
                        <th style="width:25%">Email</th>
                        <th style="width:20%">Subject</th>
                        <th style="width:20%">Tanggal</th>
                        <th class="text-center" style="width:10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $i => $msg): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($msg['name']) ?></td>
                            <td>
                                <a href="mailto:<?= $msg['email'] ?>" class="text-decoration-none text-primary">
                                    <?= $msg['email'] ?>
                                </a>
                            </td>
                            <td>
                                <span class="badge bg-info text-white px-3 py-2 rounded-pill">
                                    <?= htmlspecialchars($msg['subject']) ?>
                                </span>
                            </td>
                            <td><?= date('d M Y H:i', strtotime($msg['created_at'])) ?></td>
                            <td class="text-center">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal<?= $msg['id'] ?>" 
                                   class="btn btn-sm btn-outline-primary rounded-circle me-1" title="Lihat Pesan">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="?delete=<?= $msg['id'] ?>" 
                                   onclick="return confirm('Yakin ingin menghapus pesan ini?')" 
                                   class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus Pesan">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Modal Detail -->
                        <div class="modal fade" id="detailModal<?= $msg['id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content rounded-4 shadow">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-envelope me-2"></i>Detail Pesan
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-2"><strong>Nama:</strong> <?= htmlspecialchars($msg['name']) ?></div>
                                        <div class="mb-2"><strong>Email:</strong> 
                                            <a href="mailto:<?= $msg['email'] ?>" class="text-decoration-none">
                                                <?= $msg['email'] ?>
                                            </a>
                                        </div>
                                        <div class="mb-2"><strong>Subject:</strong> <?= htmlspecialchars($msg['subject']) ?></div>
                                        <div class="mb-3"><strong>Tanggal:</strong> <?= date('d M Y H:i', strtotime($msg['created_at'])) ?></div>
                                        <hr>
                                        <p class="text-muted"><?= nl2br(htmlspecialchars($msg['message'])) ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php if ($selectedId): ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modal = new bootstrap.Modal(document.getElementById("detailModal<?= (int)$selectedId ?>"));
        modal.show();
    });
</script>
<?php endif; ?>
