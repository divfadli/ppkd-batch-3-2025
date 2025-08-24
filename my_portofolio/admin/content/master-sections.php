<?php
include 'inc/helpers.php';

// --- Helper ---
function h($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

// --- CRUD Handler ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id   = $_POST['id'] ?? null;
    $name = mysqli_real_escape_string($koneksi, $_POST['name']);
    $type = mysqli_real_escape_string($koneksi, $_POST['type']);

    if ($id) {
        $sql = "UPDATE sections SET name='$name', type='$type', updated_at=NOW() WHERE id=".(int)$id;
        mysqli_query($koneksi, $sql);
        $msg = "✅ Section berhasil diupdate!";
    } else {
        $sql = "INSERT INTO sections (name, type, created_at) VALUES ('$name','$type',NOW())";
        mysqli_query($koneksi, $sql);
        $msg = "✅ Section berhasil ditambahkan!";
    }
    header("Location: ?page=master-sections&success=" . urlencode($msg));
    exit;
}

// --- Delete ---
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($koneksi, "DELETE FROM sections WHERE id=$id");
    $msg = "🗑 Section berhasil dihapus!";
    header("Location: ?page=master-sections&success=" . urlencode($msg));
    exit;
}

// --- Fetch Data ---
$q = mysqli_query($koneksi, "SELECT * FROM sections ORDER BY id ASC");
$sections = [];
while ($row = mysqli_fetch_assoc($q)) {
    $sections[] = $row;
}

$msg = $_GET['success'] ?? null;
?>

<div class="container my-5">
    <?php if (!empty($msg)): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-pill px-4 py-2 small" role="alert">
            <?= h($msg) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <script>
            setTimeout(() => document.querySelector('.alert')?.classList.remove('show'), 3000);
        </script>
    <?php endif; ?>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-2 mb-md-0"><i class="bi bi-folder2-open me-2 text-primary"></i>Master Data Sections</h3>
        <div class="input-group shadow-sm rounded-pill" style="max-width: 400px;">
            <span class="input-group-text bg-white border-0"><i class="bi bi-search"></i></span>
            <input type="text" id="searchInput" class="form-control border-0" placeholder="Cari Section...">
            <button class="btn btn-primary rounded-pill px-3" type="button" data-bs-toggle="modal" data-bs-target="#modalSection">
                <i class="bi bi-plus-circle me-1"></i> Tambah
            </button>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="sectionsTable">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px">#</th>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Dibuat</th>
                            <th>Update Terakhir</th>
                            <th style="width:150px" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($sections) > 0): ?>
                            <?php foreach ($sections as $s): ?>
                            <tr>
                                <td class="fw-bold text-primary">#<?= h($s['id']) ?></td>
                                <td class="fw-semibold"><?= h($s['name']) ?></td>
                                <td>
                                    <span class="badge rounded-pill bg-gradient bg-info-subtle text-dark px-3 py-2 shadow-sm">
                                        <?= h($s['type']) ?>
                                    </span>
                                </td>
                                <td><small class="text-muted"><?= h($s['created_at']) ?></small></td>
                                <td><small class="text-muted"><?= h($s['updated_at'] ?? '-') ?></small></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning rounded-pill me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalSection"
                                        data-id="<?= $s['id'] ?>"
                                        data-name="<?= h($s['name']) ?>"
                                        data-type="<?= h($s['type']) ?>"
                                        data-bs-toggle="tooltip" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <a href="?page=master-sections&delete=<?= $s['id'] ?>"
                                       onclick="return confirm('Yakin hapus section ini?')"
                                       class="btn btn-sm btn-danger rounded-pill"
                                       data-bs-toggle="tooltip" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="p-4 border rounded-3 bg-light">
                                        <i class="bi bi-inbox fs-2 text-muted mb-2"></i>
                                        <p class="text-muted mb-0">Belum ada data section</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Form -->
<div class="modal fade" id="modalSection" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="post" class="modal-content shadow-lg rounded-4 border-0">
        <div class="modal-header bg-primary text-white rounded-top-4">
            <h5 class="modal-title fw-bold"><i class="bi bi-ui-checks-grid me-2"></i>Tambah / Edit Section</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" id="section-id">
            <div class="form-floating mb-3">
                <input type="text" name="name" id="section-name" class="form-control rounded-pill" placeholder="Nama Section" required>
                <label for="section-name">Nama Section</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="type" id="section-type" class="form-control rounded-pill" placeholder="Tipe Section" required>
                <label for="section-type">Tipe Section</label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success rounded-pill px-4">
                <i class="bi bi-save me-1"></i> Simpan
            </button>
            <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                <i class="bi bi-x-circle me-1"></i> Batal
            </button>
        </div>
    </form>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById('modalSection');
    modal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id   = button.getAttribute('data-id');
        var name = button.getAttribute('data-name');
        var type = button.getAttribute('data-type');

        modal.querySelector('#section-id').value = id || "";
        modal.querySelector('#section-name').value = name || "";
        modal.querySelector('#section-type').value = type || "";
        modal.querySelector('.modal-title').innerHTML = id 
            ? "<i class='bi bi-pencil-fill me-2'></i> Edit Section" 
            : "<i class='bi bi-plus-lg me-2'></i> Tambah Section";
    });

    // Search filter
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var value = this.value.toLowerCase();
        var rows = document.querySelectorAll('#sectionsTable tbody tr');
        rows.forEach(function(row) {
            row.style.display = row.textContent.toLowerCase().includes(value) ? '' : 'none';
        });
    });

    // Tooltip init
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
});
</script>
