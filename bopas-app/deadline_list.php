<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include 'db.php';
$user_id = $_SESSION['user']['id'];

$res = $conn->query("SELECT * FROM deadlines WHERE user_id=$user_id ORDER BY deadline_date ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Target Belajar</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h3>Daftar Target Belajar</h3>
    <a href="deadline_add.php" class="btn btn-primary mb-3">+ Tambah Target</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $res->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td><?= $row['deadline_date'] ?></td>
                    <td>
                        <?php if ($row['is_done']) {
                            echo "<span class='badge bg-success'>Selesai</span>";
                        } else {
                            echo "<span class='badge bg-warning text-dark'>Belum</span>";
                        } ?>
                    </td>
                    <td>
                        <?php if (!$row['is_done']) { ?>
                            <a href="deadline_done.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success">Tandai Selesai</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
