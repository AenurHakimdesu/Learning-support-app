<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
$id = $_GET['id'];
$user_id = $_SESSION['user']['id'];

$conn->query("UPDATE deadlines SET is_done = TRUE WHERE id=$id AND user_id=$user_id");
header("Location: deadline_list.php");
