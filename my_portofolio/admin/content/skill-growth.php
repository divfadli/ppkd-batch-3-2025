<?php 
// Ambil semua data skill growth
$qSkill = mysqli_query($koneksi, "SELECT * FROM skill_growth ORDER BY id DESC");
$skillGrowths = mysqli_fetch_all($qSkill, MYSQLI_ASSOC);

// Fungsi render badge skills (support JSON format [{"value":"xxx"}])
function renderSkills($skillsStr) {
    if (empty($skillsStr)) {
        return "<span class='text-muted'>-</span>";
    }

    $html = "";

    // Coba decode JSON
    $decoded = json_decode($skillsStr, true);

    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        foreach ($decoded as $item) {
            if (isset($item['value'])) {
                $html .= "<span class='badge bg-info me-1 mb-1'>".htmlspecialchars($item['value'])."</span>";
            }
        }
    } else {
        // fallback kalau bukan JSON → dianggap dipisah koma
        $skills = array_filter(array_map("trim", explode(",", $skillsStr)));
        foreach ($skills as $skill) {
            $html .= "<span class='badge bg-info me-1 mb-1'>".htmlspecialchars($skill)."</span>";
        }
    }

    return $html ?: "<span class='text-muted'>-</span>";
}
?>

<div class="container mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="bi bi-bar-chart-line-fill"></i> Daftar Skill Growth
        </h2>
        <a href="?page=skill-growth-form" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle"></i> Tambah Skill Growth
        </a>
    </div>

    <!-- Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive mt-3">
                <table class="table table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th style="width: 12%;">Tahun</th>
                            <th style="width: 20%;">Judul</th>
                            <th style="width: 50%;">Skills</th>
                            <th style="width: 18%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($skillGrowths)): ?>
                        <?php foreach($skillGrowths as $sg): ?>
                        <tr class="text-center">
                            <td>
                                <?= htmlspecialchars($sg['start_year']) ?> - <?= htmlspecialchars($sg['end_year']) ?>
                            </td>
                            <td><strong><?= htmlspecialchars($sg['title']) ?></strong></td>
                            <td><?= renderSkills($sg['skills']) ?></td>
                            <td>
                                <a href="?page=skill-growth-form&id=<?= $sg['id'] ?>" class="btn btn-sm btn-warning me-1"
                                    title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="?page=skill-growth-form&delete=<?= $sg['id'] ?>"
                                    onclick="return confirm('Yakin hapus data ini?')" class="btn btn-sm btn-danger"
                                    title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada data skill growth
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
