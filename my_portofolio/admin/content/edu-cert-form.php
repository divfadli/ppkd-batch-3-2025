<?php
include "koneksi.php";

// Ambil type
$type = $_GET['type'] ?? 'education';

// Ambil section
$qSection = mysqli_query($koneksi, "SELECT * FROM sections WHERE type='$type' LIMIT 1");
$section  = mysqli_fetch_assoc($qSection);
if (!$section) {
    echo "<div class='alert alert-danger d-flex align-items-center gap-2 mt-4'>
            <i class='bi bi-exclamation-triangle-fill fs-4'></i>
            <div>Section untuk <b>$type</b> belum ada di database.</div>
          </div>";
    exit;
}
$section_id = $section['id'];

// Jika edit
$id = intval($_GET['edit'] ?? 0);
$data = [];
if ($id > 0) {
    $table = ($type === 'education') ? 'education' : 'certification';
    $q = mysqli_query($koneksi, "SELECT * FROM $table WHERE id=$id");
    $data = mysqli_fetch_assoc($q);
}

// Generate tahun (1980 - tahun sekarang+5)
$currentYear = date("Y");
$years = range($currentYear + 5, 1980);

// Submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($type === 'education') {
        $start_year = $_POST['start_year'];
        $end_year = $_POST['end_year'];
        $degree = $_POST['degree'];
        $school = $_POST['school'];
        $description = $_POST['description'];

        if ($id > 0) {
            mysqli_query($koneksi, "UPDATE education 
                SET start_year='$start_year', end_year='$end_year', degree='$degree', school='$school', description='$description'
                WHERE id=$id");
        } else {
            mysqli_query($koneksi, "INSERT INTO education (section_id, start_year, end_year, degree, school, description)
                VALUES ($section_id, '$start_year', '$end_year', '$degree', '$school', '$description')");
        }
    } else {
        $title = $_POST['title'];
        $provider = $_POST['provider'];
        $year = $_POST['year'];
        $icon = $_POST['icon'] ?? 'fas fa-certificate';

        if ($id > 0) {
            mysqli_query($koneksi, "UPDATE certification 
                SET title='$title', provider='$provider', year='$year', icon='$icon'
                WHERE id=$id");
        } else {
            mysqli_query($koneksi, "INSERT INTO certification (section_id, title, provider, year, icon)
                VALUES ($section_id, '$title', '$provider', '$year', '$icon')");
        }
    }
    header("Location: ?page=edu-cert&type=$type&msg=saved");
    exit;
}
?>

<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-gradient bg-success text-white py-3">
            <h5 class="mb-0"><i class="bi <?= $id > 0 ? 'bi-pencil-square' : 'bi-plus-circle' ?> me-2"></i>
                <?= $id > 0 ? "Edit" : "Tambah" ?> <?= ucfirst($type) ?>
            </h5>
        </div>
        <div class="card-body p-4">
            <form method="post" class="row g-4">
                <?php if ($type === 'education'): ?>
                    <div class="col-md-6">
                        <label class="form-label">Start Year</label>
                        <select name="start_year" class="form-select" required>
                            <option value="">-- Pilih Tahun --</option>
                            <?php foreach ($years as $y): ?>
                                <option value="<?= $y ?>" <?= ($data['start_year'] ?? '') == $y ? 'selected' : '' ?>>
                                    <?= $y ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">End Year</label>
                        <select name="end_year" class="form-select" required>
                            <option value="">-- Pilih Tahun --</option>
                            <option value="Present" <?= ($data['end_year'] ?? '') === 'Present' ? 'selected' : '' ?>>Present</option>
                            <?php foreach ($years as $y): ?>
                                <option value="<?= $y ?>" <?= ($data['end_year'] ?? '') == $y ? 'selected' : '' ?>>
                                    <?= $y ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Degree</label>
                        <input type="text" name="degree" class="form-control" value="<?= $data['degree'] ?? '' ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">School</label>
                        <input type="text" name="school" class="form-control" value="<?= $data['school'] ?? '' ?>" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control summernote"><?= $data['description'] ?? '' ?></textarea>
                    </div>

                <?php else: ?>
                    <div class="col-md-6">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="<?= $data['title'] ?? '' ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Provider</label>
                        <input type="text" name="provider" class="form-control" value="<?= $data['provider'] ?? '' ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Year</label>
                        <select name="year" class="form-select" required>
                            <option value="">-- Pilih Tahun --</option>
                            <?php foreach ($years as $y): ?>
                                <option value="<?= $y ?>" <?= ($data['year'] ?? '') == $y ? 'selected' : '' ?>>
                                    <?= $y ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Icon</label>
                        <input type="text" name="icon" class="form-control" value="<?= $data['icon'] ?? 'fas fa-certificate' ?>">
                        <small class="text-muted">Gunakan class FontAwesome (mis: <code>fas fa-certificate</code>)</small>
                    </div>
                <?php endif; ?>

                <div class="col-12 d-flex justify-content-between mt-3">
                    <a href="?page=edu-cert&type=<?= $type ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>