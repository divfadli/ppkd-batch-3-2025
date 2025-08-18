<?php
include "koneksi.php";

// Ambil type (education / certification)
$type = $_GET['type'] ?? 'education';

// Ambil section sesuai type
$qSection = mysqli_query($koneksi, "SELECT * FROM sections WHERE type='$type' LIMIT 1");
$section  = mysqli_fetch_assoc($qSection);

// Jika tidak ada section
if (!$section) {
    echo "<div class='alert alert-danger'>⚠️ Section untuk <b>$type</b> belum ada di database.</div>";
    exit;
}
$section_id = $section['id'];

// DELETE
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if ($type === 'education') {
        mysqli_query($koneksi, "DELETE FROM education WHERE id=$id");
    } else {
        mysqli_query($koneksi, "DELETE FROM certification WHERE id=$id");
    }
    header("Location: ?page=edu-cert&type=$type&msg=deleted");
    exit;
}
?>

<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">🎓 Manajemen <?= ucfirst($type) ?></h5>
            <a href="?page=edu-cert-form&type=<?= $type ?>" class="btn btn-light btn-sm">
                ➕ Tambah <?= ucfirst($type) ?>
            </a>
        </div>
        <div class="card-body mt-4">
            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
                <div class="alert alert-success">✅ Data berhasil dihapus!</div>
            <?php endif; ?>

            <?php if ($type === 'education'): ?>
                <?php $result = mysqli_query($koneksi, "SELECT * FROM education WHERE section_id=$section_id ORDER BY end_year DESC"); ?>
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Start</th>
                                <th>End</th>
                                <th>Degree</th>
                                <th>School</th>
                                <th>Description</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?= $row['start_year'] ?></td>
                                    <td><?= $row['end_year'] ?></td>
                                    <td><b><?= $row['degree'] ?></b></td>
                                    <td><?= $row['school'] ?></td>
                                    <td><?= $row['description'] ?></td>
                                    <td>
                                        <a href="?page=edu-cert-form&type=education&edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">✏️ Edit</a>
                                        <a href="?page=edu-cert&type=education&delete=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus data ini?')" class="btn btn-danger btn-sm">🗑 Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

            <?php elseif ($type === 'certification'): ?>
                <?php $result = mysqli_query($koneksi, "SELECT * FROM certification WHERE section_id=$section_id ORDER BY year DESC"); ?>
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Title</th>
                                <th>Provider</th>
                                <th>Year</th>
                                <th>Icon</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><b><?= $row['title'] ?></b></td>
                                    <td><?= $row['provider'] ?></td>
                                    <td><?= $row['year'] ?></td>
                                    <td><i class="<?= $row['icon'] ?>"></i></td>
                                    <td>
                                        <a href="?page=edu-cert-form&type=certification&edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">✏️ Edit</a>
                                        <a href="?page=edu-cert&type=certification&delete=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus data ini?')" class="btn btn-danger btn-sm">🗑 Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
