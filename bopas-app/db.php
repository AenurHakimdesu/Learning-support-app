<?php
$host = 'localhost';
$user = 'root'; // ganti sesuai konfigurasi
$pass = '';     // ganti sesuai konfigurasi
$dbname = 'bopas_app';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
