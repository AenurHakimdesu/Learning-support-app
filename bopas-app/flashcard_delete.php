<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
$id = $_GET['id'];
$user_id = $_SESSION['user']['id'];

$conn->query("DELETE FROM flashcards WHERE id=$id AND user_id=$user_id");
header("Location: flashcard_list.php");
exit();
