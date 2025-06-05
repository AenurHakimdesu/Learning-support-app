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
    <title>Pomodoro Timer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .timer-container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 30px;
            border-radius: 20px;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }
        .timer-display {
            font-size: 64px;
            font-weight: bold;
            margin: 20px 0;
        }
        .mode-label {
            font-size: 24px;
            font-weight: 600;
        }
        .btn-group {
            gap: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="timer-container">
        <h3 class="mb-3">🍅 Pomodoro Timer</h3>
        <p class="text-muted">Fokus 25 menit belajar, 5 menit istirahat</p>

        <div id="modeLabel" class="mode-label text-primary">⏳ Belajar</div>
        <div id="timerDisplay" class="timer-display">25:00</div>

        <div class="d-flex justify-content-center btn-group mt-3">
            <button id="startBtn" class="btn btn-success">Mulai</button>
            <button id="pauseBtn" class="btn btn-warning">Jeda</button>
            <button id="resetBtn" class="btn btn-danger">Reset</button>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="dashboard.php" class="btn btn-outline-secondary">⬅ Kembali ke Dashboard</a>
    </div>
</div>

<script>
    let mode = "focus"; // focus atau break
    let timeLeft = 25 * 60; // 25 menit
    let timerId = null;
    let isPaused = false;

    const modeLabel = document.getElementById("modeLabel");
    const timerDisplay = document.getElementById("timerDisplay");
    const startBtn = document.getElementById("startBtn");
    const pauseBtn = document.getElementById("pauseBtn");
    const resetBtn = document.getElementById("resetBtn");

    function updateDisplay() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }

    function switchMode() {
        if (mode === "focus") {
            mode = "break";
            timeLeft = 5 * 60;
            modeLabel.textContent = "🛋️ Istirahat";
            modeLabel.classList.replace("text-primary", "text-success");
        } else {
            mode = "focus";
            timeLeft = 25 * 60;
            modeLabel.textContent = "⏳ Belajar";
            modeLabel.classList.replace("text-success", "text-primary");
        }
        updateDisplay();
    }

    function startTimer() {
        if (timerId !== null) return;
        timerId = setInterval(() => {
            if (!isPaused) {
                if (timeLeft <= 0) {
                    clearInterval(timerId);
                    timerId = null;
                    alert(mode === "focus" ? "Sesi belajar selesai! Istirahat sebentar yuk!" : "Waktunya belajar lagi!");
                    switchMode();
                    startTimer();
                } else {
                    timeLeft--;
                    updateDisplay();
                }
            }
        }, 1000);
    }

    function pauseTimer() {
        isPaused = !isPaused;
        pauseBtn.textContent = isPaused ? "Lanjutkan" : "Jeda";
    }

    function resetTimer() {
        clearInterval(timerId);
        timerId = null;
        mode = "focus";
        timeLeft = 25 * 60;
        isPaused = false;
        pauseBtn.textContent = "Jeda";
        modeLabel.textContent = "⏳ Belajar";
        modeLabel.classList.remove("text-success");
        modeLabel.classList.add("text-primary");
        updateDisplay();
    }

    startBtn.onclick = startTimer;
    pauseBtn.onclick = pauseTimer;
    resetBtn.onclick = resetTimer;

    updateDisplay();
</script>

</body>
</html>
