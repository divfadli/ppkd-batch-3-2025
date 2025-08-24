<?php
include 'inc/helpers.php';

// --- Helper Function ---
function h($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

// --- Konfigurasi Section sesuai sidebar.php ---
$forms = [
    'values_section' => ['title' => 'Value', 'btn' => 'primary', 'table' => 'values_section'],
    'soft_skills'    => ['title' => 'Soft Skill', 'btn' => 'warning', 'table' => 'soft_skills'],
    'services'       => ['title' => 'Service', 'btn' => 'success', 'table' => 'services'],
    'floating_card'  => ['title' => 'Floating Card', 'btn' => 'info', 'table' => 'floating_card'],
];

// --- Ambil data sections ---
$qSections = mysqli_query($koneksi, "SELECT * FROM sections");
$sections = [];
while ($row = mysqli_fetch_assoc($qSections)) {
    $sections[$row['name']] = $row;
}

// --- Handler Delete ---
if (isset($_GET['delete'], $_GET['table'])) {
    $id    = intval($_GET['delete']);
    $table = $_GET['table'];

    if (in_array($table, array_column($forms, 'table'))) {
        mysqli_query($koneksi, "DELETE FROM $table WHERE id='$id'");
        $msg = ucfirst(str_replace("_"," ",$table)) . " berhasil dihapus!";

        header("Location: ?page=add-sections&type=$table&success=" . urlencode($msg));
        exit;
    }
}

// --- Handler Edit ---
$editData = null;
if (isset($_GET['edit'], $_GET['table'])) {
    $id    = intval($_GET['edit']);
    $table = $_GET['table'];

    if (in_array($table, array_column($forms, 'table'))) {
        $q = mysqli_query($koneksi, "SELECT * FROM $table WHERE id='$id'");
        $editData = mysqli_fetch_assoc($q);
        $editData['table'] = $table;
    }
}

// --- Handler Submit ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_type = $_POST['form_type'];   // sesuai dengan key di $forms
    $icon      = mysqli_real_escape_string($koneksi, $_POST['icon']);
    $title     = mysqli_real_escape_string($koneksi, $_POST['title']);
    $content   = mysqli_real_escape_string($koneksi, $_POST['content']);
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    if (isset($forms[$form_type]) && isset($sections[$form_type])) {
        $section_id = $sections[$form_type]['id'];
        $table      = $forms[$form_type]['table'];

        if (!empty($_POST['id'])) {
            // Update
            $id  = intval($_POST['id']);
            $sql = "UPDATE $table 
                    SET icon='$icon', title='$title', content='$content', is_active='$is_active' 
                    WHERE id='$id'";
            $msg = $forms[$form_type]['title'] . " berhasil diupdate!";
        } else {
            // Insert
            $sql = "INSERT INTO $table (section_id, icon, title, content, is_active) 
                    VALUES ('$section_id','$icon','$title','$content','$is_active')";
            $msg = $forms[$form_type]['title'] . " berhasil ditambahkan!";
        }
        mysqli_query($koneksi, $sql);

        // Redirect supaya form kosong kembali
        header("Location: ?page=add-sections&type=$form_type&success=" . urlencode($msg));
        exit;
    }
}

// --- Ambil form aktif berdasarkan ?type= ---
$currentType = $_GET['type'] ?? array_key_first($forms);
$currentForm = $forms[$currentType] ?? null;

// --- Success Redirect Message ---
$msg = $_GET['success'] ?? null;
?>

<div class="container my-5">
    <?php if (!empty($msg)): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded" role="alert">
            ✅ <?= h($msg) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php if ($currentForm): 
            $table = $currentForm['table'];
            $qData = mysqli_query($koneksi, "SELECT * FROM $table ORDER BY id DESC");
            $isEdit = ($editData && $editData['table'] === $table);
        ?>
        <div class="col-md-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3 text-<?= $currentForm['btn'] ?>">
                        <?= $isEdit ? "✏️ Edit " . $currentForm['title'] : "➕ Tambah " . $currentForm['title'] ?>
                    </h5>

                    <!-- Form Input -->
                    <form method="post" class="mb-4">
                        <input type="hidden" name="form_type" value="<?= h($currentType) ?>">
                        <?php if ($isEdit): ?>
                            <input type="hidden" name="id" value="<?= h($editData['id']) ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label">Icon</label>
                            <input type="text" name="icon" class="form-control"
                                placeholder="Contoh: fa-solid fa-star"
                                value="<?= $isEdit ? h($editData['icon']) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" name="title" class="form-control"
                                placeholder="Masukkan judul..."
                                value="<?= $isEdit ? h($editData['title']) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea name="content" class="form-control" rows="3" placeholder="Tulis deskripsi..." required><?= $isEdit ? h($editData['content']) : '' ?></textarea>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" name="is_active" class="form-check-input" id="active-<?= $currentType ?>"
                                <?= (!$isEdit || $editData['is_active']) ? 'checked' : '' ?>>
                            <label for="active-<?= $currentType ?>" class="form-check-label">Aktif</label>
                        </div>

                        <div class="d-flex">
                            <button type="submit" class="btn btn-<?= $currentForm['btn'] ?> flex-fill">
                                <i class='bi bi-save'></i><?= $isEdit ? " Update" : " Simpan" ?>
                            </button>
                            <?php if ($isEdit): ?>
                                <a href="?page=add-sections&type=<?= $currentType ?>" class="btn btn-outline-secondary">Batal</a>
                            <?php endif; ?>
                        </div>
                    </form>

                    <!-- List Data -->
                    <h6 class="fw-bold mb-2">📋 Daftar <?= $currentForm['title'] ?></h6>
                    <div class="table-responsive" style="max-height: 350px; overflow-y:auto;">
                        <table class="table table-hover table-sm align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:20%">Icon</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th style="width:80px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($qData)): ?>
                                <tr>
                                    <td><i class="<?= h($row['icon']) ?>"></i></td>
                                    <td><?= h($row['title']) ?></td>
                                    <td>
                                        <span class="badge rounded-pill bg-<?= $row['is_active'] ? 'success' : 'secondary' ?>">
                                            <?= $row['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                                        </span>
                                    </td>
                                    <td class="d-flex gap-1">
                                        <a href="?page=add-sections&type=<?= $currentType ?>&edit=<?= $row['id'] ?>&table=<?= $table ?>" 
                                           class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil-square"></i></a>
                                        <a href="?page=add-sections&type=<?= $currentType ?>&delete=<?= $row['id'] ?>&table=<?= $table ?>" 
                                           onclick="return confirm('Yakin hapus data ini?')" 
                                           class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                                <?php if (mysqli_num_rows($qData) === 0): ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada data</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
