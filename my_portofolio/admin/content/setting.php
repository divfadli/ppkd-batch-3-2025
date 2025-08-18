<?php 
// ---- Ambil data setting ----
$querySetting = mysqli_query($koneksi, "SELECT * FROM settings LIMIT 1");
$row = mysqli_fetch_assoc($querySetting);

// ---- Default country code ----
$selectedCode = '62'; // Indonesia default

// ---- Ambil country code dan flag dari file JSON ----
$countryData = [];
$jsonPath = 'data/countries.json';

if (file_exists($jsonPath)) {
    $jsonData = file_get_contents($jsonPath);
    $countries = json_decode($jsonData, true);

    if (is_array($countries)) {
        foreach ($countries as $country) {
            $name = $country['name']['common'] ?? '';
            $idd = $country['idd'] ?? null;
            $flag = $country['flags']['png'] ?? '';

            if ($idd && !empty($idd['root'])) {
                $root = preg_replace('/\D/', '', $idd['root']); 
                $suffixes = $idd['suffixes'] ?? [''];

                foreach ($suffixes as $suffix) {
                    $suffix = preg_replace('/\D/', '', $suffix);
                    $code = $root . $suffix;
                    if ($code !== '') {
                        $countryData[$code] = [
                            'name' => $name,
                            'flag' => $flag,
                            'label' => "$name (+$code)"
                        ];
                    }
                }
            }
        }
        ksort($countryData);
    }
}

// ---- Set selected code dan nomor telepon dari DB jika ada ----
$phoneOnly = '';
if (!empty($row['phone']) && preg_match('/^\+?(\d+)/', $row['phone'], $matches)) {
    $fullNumber = $matches[1]; 
    $selectedCode = '';
    foreach ($countryData as $code => $c) {
        if (strpos($fullNumber, $code) === 0) {
            $selectedCode = $code;
            $phoneOnly = substr($fullNumber, strlen($code));
            break;
        }
    }
    if ($selectedCode === '') {
        $selectedCode = substr($fullNumber, 0, 2);
        $phoneOnly = substr($fullNumber, 2);
    }
}

include 'inc/helpers.php';

// ---- Proses simpan ----
if (isset($_POST['simpan'])) {
    $email        = $_POST['email'] ?? '';
    $country_code = $_POST['country_code'] ?? '62';
    $phoneNumber  = $_POST['phone'] ?? '';
    $address      = $_POST['address'] ?? '';
    $twitter      = $_POST['twitter'] ?? '';
    $linkedin     = $_POST['linkedin'] ?? '';
    $github       = $_POST['github'] ?? '';
    $instagram    = $_POST['instagram'] ?? '';

    $phone = "+" . $country_code . $phoneNumber;
    $logo_name = uploadImage($_FILES['logo'], $row['logo'] ?? '');

    if ($row) {
        $id_setting = $row['id'];
        $update = mysqli_query($koneksi, "UPDATE settings SET
            email='$email', phone='$phone', address='$address', twitter='$twitter', linkedin='$linkedin', github='$github', instagram='$instagram', logo='$logo_name' WHERE id='$id_setting'");
        if($update){
            header("location:?page=setting&ubah=berhasil");
            exit;
        }
    } else {
       $insert = mysqli_query($koneksi, "INSERT INTO settings (email, phone, address, twitter, linkedin, github, instagram, logo) VALUES ('$email', '$phone', '$address', '$twitter', '$linkedin', '$facebok', '$instagram', '$logo_name')");
        if($insert){
            header("location:?page=setting&tambah=berhasil");
            exit;
        }
    }
}
?>

<div class="pagetitle">
    <h1>Pengaturan</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pengaturan</h5>

                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- Email -->
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label fw-bold">Email</label>
                            <div class="col-sm-6">
                                <input type="email" name="email" class="form-control" value="<?= $row['email'] ?? '' ?>">
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label fw-bold">No Telp</label>
                            <div class="col-sm-6 d-flex">
                                <select id="countrySelect" name="country_code" class="form-select me-2">
                                    <?php foreach ($countryData as $code => $c): ?>
                                        <option value="<?= $code ?>" <?= ($code == $selectedCode) ? 'selected' : '' ?>
                                            data-flag="<?= $c['flag'] ?>">
                                            <?= $c['label'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <input type="text" name="phone" class="form-control" placeholder="8123456789"
                                    value="<?= htmlspecialchars($phoneOnly) ?>">
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label fw-bold">Alamat</label>
                            <div class="col-sm-6">
                                <textarea name="address" class="form-control"><?= $row['address'] ?? '' ?></textarea>
                            </div>
                        </div>

                        <!-- Sosmed -->
                        <?php
                        $socials = ['twitter', 'linkedin', 'github', 'instagram'];
                        foreach ($socials as $social):
                        ?>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label fw-bold"><?= ucfirst($social) ?></label>
                            <div class="col-sm-6">
                                <input type="url" name="<?= $social ?>" class="form-control" value="<?= $row[$social] ?? '' ?>">
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <!-- Logo -->
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label fw-bold">Logo</label>
                            <div class="col-sm-6">
                                <input type="file" name="logo" class="form-control">
                                <?php if (!empty($row['logo'])): ?>
                                    <img class="mt-3" src="uploads/<?= $row['logo'] ?>" alt="Logo" width="250">
                                <?php endif; ?>
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

<!-- TomSelect -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script>
new TomSelect("#countrySelect", {
    render: {
        option: function(item, escape) {
            const flag = escape(item.$option.dataset.flag);
            return `<div style="display:flex;align-items:center;">
                        <img src="${flag}" style="width:20px;height:15px;margin-right:5px;">
                        ${escape(item.text)}
                    </div>`;
        },
        item: function(item, escape) {
            const flag = escape(item.$option.dataset.flag);
            return `<div style="display:flex;align-items:center;">
                        <img src="${flag}" style="width:20px;height:15px;margin-right:5px;">
                        ${escape(item.text)}
                    </div>`;
        }
    },
    searchField: ['text'],
    maxItems: 1,
    dropdownParent: 'body', // biar dropdown tidak terpotong
});
</script>
