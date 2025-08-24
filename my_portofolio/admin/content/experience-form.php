<?php
// =============================
// Inisialisasi
// =============================
$id = isset($_GET['id']) ? intval($_GET['id']) : null;
$experience = [
    'start_year'   => '',
    'end_year'     => '',
    'position'     => '',
    'company'      => '',
    'location'     => '',
    'type'         => '',
    'description'  => '',
    'achievements' => '',
    'technologies' => ''
];

$currentYear = date("Y");
$years = range($currentYear + 5, 1980);

// =============================
// Jika edit → ambil data
// =============================
if ($id) {
    $q = mysqli_query($koneksi, "SELECT * FROM experiences WHERE id=$id");
    if ($q && mysqli_num_rows($q) > 0) {
        $experience = mysqli_fetch_assoc($q);
    }
}

// =============================
// Ambil whitelist teknologi
// =============================
$whitelistTech = [];
$qTechSections = mysqli_query($koneksi, "SELECT id FROM sections WHERE type='technology'");
$sectionIds = [];
while ($row = mysqli_fetch_assoc($qTechSections)) {
    $sectionIds[] = $row['id'];
}

if (!empty($sectionIds)) {
    $idList = implode(",", array_map("intval", $sectionIds));
    $qSkills = mysqli_query($koneksi, "SELECT name FROM skills_items WHERE section_id IN ($idList) ORDER BY name ASC");
    while ($row = mysqli_fetch_assoc($qSkills)) {
        $whitelistTech[] = $row['name'];
    }
    $whitelistTech = array_values(array_unique($whitelistTech)); // hilangkan duplikat
}

// =============================
// Fungsi bantu
// =============================
function tagifyToString($jsonStr)
{
    $arr = json_decode($jsonStr, true) ?? [];
    return implode(", ", array_column($arr, 'value'));
}

function stringToTagify($str)
{
    if (empty(trim($str))) return "[]";
    $items = array_map("trim", explode(",", $str));
    return json_encode(array_map(fn($v) => ["value" => $v], $items));
}

// =============================
// Simpan data
// =============================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_year  = $_POST['start_year'];
    $end_year    = $_POST['end_year'];
    $position    = $_POST['position'];
    $company     = $_POST['company'];
    $location    = $_POST['location'];
    $type        = $_POST['type'];
    $description = $_POST['description'];

    // $achievements = tagifyToString($_POST['achievements']);
    // $technologies = tagifyToString($_POST['technologies']);
    $achievements = $_POST['achievements'];
    $technologies = $_POST['technologies'];

    if ($id) {
        $sql = "UPDATE experiences SET 
            start_year='$start_year',
            end_year='$end_year',
            position='$position',
            company='$company',
            location='$location',
            type='$type',
            description='$description',
            achievements='$achievements',
            technologies='$technologies'
            WHERE id=$id";
        $message = 'ubah-experience';
    } else {
        $sql = "INSERT INTO experiences 
            (start_year,end_year,position,company,location,type,description,achievements,technologies) 
            VALUES 
            ('$start_year','$end_year','$position','$company','$location','$type','$description','$achievements','$technologies')";
        $message = 'tambah-experience';
    }

    mysqli_query($koneksi, $sql);
    header("Location: ?page=experience&$message=berhasil");
    exit;
}

// =============================
// Hapus data
// =============================
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($koneksi, "DELETE FROM experiences WHERE id=$id");
    header("Location: ?page=experience&delete-experience=berhasil");
    exit;
}
?>

<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="bi bi-briefcase-fill"></i> <?= $id ? "Edit" : "Tambah" ?> Experience
            </h4>
        </div>
        <div class="card-body mt-4">
            <form method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Start Year</label>
                        <select name="start_year" class="form-select" required>
                            <option value="">-- Pilih Tahun --</option>
                            <?php foreach ($years as $y): ?>
                                <option value="<?= $y ?>" <?= ($experience['start_year'] ?? '') == $y ? 'selected' : '' ?>>
                                    <?= $y ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">End Year</label>
                        <select name="end_year" class="form-select" required>
                            <option value="">-- Pilih Tahun --</option>
                            <option value="Present" <?= ($experience['end_year'] ?? '') === 'Present' ? 'selected' : '' ?>>Present</option>
                            <?php foreach ($years as $y): ?>
                                <option value="<?= $y ?>" <?= ($experience['end_year'] ?? '') == $y ? 'selected' : '' ?>>
                                    <?= $y ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Posisi</label>
                    <input type="text" name="position" class="form-control"
                        value="<?= htmlspecialchars($experience['position']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Perusahaan</label>
                    <input type="text" name="company" class="form-control"
                        value="<?= htmlspecialchars($experience['company']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="location" class="form-control"
                        value="<?= htmlspecialchars($experience['location']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipe Pekerjaan</label>
                    <div class="d-flex flex-wrap gap-2">
                        <?php
                        $types = [
                            "Full-Time" => "bi bi-briefcase-fill",
                            "Part-Time" => "bi bi-clock-history",
                            "Internship" => "bi bi-mortarboard-fill",
                            "Freelance" => "bi bi-laptop",
                            "Contract" => "bi bi-file-earmark-text"
                        ];
                        foreach ($types as $val => $icon):
                        ?>
                            <input type="radio" class="btn-check" name="type" id="type-<?= strtolower($val) ?>"
                                value="<?= $val ?>" <?= $experience['type'] === $val ? 'checked' : '' ?> required>
                            <label class="btn btn-outline-primary" for="type-<?= strtolower($val) ?>">
                                <i class="<?= $icon ?>"></i> <?= $val ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>


                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control"
                        rows="3"><?= htmlspecialchars($experience['description']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Achievements</label>
                    <input type="text" id="achievements" name="achievements" class="form-control"
                        value='<?= htmlspecialchars($experience['achievements']) ?>'>
                </div>

                <div class="mb-3">
                    <label class="form-label">Technologies</label>
                    <input type="text" id="technologies" name="technologies" class="form-control"
                        value='<?= htmlspecialchars($experience['technologies']) ?>'>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="?page=experience" class="btn btn-secondary">
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
    // Tagify Achievements
    let inputAchievements = document.querySelector('#achievements');
    if (inputAchievements) new Tagify(inputAchievements);

    // Tagify Technologies dengan whitelist
    let inputTechnologies = document.querySelector('#technologies');
    if (inputTechnologies) {
        new Tagify(inputTechnologies, {
            whitelist: <?= json_encode($whitelistTech) ?>,
            dropdown: {
                maxItems: 10,
                enabled: 0,
                closeOnSelect: false
            }
        });
    }
</script>