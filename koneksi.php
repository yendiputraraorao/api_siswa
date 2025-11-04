<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // Sesuaikan jika database MySQL Anda memiliki kata sandi$db   = 'db_akademik';
$db = 'db_akademik';
$koneksi = new mysqli($host, $user, $pass, $db);
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
