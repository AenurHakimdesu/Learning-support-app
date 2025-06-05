<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include 'db.php';

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user']['id'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    $stmt = $conn->prepare("INSERT INTO flashcards (user_id, question, answer) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $question, $answer);
    $stmt->execute();
    header("Location: flashcard_list.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Flashcard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h3>Tambah Flashcard</h3>
    <form method="post">
        <div class="mb-3">
            <label>Pertanyaan</label>
            <textarea name="question" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Jawaban</label>
            <textarea name="answer" class="form-control" required></textarea>
        </div>
        <button class="btn btn-success" name="submit">Simpan</button>
        <a href="flashcard_list.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
