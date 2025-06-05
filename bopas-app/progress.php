<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include 'db.php';
$user_id = $_SESSION['user']['id'];

// Total kartu
$res1 = $conn->query("SELECT COUNT(*) as total FROM flashcards WHERE user_id = $user_id");
$flashcards_total = $res1->fetch_assoc()['total'];

// Total deadline
$res2 = $conn->query("SELECT 
    COUNT(*) as total, 
    SUM(CASE WHEN is_done = 1 THEN 1 ELSE 0 END) as selesai 
    FROM deadlines WHERE user_id = $user_id");
$data_deadline = $res2->fetch_assoc();

// Latihan flashcard terbaru
$res3 = $conn->query("SELECT COUNT(*) as total, DATE(created_at) as date FROM flashcards 
    WHERE user_id = $user_id 
    GROUP BY DATE(created_at) 
    ORDER BY date DESC LIMIT 7");

$latihan_harian = [];
while ($row = $res3->fetch_assoc()) {
    $latihan_harian[] = $row;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Progres</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="container mt-5">
    <h3>📊 Laporan Progres Belajar</h3>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Flashcards</h5>
                    <p class="card-text fs-4"><?= $flashcards_total ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Target Tercapai</h5>
                    <p class="card-text fs-4"><?= $data_deadline['selesai'] ?> / <?= $data_deadline['total'] ?></p>
                </div>
            </div>
        </div>
    </div>

    <h5 class="mt-4">📅 Aktivitas Latihan 7 Hari Terakhir</h5>
    <canvas id="latihanChart" height="100"></canvas>

    <script>
        const ctx = document.getElementById('latihanChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?= implode(", ", array_map(fn($d) => "'".date('d M', strtotime($d['date']))."'", $latihan_harian)) ?>],
                datasets: [{
                    label: 'Jumlah Latihan',
                    data: [<?= implode(", ", array_map(fn($d) => $d['total'], $latihan_harian)) ?>],
                    backgroundColor: 'rgba(13, 110, 253, 0.8)'
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>

    <a href="dashboard.php" class="btn btn-secondary mt-4">⬅ Kembali ke Dashboard</a>
</body>
</html>
