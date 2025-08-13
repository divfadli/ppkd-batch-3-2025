<?php
    $query = mysqli_query($koneksi, "SELECT * FROM clients ORDER BY id DESC");
    // All (Data lebih dari satu)
    $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="pagetitle">
    <h1>Data Client</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Client</h5>
                    <div class="mb-3" align="right">
                        <a href="?page=tambah-client" class="btn btn-primary">Tambah</a>
                    </div>
                    <!-- Listing Data -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Perusahaan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($rows as $key => $row): ?>
                            <tr>
                                <td><?php echo $key += 1?></td>
                                <td><img class="img-fluid align-items-center" src="uploads/<?php echo $row['image']?>"
                                        alt="" width="100"></td>
                                <td><?php echo $row['name']?></td>
                                <td><?php echo $row['is_active'] ? 'Publish' : 'Draft'?></td>
                                <td>
                                    <a href="?page=tambah-client&edit=<?php echo $row['id']?>"
                                        class="btn btn-sm btn-success">Edit</a>
                                    <a onclick="return confirm('Apakah anda yakin akan menghapus data ini??')"
                                        href="?page=tambah-client&delete=<?php echo $row['id']?>"
                                        class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>