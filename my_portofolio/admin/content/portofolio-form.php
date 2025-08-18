<?php
include "inc/helpers.php";

// =======================
// Ambil sections type=portfolio
// =======================
$qSections = mysqli_query($koneksi, "SELECT * FROM sections WHERE type='portfolio'");

// =======================
// Cek edit / delete project
// =======================
$id = $_GET['id'] ?? 0;
$action = $_GET['action'] ?? '';
$project = null;

if ($id) {
    $q = mysqli_query($koneksi, "SELECT * FROM projects WHERE id=" . (int)$id);
    $project = mysqli_fetch_assoc($q);
}

// =======================
// Hapus project
// =======================
if ($action === 'delete' && $id && $project) {
    // Hapus file gambar lama
    if (!empty($project['image']) && file_exists("uploads/" . $project['image'])) {
        unlink("uploads/" . $project['image']);
    }

    mysqli_query($koneksi, "DELETE FROM projects WHERE id=" . (int)$id);
    header("Location: ?page=portofolio&hapus-porto=berhasil");
    exit;
}

// =======================
// Proses simpan (tambah / edit)
// =======================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $section_id  = mysqli_real_escape_string($koneksi, $_POST['section_id']);
    $title       = mysqli_real_escape_string($koneksi, $_POST['title']);
    $description = mysqli_real_escape_string($koneksi, $_POST['description']);
    $tech        = mysqli_real_escape_string($koneksi, $_POST['tech']);
    $year        = mysqli_real_escape_string($koneksi, $_POST['year']);
    $link        = mysqli_real_escape_string($koneksi, $_POST['link']);
    $is_active   = isset($_POST['is_active']) ? 1 : 0;

    // Upload gambar
    $image = uploadImage($_FILES['image'], $project['image'] ?? '');

    if ($id) {
        // UPDATE
        mysqli_query($koneksi, "UPDATE projects SET 
            section_id='$section_id',
            title='$title',
            image='$image',
            description='$description',
            tech='$tech',
            year='$year',
            link='$link',
            is_active='$is_active'
            WHERE id=" . (int)$id);
        $message = 'ubah-porto';
    } else {
        // INSERT
        mysqli_query($koneksi, "INSERT INTO projects 
            (section_id, title, image, description, tech, year, link, is_active)
            VALUES ('$section_id','$title','$image','$description','$tech','$year','$link','$is_active')");
        $message = 'tambah-porto';
    }

    header("Location: ?page=portofolio&$message=berhasil");
    exit;
}
?>

<div class="container mt-5">
    <h2 class="mb-4"><?= $id ? 'Edit' : 'Tambah'; ?> Project</h2>
    <form method="post" enctype="multipart/form-data">
        <!-- Section -->
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="section_id" class="form-select" required>
                <?php while($s = mysqli_fetch_assoc($qSections)): ?>
                <option value="<?= $s['id']; ?>" <?= ($project && $project['section_id']==$s['id'])?'selected':''; ?>>
                    <?= htmlspecialchars($s['name']); ?>
                </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Judul -->
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($project['title'] ?? '') ?>" required>
        </div>

        <!-- Gambar -->
        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <?php if(!empty($project['image'])): ?>
                <div class="mb-2">
                    <img src="uploads/<?= htmlspecialchars($project['image']) ?>" alt="Preview" class="img-thumbnail" style="max-width:200px;">
                </div>
            <?php endif; ?>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="5"><?= htmlspecialchars($project['description'] ?? '') ?></textarea>
        </div>

        <!-- Teknologi -->
        <div class="mb-3">
            <label class="form-label">Teknologi</label>
            <input type="text" name="tech" id="tags" class="form-control" value="<?= htmlspecialchars($project['tech'] ?? '') ?>">
        </div>

        <!-- Tahun -->
        <div class="mb-3">
            <label class="form-label">Tahun</label>
            <input type="text" name="year" class="form-control" value="<?= htmlspecialchars($project['year'] ?? '') ?>">
        </div>

        <!-- Link -->
        <div class="mb-3">
            <label class="form-label">Link</label>
            <input type="text" name="link" class="form-control" value="<?= htmlspecialchars($project['link'] ?? '') ?>">
        </div>

        <!-- Aktif -->
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" 
                   value="1" <?= ($project ? $project['is_active']==1 : true)?'checked':''; ?>>
            <label class="form-check-label" for="is_active">Aktif</label>
        </div>

        <!-- Tombol -->
        <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Simpan</button>
        <a href="?page=portofolio" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Batal</a>

        <?php if ($id): ?>
        <a href="?page=portofolio-form&id=<?= $id; ?>&action=delete" 
           class="btn btn-danger" 
           onclick="return confirm('Yakin ingin menghapus project ini?')">
           <i class="fas fa-trash me-2"></i>Hapus
        </a>
        <?php endif; ?>
    </form>
</div>
