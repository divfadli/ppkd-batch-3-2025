<?php
include 'inc/helpers.php';

// Ambil section_id dari URL (default: 4 = prolanguage)
$section_id = isset($_GET['section_id']) ? intval($_GET['section_id']) : 4;

// Ambil data section
$qSection = mysqli_query($koneksi, "SELECT * FROM sections WHERE id=$section_id");
$section = mysqli_fetch_assoc($qSection);

// ============================
// CREATE / UPDATE
// ============================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $name = mysqli_real_escape_string($koneksi, $_POST['name']);
    $percentage = (int) $_POST['percentage'];
    $icon = mysqli_real_escape_string($koneksi, $_POST['icon']);
    $color = mysqli_real_escape_string($koneksi, $_POST['color']);
    $section_id = (int) $_POST['section_id'];

    if ($id) {
        $sql = "UPDATE skills_items SET 
                    name='$name',
                    percentage=$percentage,
                    icon='$icon',
                    color='$color'
                WHERE id=$id";
    } else {
        $sql = "INSERT INTO skills_items (section_id, name, percentage, icon, color) 
                VALUES ($section_id, '$name', $percentage, '$icon', '$color')";
    }
    mysqli_query($koneksi, $sql);
    header("Location: ?page=skills&section_id=$section_id");
    exit;
}

// ============================
// DELETE
// ============================
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($koneksi, "DELETE FROM skills_items WHERE id=$id");
    header("Location: ?page=skills&section_id=$section_id");
    exit;
}

// ============================
// EDIT
// ============================
$editData = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $qEdit = mysqli_query($koneksi, "SELECT * FROM skills_items WHERE id=$id");
    $editData = mysqli_fetch_assoc($qEdit);
}

// ============================
// READ
// ============================
$q = mysqli_query($koneksi, "SELECT * FROM skills_items WHERE section_id=$section_id ORDER BY id DESC");
$skills = mysqli_fetch_all($q, MYSQLI_ASSOC);
?>

<div class="container py-5">
    <h2 class="mb-4 fw-bold">⚡ CRUD Skills - <span class="text-primary"><?= ucfirst($section['name']); ?></span></h2>

    <!-- Form Add/Edit -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-tools"></i> <?= $editData ? "Edit Skill" : "Tambah Skill"; ?>
        </div>
        <div class="card-body">
            <form method="POST" class="row g-3">
                <input type="hidden" name="id" value="<?= $editData['id'] ?? ''; ?>">
                <input type="hidden" name="section_id" value="<?= $section_id; ?>">

                <div class="col-md-6">
                    <label class="form-label">Nama Skill</label>
                    <input type="text" name="name" class="form-control" 
                           value="<?= $editData['name'] ?? ''; ?>" placeholder="Contoh: JavaScript" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Persentase (%)</label>
                    <input type="range" name="percentage" class="form-range" min="0" max="100" step="1"
                        value="<?= $editData['percentage'] ?? 50; ?>"
                        oninput="document.getElementById('percentageValue').innerText = this.value + '%'">
                    <div><strong id="percentageValue"><?= $editData['percentage'] ?? 50; ?>%</strong></div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Icon (FontAwesome)</label>
                    <input type="text" name="icon" class="form-control" 
                           placeholder="contoh: fab fa-js-square"
                           value="<?= $editData['icon'] ?? ''; ?>" required>
                    <?php if ($editData): ?>
                        <div class="mt-2"><i class="<?= $editData['icon']; ?> icon-preview"></i></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Warna (#hex)</label>
                    <input type="color" name="color" class="form-control form-control-color" 
                           value="<?= $editData['color'] ?? '#0d6efd'; ?>">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> <?= $editData ? "Update" : "Tambah"; ?>
                    </button>
                    <?php if ($editData): ?>
                        <a href="?page=skills&section_id=<?= $section_id; ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left-circle"></i> Batal
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <!-- List Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-list-task"></i> Daftar Skills
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Skill</th>
                        <th>Preview</th>
                        <th>Color</th>
                        <th>Progress</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($skills): foreach ($skills as $i => $s): ?>
                        <tr>
                            <td><?= $i+1; ?></td>
                            <td class="fw-semibold"><?= $s['name']; ?></td>
                            <td><i class="<?= $s['icon']; ?> icon-preview" style="color:<?= $s['color']; ?>"></i></td>
                            <td><span class="badge rounded-pill" style="background:<?= $s['color']; ?>"><?= $s['color']; ?></span></td>
                            <td>
                                <div class="progress skill-progress">
                                    <div class="progress-bar" role="progressbar" style="width: <?= $s['percentage']; ?>%; background:<?= $s['color']; ?>;">
                                        <?= $s['percentage']; ?>%
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="?page=skills&section_id=<?= $section_id; ?>&edit=<?= $s['id']; ?>" 
                                   class="btn btn-sm btn-primary me-1"><i class="bi bi-pencil-square"></i></a>
                                <a href="?page=skills&section_id=<?= $section_id; ?>&delete=<?= $s['id']; ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin hapus skill ini?')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="6" class="text-center py-3">Belum ada data skill</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
