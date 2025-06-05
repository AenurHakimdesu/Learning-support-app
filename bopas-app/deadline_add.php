<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include 'db.php';

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user']['id'];
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $date = $_POST['deadline_date'];

    $stmt = $conn->prepare("INSERT INTO deadlines (user_id, title, description, deadline_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $title, $desc, $date);
    $stmt->execute();
    header("Location: deadline_list.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Deadline</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h3>Tambah Target Belajar</h3>
    <form method="post">
        <div class="mb-2">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-2">
            <label>Tanggal Deadline</label>
            <input type="date" name="deadline_date" class="form-control" required>
        </div>
        <button class="btn btn-success" name="submit">Simpan</button>
        <a href="deadline_list.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
