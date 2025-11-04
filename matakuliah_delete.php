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

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $koneksi->prepare("DELETE FROM matakuliah WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'sukses', 'message' => 'Data berhasil dihapus']);
    } else {
        echo json_encode(['status' => 'gagal', 'message' => 'Error: ' . $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'gagal', 'message' => 'ID tidak ditemukan.']);
}

$koneksi->close();
