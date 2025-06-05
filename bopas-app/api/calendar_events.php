<?php
session_start();
header('Content-Type: application/json');
include '../db.php';

if (!isset($_SESSION['user'])) {
    echo json_encode([]);
    exit();
}

$user_id = $_SESSION['user']['id'];
$events = [];

// Deadline events
$deadline_query = $conn->query("SELECT title, deadline_date, is_done FROM deadlines WHERE user_id = $user_id");
while ($row = $deadline_query->fetch_assoc()) {
    $events[] = [
        'title' => ($row['is_done'] ? '✅ ' : '⏳ ') . $row['title'],
        'start' => $row['deadline_date'],
        'color' => $row['is_done'] ? '#198754' : '#ffc107'
    ];
}

// Flashcard latihan (berdasarkan tanggal dibuat)
$flash_query = $conn->query("SELECT created_at FROM flashcards WHERE user_id = $user_id LIMIT 30");
while ($row = $flash_query->fetch_assoc()) {
    $events[] = [
        'title' => 'Latihan Flashcard',
        'start' => substr($row['created_at'], 0, 10),
        'color' => '#0d6efd'
    ];
}

echo json_encode($events);
