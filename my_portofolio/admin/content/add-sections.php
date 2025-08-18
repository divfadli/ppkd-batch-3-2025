<?php
include 'inc/helpers.php';

// --- Helper Function ---
function h($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

// --- Konfigurasi Section ---
$forms = [
    'services'    => ['title' => 'Service', 'btn' => 'success', 'table' => 'services'],
    'values'      => ['title' => 'Value', 'btn' => 'primary', 'table' => 'values_section'],
    'soft-skills' => ['title' => 'Soft Skill', 'btn' => 'warning', 'table' => 'soft_skills'],
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

        header("Location: ?page=add-sections&success=" . urlencode($msg));
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
    $form_type = $_POST['form_type'];
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
        header("Location: ?page=add-sections&success=" . urlencode($msg));
        exit;
    }
}

// --- Success Redirect Message ---
if (isset($_GET['success'])) {
    $msg = $_GET['success'];
}
?>

<div class="container mt-4">
    <?php if (!empty($msg)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= h($msg) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php foreach ($forms as $key => $form): 
            $table = $form['table'];
            $qData = mysqli_query($koneksi, "SELECT * FROM $table ORDER BY id DESC");
        ?>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <?= ($editData && $editData['table']===$table) ? "Edit " . $form['title'] : "Tambah " . $form['title'] ?>
                    </h5>

                    <!-- Form Input -->
                    <form method="post" class="mb-3">
                        <input type="hidden" name="form_type" value="<?= h($key) ?>">
                        <?php if ($editData && $editData['table']===$table): ?>
                            <input type="hidden" name="id" value="<?= h($editData['id']) ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label">Icon</label>
                            <input type="text" name="icon" class="form-control"
                                value="<?= ($editData && $editData['table']===$table) ? h($editData['icon']) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" name="title" class="form-control"
                                value="<?= ($editData && $editData['table']===$table) ? h($editData['title']) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea name="content" class="form-control" rows="3" required><?= ($editData && $editData['table']===$table) ? h($editData['content']) : '' ?></textarea>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" name="is_active" class="form-check-input" id="active-<?= $key ?>"
                                <?= (!$editData || $editData['is_active']) ? 'checked' : '' ?>>
                            <label for="active-<?= $key ?>" class="form-check-label">Aktif</label>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-<?= $form['btn'] ?> w-100">
                                <?= ($editData && $editData['table']===$table) ? "Update" : "Simpan" ?>
                            </button>
                            <?php if ($editData && $editData['table']===$table): ?>
                                <a href="?page=add-sections" class="btn btn-secondary">Batal</a>
                            <?php endif; ?>
                        </div>
                    </form>

                    <!-- List Data -->
                    <h6 class="mb-2">Daftar <?= $form['title'] ?></h6>
                    <div class="table-responsive" style="max-height: 250px; overflow-y:auto;">
                        <table class="table table-sm table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:20%">Icon</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th style="width:70px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($qData)): ?>
                                <tr>
                                    <td><?= h($row['icon']) ?></td>
                                    <td><?= h($row['title']) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $row['is_active'] ? 'success' : 'secondary' ?>">
                                            <?= $row['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="?page=add-sections&edit=<?= $row['id'] ?>&table=<?= $table ?>" 
                                           class="btn btn-sm btn-warning">✏️</a>
                                        <a href="?page=add-sections&delete=<?= $row['id'] ?>&table=<?= $table ?>" 
                                           onclick="return confirm('Yakin hapus data ini?')" 
                                           class="btn btn-sm btn-danger">🗑</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
