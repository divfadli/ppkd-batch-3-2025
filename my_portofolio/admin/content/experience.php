<?php
// Ambil semua data pengalaman
$qExp = mysqli_query($koneksi, "SELECT * FROM experiences ORDER BY id DESC");
$experiences = mysqli_fetch_all($qExp, MYSQLI_ASSOC);

// Fungsi render badge teknologi (support JSON format [{"value":"xxx"}])
function renderTechnologies($techStr) {
    if (empty($techStr)) {
        return "<span class='text-muted'>-</span>";
    }

    $html = "";

    // Coba decode JSON
    $decoded = json_decode($techStr, true);

    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        foreach ($decoded as $item) {
            if (isset($item['value'])) {
                $html .= "<span class='badge bg-secondary me-1 mb-1'>".htmlspecialchars($item['value'])."</span>";
            }
        }
    } else {
        // fallback kalau bukan JSON → dianggap dipisah koma
        $techs = array_filter(array_map("trim", explode(",", $techStr)));
        foreach ($techs as $tech) {
            $html .= "<span class='badge bg-secondary me-1 mb-1'>".htmlspecialchars($tech)."</span>";
        }
    }

    return $html ?: "<span class='text-muted'>-</span>";
}

// Fungsi badge tipe pekerjaan
function typeBadge($type) {
    $map = [
        "Full-Time"  => "primary",
        "Part-Time"  => "info",
        "Internship" => "success",
        "Freelance"  => "warning text-dark",
        "Contract"   => "dark"
    ];
    $color = $map[$type] ?? "secondary";
    return "<span class='badge bg-$color'>".htmlspecialchars($type)."</span>";
}
?>

<div class="container mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="bi bi-briefcase-fill"></i> Daftar Pengalaman Kerja
        </h2>
        <a href="?page=experience-form" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle"></i> Tambah Experience
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
                            <th style="width: 15%;">Posisi</th>
                            <th style="width: 18%;">Perusahaan</th>
                            <th style="width: 15%;">Lokasi</th>
                            <th style="width: 10%;">Tipe</th>
                            <th style="width: 20%;">Technologies</th>
                            <th style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($experiences)): ?>
                        <?php foreach($experiences as $exp): ?>
                        <tr class="text-center">
                            <td>
                                <?= htmlspecialchars($exp['start_year']) ?> - <?= htmlspecialchars($exp['end_year']) ?>
                            </td>
                            <td><strong><?= htmlspecialchars($exp['position']) ?></strong></td>
                            <td><?= htmlspecialchars($exp['company']) ?></td>
                            <td><?= htmlspecialchars($exp['location']) ?></td>
                            <td>
                                <?= typeBadge($exp['type']) ?>
                            </td>
                            <td><?= renderTechnologies($exp['technologies']) ?></td>
                            <td>
                                <a href="?page=experience-form&id=<?= $exp['id'] ?>" class="btn btn-sm btn-warning me-1"
                                    title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="?page=experience-form&delete=<?= $exp['id'] ?>"
                                    onclick="return confirm('Yakin hapus data ini?')" class="btn btn-sm btn-danger"
                                    title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada data pengalaman
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>