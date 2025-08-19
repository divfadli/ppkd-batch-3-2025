<?php
// Ambil semua project join sections
$qProjects = mysqli_query($koneksi, "
    SELECT p.*, s.name AS section_name 
    FROM projects p
    LEFT JOIN sections s ON p.section_id = s.id
    ORDER BY p.created_at DESC
");
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Portfolio</h2>
        <a href="?page=portofolio-form" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Project
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Section</th>
                    <th>Tahun</th>
                    <th>Teknologi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (mysqli_num_rows($qProjects) > 0): ?>
                <?php $no=1; while($row = mysqli_fetch_assoc($qProjects)): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['title']); ?></td>
                        <td><?= htmlspecialchars($row['section_name']); ?></td>
                        <td><?= htmlspecialchars($row['year']); ?></td>
                        <td>
                            <?php 
                            $techs = [];
                            if (!empty($row['tech'])) {
                                $decoded = json_decode($row['tech'], true);
                                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                    foreach ($decoded as $t) {
                                        if (!empty($t['value'])) {
                                            $techs[] = $t['value'];
                                        }
                                    }
                                } else {
                                    // fallback jika masih pakai format lama (comma separated)
                                    $techs = array_map('trim', explode(',', $row['tech']));
                                }
                            }

                            // tampilkan maksimal 3 badge
                            foreach(array_slice($techs, 0, 3) as $t): ?>
                                <span class="badge bg-info me-1"><?= htmlspecialchars($t); ?></span>
                            <?php endforeach; ?>

                            <?php if(count($techs) > 3): ?>
                                <span class="badge bg-secondary">+<?= count($techs) - 3; ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge <?= $row['is_active'] ? 'bg-success' : 'bg-secondary'; ?>">
                                <?= $row['is_active'] ? 'Aktif' : 'Non-Aktif'; ?>
                            </span>
                        </td>
                        <td>
                            <a href="?page=portofolio-form&id=<?= $row['id']; ?>" 
                               class="btn btn-sm btn-warning me-1" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="?page=portofolio-form&id=<?= $row['id']; ?>&action=delete" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Yakin ingin menghapus project ini?')" 
                               title="Hapus">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-muted">Belum ada data project</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
