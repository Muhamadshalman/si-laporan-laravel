<?php

$host = '127.0.0.1';
$user = 'root';        // sesuaikan
$pass = '';            // sesuaikan
$db   = 'dbnya'; // ganti nama DB kamu

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("❌ Koneksi gagal: " . $conn->connect_error);
}

echo "✅ Koneksi berhasil ke database: $db";
