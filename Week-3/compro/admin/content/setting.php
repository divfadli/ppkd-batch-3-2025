<?php 
// jika data setting sudah ada maka update data tersebut
// selain itu jika belum ada maka insert data
if(isset($_POST['simpan'])){
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $twitter = $_POST['twitter'];
    $linkedin = $_POST['linkedin'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    // $logo = $_POST['logo'];
    
    $querySetting = mysqli_query($koneksi, "SELECT * FROM settings LIMIT 1");

    if(mysqli_num_rows($querySetting) > 0){
        // update
        $row = mysqli_fetch_assoc($querySetting);
        $id_setting = $row['id'];
        
        $update = mysqli_query($koneksi, "UPDATE settings SET
            email='$email', phone='$phone', address='$address', twitter='$twitter', linkedin='$linkedin', facebook='$facebook', instagram='$instagram' WHERE id='$id_setting'");
        if($update){
            header("location?page=setting&ubah=berhasil");
        }
    }else{
        // insert
        $insert = mysqli_query($koneksi, "INSERT INTO settings (email, phone, address, twitter, linkedin, facebook, instagram) VALUES ('$email', '$phone', '$address', '$twitter', '$linkedin', '$facebok', '$instagram')");
        if($insert){
            header("location?page=setting&tambah=berhasil");
        }
    }
}

$querySetting = mysqli_query($koneksi, "SELECT * FROM settings LIMIT 1");
$row = mysqli_fetch_assoc($querySetting);

?>

<div class="pagetitle">
    <h1>Pengaturan</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pengaturan</h5>
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- Email -->
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="" class="form-label fw-bold">Email</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="email" name="email" id="" class="form-control"
                                    value="<?php echo isset($row['email']) ? $row['email'] : null?>">
                            </div>
                        </div>
                        <!-- Phone -->
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="" class="form-label fw-bold">No Telp</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" name="phone" id="" class="form-control"
                                    value="<?php echo isset($row['phone']) ? $row['phone'] : null?>">
                            </div>
                        </div>
                        <!-- Address -->
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="" class="form-label fw-bold">Alamat</label>
                            </div>
                            <div class="col-sm-6">
                                <textarea name="address" id="" class="form-control"><?php echo isset($row['address']) ? $row['address'] : null?>
                                </textarea>
                            </div>
                        </div>

                        <!-- Sosmed -->
                        <!-- Twitter -->
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="" class="form-label fw-bold">Twitter</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="url" name="twitter" id="" class="form-control"
                                    value="<?php echo isset($row['twitter']) ? $row['twitter'] : null?>">
                            </div>
                        </div>
                        <!-- LinkedIn -->
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="" class="form-label fw-bold">LinkedIn</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="url" name="linkedin" id="" class="form-control"
                                    value="<?php echo isset($row['linkedin']) ? $row['linkedin'] : null?>">
                            </div>
                        </div>
                        <!-- Facebook -->
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="" class="form-label fw-bold">Facebook</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="url" name="facebook" id="" class="form-control"
                                    value="<?php echo isset($row['facebook']) ? $row['facebook'] : null?>">
                            </div>
                        </div>
                        <!-- Instagram -->
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="" class="form-label fw-bold">Instagram</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="url" name="instagram" id="" class="form-control"
                                    value="<?php echo isset($row['instagram']) ? $row['instagram'] : null?>">
                            </div>
                        </div>
                        <!-- END Sosmed -->

                        <!-- Logo -->
                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                <label for="" class="form-label fw-bold">Logo</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="file" name="logo" id="" class="form-control">
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="mb-3 row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</section>