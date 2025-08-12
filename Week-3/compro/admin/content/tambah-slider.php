<?php
$id = isset($_GET['edit']) ? $_GET['edit'] : null;

if(isset($_GET['edit'])){
    $query = mysqli_query($koneksi, "SELECT * FROM sliders WHERE id = '$id'");
    $rowEdit = mysqli_fetch_assoc($query);
    
    $title = "Edit Slider";
}else{
    $title = "Tambah Slider";
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $queryGambar = mysqli_query($koneksi, "SELECT id, image FROM sliders WHERE id='$id'");
    $rowGambar = mysqli_fetch_assoc($queryGambar);
    $image_name = $rowGambar['image'];
    unlink("uploads/" . $image_name);
    $delete = mysqli_query($koneksi, "DELETE FROM sliders WHERE id='$id'");

    if($delete){
        header("location:?page=slider&hapus=berhasil");
    }
}

if(isset($_POST['simpan'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_name = $rowEdit['image'] ?? '';

    if(!empty($_FILES['image']['name'])){
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $type = mime_content_type($tmp_name);
        
        $ext_allowed = ['image/png', 'image/jpg','image/jpeg'];
        if(in_array($type, $ext_allowed)){
            $path = "uploads/";
            if(!is_dir($path)) mkdir($path);

            $image_name = time() .  "-" . basename($image);
            $target_files = $path . $image_name;
            if(move_uploaded_file($_FILES['image']['tmp_name'], $target_files)){
                // jika gambar ada maka gambar sebelumnya akan diganti oleh gambar baru
                if(!empty($row['image'])){
                    // Mengganti gambar sebelum dengan gambar baru
                    unlink($path . $row['image']);
                }
            }

            echo "Gambar boleh di upload";
        }else{
            echo "Ekstensi file tidak ditemukan";
        }
    }

    if($id){
        // Update
        $update = mysqli_query($koneksi, "UPDATE sliders SET title='$title',description='$description',image='$image_name' WHERE id='$id'");
        if($update){
            header("location:?page=slider&ubah=berhasil");
        }
    }else{
        // Create
        $insert = mysqli_query($koneksi, "INSERT INTO sliders (title, description, image) VALUES ('$title','$description','$image_name')");
        if($insert){
            header("location:?page=slider&tambah=berhasil");
            exit();
        }
    }
}

?>

<div class="pagetitle">
    <h1><?php echo $title?></h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $title?></h5>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="">Gambar</label>
                            <input type="file" name="image" id=""><br>
                            <small class="text-muted">)* Size: 1920 x 1088</small><br>
                            <img class="mt-3"
                                src="uploads/<?php echo isset($rowEdit['image']) ? $rowEdit['image'] : null ?>" alt=""
                                width="250">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="title" id=""
                                placeholder="Masukkan judul slider" required
                                value="<?php echo ($id) ? $rowEdit['title'] : null ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Isi</label>
                            <textarea name="description" id="" rows="5"
                                class='form-control'><?php echo ($id) ? $rowEdit['description'] : null?></textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
                            <a href="?page=slider" class="text-muted btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>