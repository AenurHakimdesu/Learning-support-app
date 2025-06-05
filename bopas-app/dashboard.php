<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Bopas App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .card .bi {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">BopasApp</a>
        <div class="ms-auto">
            <span class="text-white me-3">Hai, <?= htmlspecialchars($user['name']) ?></span>
            <a href="logout.php" class="btn btn-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<!-- Konten -->
<div class="container mt-4">
    <h3 class="mb-4">📚 Dashboard Belajar</h3>

    <div class="row g-4">
        <!-- Deadline -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column">
                    <i class="bi bi-calendar2-check text-primary"></i>
                    <h5 class="card-title">Set Deadline</h5>
                    <p class="card-text flex-grow-1">Atur target waktu belajar kamu agar tetap konsisten.</p>
                    <a href="deadline_list.php" class="btn btn-primary mt-auto">Buka</a>
                </div>
            </div>
        </div>

        <!-- Streak -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column">
                    <i class="bi bi-fire text-danger"></i>
                    <h5 class="card-title">Streak Days</h5>
                    <p class="card-text flex-grow-1">Jaga semangat dengan tantangan belajar harian.</p>
                    <a href="streak.php" class="btn btn-danger mt-auto">Buka</a>
                </div>
            </div>
        </div>

        <!-- Flashcards -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column">
                    <i class="bi bi-lightbulb text-success"></i>
                    <h5 class="card-title">Flash Cards</h5>
                    <p class="card-text flex-grow-1">Latihan hafalan konsep & fakta penting setiap hari.</p>
                    <a href="flashcard_list.php" class="btn btn-success mt-auto">Mulai</a>
                </div>
            </div>
        </div>

        <!-- Kalender -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column">
                    <i class="bi bi-calendar-event text-info"></i>
                    <h5 class="card-title">Kalender</h5>
                    <p class="card-text flex-grow-1">Lihat rencana belajar dan progres mingguan kamu.</p>
                    <a href="calendar.php" class="btn btn-info mt-auto text-white">Lihat</a>
                </div>
            </div>
        </div>

        <!-- Report -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column">
                    <i class="bi bi-bar-chart-line text-warning"></i>
                    <h5 class="card-title">Report</h5>
                    <p class="card-text flex-grow-1">Pantau performa dan hasil belajar kamu secara visual.</p>
                    <a href="progress.php" class="btn btn-warning mt-auto text-white">Lihat</a>
                </div>
            </div>
        </div>

        <!-- Pomodoro -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column">
                    <i class="bi bi-alarm-fill text-secondary"></i>
                    <h5 class="card-title">Pomodoro</h5>
                    <p class="card-text flex-grow-1">Fokus belajar dengan teknik 25 menit belajar, 5 menit istirahat.</p>
                    <a href="pomodoro.php" class="btn btn-secondary mt-auto">Mulai</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
