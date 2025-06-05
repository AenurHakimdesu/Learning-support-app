<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
$user_id = $_SESSION['user']['id'];
$res = $conn->query("SELECT * FROM user_streak WHERE user_id = $user_id");
$row = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Streak Belajar</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h3>🔥 Streak Latihan Harian</h3>
    <?php if ($row): ?>
        <div class="alert alert-info">
            <strong>Hari ini:</strong> <?= date('Y-m-d') ?><br>
            <strong>Terakhir aktif:</strong> <?= $row['last_activity'] ?><br>
            <strong>Streak saat ini:</strong> <?= $row['current_streak'] ?> hari<br>
            <strong>Streak terpanjang:</strong> <?= $row['longest_streak'] ?> hari
        </div>
    <?php else: ?>
        <p>Belum ada data streak. Mulailah latihan hari ini!</p>
    <?php endif; ?>
    <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
</body>
</html>
