<?php
// --- Header CORS Lengkap untuk menangani POST request ---
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Hentikan eksekusi untuk preflight request (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}
// --- Akhir dari Header CORS ---

include 'koneksi.php';

// Pastikan 'id' ada di dalam POST request sebelum digunakan
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Menggunakan prepared statement untuk keamanan
    $stmt = $koneksi->prepare("DELETE FROM siswa WHERE id = ?");
    $stmt->bind_param("i", $id); // 'i' untuk integer

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
