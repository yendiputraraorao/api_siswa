<?php
header("Access-Control-Allow-Origin: *");
include 'koneksi.php';
$id = $_POST['id'];
$nis = $_POST['nis'];
$nama = $_POST['nama_lengkap'];
$jurusan = $_POST['jurusan'];
$alamat = $_POST['alamat'];
$sql = "UPDATE siswa SET nis='$nis', nama_lengkap='$nama', jurusan='$jurusan', alamat='$alamat' WHERE id=$id";
if ($koneksi->query($sql) === TRUE) {
    echo json_encode(['status' => 'sukses', 'message' => 'Data berhasil diubah']);
} else {
    echo json_encode(['status' => 'gagal', 'message' => 'Error: ' . $koneksi->error]);
}
