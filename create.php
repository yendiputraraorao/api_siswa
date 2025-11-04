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

// Pastikan semua data POST ada sebelum digunakan
if (isset($_POST['nis']) && isset($_POST['nama_lengkap']) && isset($_POST['jurusan']) && isset($_POST['alamat'])) {

    $nis = $_POST['nis'];
    $nama = $_POST['nama_lengkap'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];

    // Menggunakan prepared statement untuk keamanan dari SQL Injection
    $stmt = $koneksi->prepare("INSERT INTO siswa (nis, nama_lengkap, jurusan, alamat) VALUES (?, ?, ?, ?)");
    // 'ssss' berarti semua variabel adalah string
    $stmt->bind_param("ssss", $nis, $nama, $jurusan, $alamat);

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
