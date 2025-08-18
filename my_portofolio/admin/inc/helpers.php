<?php
// ---- Fungsi Upload Gambar (tanpa ekstensi) ----
function uploadImage($file, $oldFile = '') {
    $uploadPath = 'uploads/';
    if (!is_dir($uploadPath)) mkdir($uploadPath);

    if (!empty($file['name'])) {
        $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExt)) {
            return $oldFile; // Jika bukan gambar valid, return file lama
        }

        // Buat nama baru tanpa ekstensi
        $newName = md5($file['name'] . time());

        $target = $uploadPath . $newName; // Simpan TANPA ekstensi

        if (move_uploaded_file($file['tmp_name'], $target)) {
            // Hapus file lama kalau ada
            if (!empty($oldFile) && file_exists($uploadPath . $oldFile)) {
                unlink($uploadPath . $oldFile);
            }
            return $newName; // return nama tanpa ekstensi
        }
    }
    return $oldFile;
}


// ---- Fungsi Upload CV (PDF) ----
function uploadFilePDF($file, $oldFile = '') {
    $uploadPath = 'uploads/cv/';
    if (!is_dir($uploadPath)) mkdir($uploadPath);

    if (!empty($file['name'])) {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if ($ext !== 'pdf') {
            return $oldFile; // Hanya izinkan PDF
        }

        $newName = md5($file['name'] . time()) . ".pdf";
        $target = $uploadPath . $newName;

        if (move_uploaded_file($file['tmp_name'], $target)) {
            if (!empty($oldFile) && file_exists($uploadPath . $oldFile)) {
                unlink($uploadPath . $oldFile);
            }
            return $newName;
        }
    }
    return $oldFile;
}
