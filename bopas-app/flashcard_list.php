<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include 'db.php';
$user_id = $_SESSION['user']['id'];

$result = $conn->query("SELECT * FROM flashcards WHERE user_id = $user_id ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Latihan Flashcards</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .card:hover { background: #f8f9fa; cursor: pointer; }
    </style>
</head>
<body class="container mt-5">
    <h3>Latihan Flashcards</h3>
    <a href="flashcard_add.php" class="btn btn-primary mb-3">+ Tambah Flashcard</a>
    <div class="row row-cols-1 row-cols-md-2 g-3">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="col">
                <div class="card p-3 shadow-sm">
                    <h5>Pertanyaan:</h5>
                    <p><?= htmlspecialchars($row['question']) ?></p>
                    <h6 class="text-muted">Jawaban:</h6>
                    <p><strong><?= htmlspecialchars($row['answer']) ?></strong></p>
                    <a href="flashcard_delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>
<?php include 'streak_update.php'; ?>