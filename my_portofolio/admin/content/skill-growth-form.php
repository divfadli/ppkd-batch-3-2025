<?php
// =============================
// Inisialisasi
// =============================
$id = isset($_GET['id']) ? intval($_GET['id']) : null;
$skillGrowth = [
    'start_year' => '',
    'end_year'   => '',
    'title'      => '',
    'skills'     => ''
];

$currentYear = date("Y");
$years = range($currentYear + 5, 1980);

// =============================
// Jika edit → ambil data
// =============================
if ($id) {
    $q = mysqli_query($koneksi, "SELECT * FROM skill_growth WHERE id=$id");
    if ($q && mysqli_num_rows($q) > 0) {
        $skillGrowth = mysqli_fetch_assoc($q);
    }
}

// =============================
// Ambil whitelist skills
// =============================
$whitelistSkills = [];
$qSkillSections = mysqli_query($koneksi, "SELECT id FROM sections WHERE type='skill'");
$sectionIds = [];
while ($row = mysqli_fetch_assoc($qSkillSections)) {
    $sectionIds[] = $row['id'];
}

if (!empty($sectionIds)) {
    $idList = implode(",", array_map("intval", $sectionIds));
    $qSkills = mysqli_query($koneksi, "SELECT name FROM skills_items WHERE section_id IN ($idList) ORDER BY name ASC");
    while ($row = mysqli_fetch_assoc($qSkills)) {
        $whitelistSkills[] = $row['name'];
    }
    $whitelistSkills = array_values(array_unique($whitelistSkills));
}

// =============================
// Simpan data
// =============================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_year = $_POST['start_year'];
    $end_year   = $_POST['end_year'];
    $title      = $_POST['title'];
    $skills     = $_POST['skills']; // langsung simpan JSON dari Tagify

    if ($id) {
        $sql = "UPDATE skill_growth SET 
            start_year='$start_year',
            end_year='$end_year',
            title='$title',
            skills='$skills'
            WHERE id=$id";
        $message = 'ubah-skill-growth';
    } else {
        $sql = "INSERT INTO skill_growth 
            (start_year,end_year,title,skills) 
            VALUES 
            ('$start_year','$end_year','$title','$skills')";
        $message = 'tambah-skill-growth';
    }

    mysqli_query($koneksi, $sql);
    header("Location: ?page=skill-growth&$message=berhasil");
    exit;
}

// =============================
// Hapus data
// =============================
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($koneksi, "DELETE FROM skill_growth WHERE id=$id");
    header("Location: ?page=skill-growth&delete-skill-growth=berhasil");
    exit;
}
?>

<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="bi bi-bar-chart-line-fill"></i> <?= $id ? "Edit" : "Tambah" ?> Skill Growth
            </h4>
        </div>
        <div class="card-body mt-4">
            <form method="POST">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Start Year</label>
                        <select name="start_year" class="form-select" required>
                            <option value="">-- Pilih Tahun --</option>
                            <?php foreach ($years as $y): ?>
                                <option value="<?= $y ?>" <?= ($skillGrowth['start_year'] ?? '') == $y ? 'selected' : '' ?>>
                                    <?= $y ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label">End Year</label>
                        <select name="end_year" class="form-select" required>
                            <option value="">-- Pilih Tahun --</option>
                            <option value="Present" <?= ($skillGrowth['end_year'] ?? '') === 'Present' ? 'selected' : '' ?>>
                                Present
                            </option>
                            <?php foreach ($years as $y): ?>
                                <option value="<?= $y ?>" <?= ($skillGrowth['end_year'] ?? '') == $y ? 'selected' : '' ?>>
                                    <?= $y ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title" class="form-control"
                        value="<?= htmlspecialchars($skillGrowth['title']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Skills</label>
                    <input type="text" id="skills" name="skills" class="form-control"
                        value='<?= htmlspecialchars($skillGrowth['skills']) ?>'>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="?page=skill-growth" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Tagify Skills dengan whitelist
    let inputSkills = document.querySelector('#skills');
    if (inputSkills) {
        new Tagify(inputSkills, {
            whitelist: <?= json_encode($whitelistSkills) ?>,
            dropdown: {
                maxItems: 10,
                enabled: 0,
                closeOnSelect: false
            }
        });
    }
</script>