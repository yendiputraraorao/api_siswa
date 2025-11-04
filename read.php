<?php

// --- Header CORS Lengkap untuk menangani POST request ---
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

// Hentikan eksekusi untuk preflight request (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}
// --- Akhir dari Header CORS ---

include 'koneksi.php';

$sql = "SELECT * FROM siswa ORDER BY nama_lengkap ASC";
$result = $koneksi->query($sql);

$data = array();
if ($result && $result->num_rows > 0) { // Tambahkan pengecekan $result
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data); // Hanya ada satu echo di seluruh file ini

// echo "<script>
//     console.log(" . json_encode($data) . ");
// </script>";
// var_dump($data);
