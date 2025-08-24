<?php 
include "koneksi.php";

// Ambil type (education / certification)
$type = $_GET['type'] ?? 'education';

// Ambil section sesuai type 
$qSection = mysqli_query($koneksi, "SELECT * FROM sections WHERE type='$type' LIMIT 1");
$section = mysqli_fetch_assoc($qSection);

// Jika tidak ada section
if (!$section) {
    echo "<div class='container mt-4'>
            <div class='alert alert-danger d-flex align-items-center gap-2'>
                <i class='bi bi-exclamation-triangle-fill fs-4'></i>
                <div>Section untuk <b>$type</b> belum ada di database.</div>
            </div>
          </div>";
    exit;
}
$section_id = $section['id'];

// DELETE 
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $table = ($type === 'education') ? 'education' : 'certification';
    mysqli_query($koneksi, "DELETE FROM $table WHERE id=$id");
    header("Location: ?page=edu-cert&type=$type&msg=deleted");
    exit;
}

// Ambil data sesuai type
$table = ($type === 'education') ? 'education' : 'certification';
$order = ($type === 'education') ? 'end_year DESC' : 'year DESC';
$result = mysqli_query($koneksi, "SELECT * FROM $table WHERE section_id=$section_id ORDER BY $order");

// Pilih warna header tabel
$theadClass = ($type === 'education') ? 'table-secondary' : 'table-success';
?>

<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0"><i class="bi bi-mortarboard-fill me-2"></i>Manajemen <?= ucfirst($type) ?></h5> 
            <a href="?page=edu-cert-form&type=<?= $type ?>" class="btn btn-light btn-sm shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah <?= ucfirst($type) ?>
            </a>
        </div>
        <div class="card-body mt-4">

            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
                <div class="alert alert-success d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <div>Data berhasil dihapus!</div>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle shadow-sm">
                    <?php if ($type === 'education'): ?>
                        <thead class="<?= $theadClass ?>">
                            <tr>
                                <th class="text-center">Start</th>
                                <th class="text-center">End</th>
                                <th class="text-center">Degree</th>
                                <th class="text-center">School</th>
                                <th class="text-center">Description</th>
                                <th class="text-center" width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td class="text-center"><span class="badge bg-primary"><?= $row['start_year'] ?></span></td>
                                    <td class="text-center"><span class="badge bg-success"><?= $row['end_year'] ?></span></td>
                                    <td class="text-center"><b><?= $row['degree'] ?></b></td>
                                    <td class="text-center"><?= $row['school'] ?></td>
                                    <td><?= $row['description'] ?></td>
                                    <td class="text-center">
                                        <div class="d-inline-flex gap-2">
                                            <a href="?page=edu-cert-form&type=education&edit=<?= $row['id'] ?>" 
                                               class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="?page=edu-cert&type=education&delete=<?= $row['id'] ?>" 
                                               onclick="return confirm('Yakin hapus data ini?')" 
                                               class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>

                    <?php else: ?>
                        <thead class="<?= $theadClass ?>">
                            <tr>
                                <th>Title</th>
                                <th class="text-center">Provider</th>
                                <th class="text-center">Year</th>
                                <th class="text-center">Icon</th>
                                <th class="text-center" width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><b><?= $row['title'] ?></b></td>
                                    <td class="text-center"><?= $row['provider'] ?></td>
                                    <td class="text-center"><span class="badge bg-info"><?= $row['year'] ?></span></td>
                                    <td class="text-center"><i class="<?= $row['icon'] ?> fs-5"></i></td>
                                    <td class="text-center">
                                        <div class="d-inline-flex gap-2">
                                            <a href="?page=edu-cert-form&type=certification&edit=<?= $row['id'] ?>" 
                                               class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="?page=edu-cert&type=certification&delete=<?= $row['id'] ?>" 
                                               onclick="return confirm('Yakin hapus data ini?')" 
                                               class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    <?php endif; ?>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
    // Aktifkan tooltip Bootstrap
    document.addEventListener("DOMContentLoaded", function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (el) {
            return new bootstrap.Tooltip(el)
        })
    });
</script>
