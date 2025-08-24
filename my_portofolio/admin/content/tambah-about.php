<?php
include 'inc/helpers.php';
$id = isset($_GET['edit']) ? intval($_GET['edit']) : null;
$title = $id ? "Edit Tentang Saya" : "Tambah Tentang Saya";

// Edit Mode → ambil data lama
if ($id) {
    $query = mysqli_query($koneksi, "SELECT * FROM abouts WHERE id = '$id'");
    $rowEdit = mysqli_fetch_assoc($query);
}

// Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $queryFile = mysqli_query($koneksi, "SELECT image, cv FROM abouts WHERE id='$id'");
    $rowFile = mysqli_fetch_assoc($queryFile);

    if ($rowFile) {
        // Hapus gambar kalau ada
        if (!empty($rowFile['image']) && file_exists("uploads/" . $rowFile['image'])) {
            @unlink("uploads/" . $rowFile['image']);
        }

        // Hapus CV kalau ada
        if (!empty($rowFile['cv']) && file_exists("uploads/cv/" . $rowFile['cv'])) {
            @unlink("uploads/cv/" . $rowFile['cv']);
        }
    }

    $delete = mysqli_query($koneksi, "DELETE FROM abouts WHERE id='$id'");
    if ($delete) {
        header("location:?page=about&hapus=berhasil");
        exit();
    }
}


// Save (Insert / Update)
if (isset($_POST['simpan'])) {
    $judul      = mysqli_real_escape_string($koneksi, $_POST['title']);
    $lokasi     = mysqli_real_escape_string($koneksi, $_POST['location']);
    $short_desc = mysqli_real_escape_string($koneksi, $_POST['short_description']);
    $content    = mysqli_real_escape_string($koneksi, $_POST['content']);
    $is_active  = intval($_POST['is_active']);
    $freelance  = intval($_POST['freelance_status']);
    $created_by = $_SESSION['ID_USER'];

    // Upload file
    $image_name = uploadImage($_FILES['image'], $rowEdit['image'] ?? '');
    $cv_name    = uploadFilePDF($_FILES['cv'], $rowEdit['cv'] ?? '');

    if ($id) {
        // Update
        $update = mysqli_query($koneksi, 
            "UPDATE abouts 
             SET title='$judul', location='$lokasi', short_description='$short_desc',
                 content='$content', is_active='$is_active', freelance_status='$freelance',
                 image='$image_name', cv='$cv_name', created_by='$created_by'
             WHERE id='$id'"
        );
        if ($update) {
            header("location:?page=about&ubah=berhasil");
            exit();
        }
    } else {
        // Insert
        $insert = mysqli_query($koneksi, 
            "INSERT INTO abouts (title, location, short_description, content, image, cv, is_active, freelance_status, created_by) 
             VALUES ('$judul','$lokasi','$short_desc','$content','$image_name','$cv_name','$is_active','$freelance', '$created_by')"
        );
        if ($insert) {
            header("location:?page=about&tambah=berhasil");
            exit();
        }
    }
}

?>

<div class="pagetitle">
    <h1><?php echo $title ?></h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <h5 class="card-title"><?php echo $title ?></h5>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="">Gambar</label>
                            <input type="file" name="image" class="form-control">
                            <small class="text-muted">)* Rekomendasi Size: 4 x 6</small><br>
                            <?php if (!empty($rowEdit['image'])): ?>
                                <img class="mt-3 img-fluid rounded" 
                                    src="uploads/<?php echo htmlspecialchars($rowEdit['image']); ?>" 
                                    alt="preview" width="250">
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" name="title" 
                                placeholder="Masukkan judul about" required
                                value="<?php echo $id ? htmlspecialchars($rowEdit['title']) : ''; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Lokasi</label>
                            <input type="text" class="form-control" name="location" 
                                placeholder="Contoh: Jakarta, Indonesia"
                                value="<?php echo $id ? htmlspecialchars($rowEdit['location']) : ''; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Short Description</label>
                            <textarea name="short_description" class="summernote" rows="5"
                                class="form-control"><?php echo $id ? htmlspecialchars($rowEdit['short_description']) : ''; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Isi</label>
                            <textarea name="content" class="summernote" rows="5"
                                class="form-control"><?php echo $id ? htmlspecialchars($rowEdit['content']) : ''; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="is_active" class="form-control">
                                <option value="1" <?php echo ($id && $rowEdit['is_active'] == 1) ? 'selected' : ''; ?>>Publish</option>
                                <option value="0" <?php echo ($id && $rowEdit['is_active'] == 0) ? 'selected' : ''; ?>>Draft</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Freelance Status</label>
                            <select name="freelance_status" class="form-control">
                                <option value="1" <?php echo ($id && $rowEdit['freelance_status'] == 1) ? 'selected' : ''; ?>>Available</option>
                                <option value="0" <?php echo ($id && $rowEdit['freelance_status'] == 0) ? 'selected' : ''; ?>>Not Available</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="">Upload CV</label>
                            <input type="file" name="cv" class="form-control">
                            <?php if (!empty($rowEdit['cv'])): ?>
                                <div class="mt-3">
                                    <embed src="uploads/cv/<?php echo htmlspecialchars($rowEdit['cv']); ?>" 
                                        type="application/pdf" width="100%" height="400px" />
                                    <p class="mt-2">
                                        <a href="uploads/cv/<?php echo htmlspecialchars($rowEdit['cv']); ?>" target="_blank" class="btn btn-sm btn-success">
                                            Lihat / Download CV
                                        </a>
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
                            <a href="?page=about" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>
