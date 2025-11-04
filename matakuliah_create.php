<?php
// --- Header CORS Lengkap ---
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}
// --- Akhir Header CORS ---

include 'koneksi.php';

if (isset($_POST['kode_mk']) && isset($_POST['nama_mk']) && isset($_POST['sks']) && isset($_POST['dosen_pengampu'])) {

    $kode_mk = $_POST['kode_mk'];
    $nama_mk = $_POST['nama_mk'];
    $sks = $_POST['sks'];
    $dosen_pengampu = $_POST['dosen_pengampu'];

    $stmt = $koneksi->prepare("INSERT INTO matakuliah (kode_mk, nama_mk, sks, dosen_pengampu) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $kode_mk, $nama_mk, $sks, $dosen_pengampu); // 's' for string, 'i' for integer

    if ($stmt->execute()) {
        echo json_encode(['status' => 'sukses', 'message' => 'Data berhasil ditambahkan']);
    } else {
        echo json_encode(['status' => 'gagal', 'message' => 'Error: ' . $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'gagal', 'message' => 'Data tidak lengkap.']);
}

$koneksi->close();
