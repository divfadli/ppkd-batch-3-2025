<?php
    // Ambil semua data dari tabel abouts (urutkan dari yang terbaru)
    $query = mysqli_query($koneksi, "SELECT * FROM abouts ORDER BY id DESC");
    $rows  = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="pagetitle">
    <h1>Data Tentang Kami</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <h5 class="card-title">Data Tentang Kami</h5>

                    <div class="mb-3 text-end">
                        <a href="?page=tambah-about" class="btn btn-primary">Tambah</a>
                    </div>

                    <!-- Listing Data -->
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Freelance</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($rows)): ?>
                                <?php foreach($rows as $key => $row): ?>
                                <tr>
                                    <td class="text-center"><?php echo $key + 1 ?></td>
                                    <td class="text-center">
                                        <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" 
                                             alt="about image" 
                                             class="img-fluid rounded" 
                                             width="80">
                                    </td>
                                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                                    <td><?php echo htmlspecialchars($row['location'] ?? '-'); ?></td>
                                    <td class="text-center">
                                        <span class="badge <?php echo $row['is_active'] ? 'bg-success' : 'bg-secondary'; ?>">
                                            <?php echo $row['is_active'] ? 'Publish' : 'Draft'; ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge <?php echo $row['freelance_status'] ? 'bg-info' : 'bg-warning'; ?>">
                                            <?php echo $row['freelance_status'] ? 'Available' : 'Not Available'; ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="?page=tambah-about&edit=<?php echo $row['id']; ?>" 
                                           class="btn btn-sm btn-success">Edit</a>
                                        <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" 
                                           href="?page=tambah-about&delete=<?php echo $row['id']; ?>" 
                                           class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</section>
