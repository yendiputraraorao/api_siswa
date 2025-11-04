<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include 'koneksi.php';

$sql = "SELECT * FROM matakuliah ORDER BY nama_mk ASC";
$result = $koneksi->query($sql);

$data = array();
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Mengubah tipe data 'sks' menjadi integer
        $row['sks'] = (int)$row['sks'];
        $data[] = $row;
    }
}

echo json_encode($data);
$koneksi->close();
