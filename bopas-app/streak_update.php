<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';
if (!isset($_SESSION['user'])) exit();

$user_id = $_SESSION['user']['id'];
$today = date('Y-m-d');

// Cek apakah sudah ada data streak
$res = $conn->query("SELECT * FROM user_streak WHERE user_id = $user_id");
if ($res->num_rows === 0) {
    // belum ada, buat baru
    $conn->query("INSERT INTO user_streak (user_id, last_activity) VALUES ($user_id, '$today')");
} else {
    $row = $res->fetch_assoc();
    $last_date = $row['last_activity'];
    $current = $row['current_streak'];
    $longest = $row['longest_streak'];

    $diff = (strtotime($today) - strtotime($last_date)) / (60 * 60 * 24);

    if ($diff == 1) {
        // streak berlanjut
        $current++;
        if ($current > $longest) $longest = $current;
    } else if ($diff > 1) {
        // streak putus
        $current = 1;
    }

    $stmt = $conn->prepare("UPDATE user_streak SET last_activity=?, current_streak=?, longest_streak=? WHERE user_id=?");
    $stmt->bind_param("siii", $today, $current, $longest, $user_id);
    $stmt->execute();
}
