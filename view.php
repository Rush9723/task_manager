<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch task details by id
    $task = $conn->prepare("SELECT * FROM tasks WHERE id = :id");
    $task->execute(['id' => $id]);
    $task = $task->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Task not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* General Reset */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            background-color: #007BFF;
            color: #fff;
            width: 100%;
            padding: 20px 0;
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .task-detail {
            background-color: #fff;
            margin-top: 30px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .task-detail h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #007BFF;
        }

        .task-detail p {
            margin: 10px 0;
            font-size: 16px;
            line-height: 1.6;
        }

        .task-detail p strong {
            color: #555;
        }

        .btn-container {
            margin-top: 30px;
            display: flex;
            justify-content: space-evenly;
        }

        .btn-container a {
            text-decoration: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 8px;
            text-align: center;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-container a.update {
            background-color: #007BFF;
            color: #fff;
        }

        .btn-container a.update:hover {
            background-color: #0056b3;
        }

        .btn-container a.delete {
            background-color: #FF3B3B;
            color: #fff;
        }

        .btn-container a.delete:hover {
            background-color: #CC0000;
        }

        .btn-container a.back {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-container a.back:hover {
            background-color: #5a6268;
        }

        footer {
            margin-top: 260px;
            padding: 15px 0;
            width: 100%;
            text-align: center;
            background-color: #007BFF;
            color: white;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .task-detail {
                width: 90%;
            }

            .btn-container {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>

    <header>
        Task Details
    </header>

    <div class="task-detail">
        <h1><?= htmlspecialchars($task['title']) ?></h1>
        <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($task['description'])) ?></p>
        <p><strong>Created At:</strong> <?= $task['created_at'] ?></p>
        <p><strong>Last Updated:</strong> <?= $task['updated_at'] ?></p>

        <div class="btn-container">
            <a href="update.php?id=<?= $task['id'] ?>" class="update">Update</a>
            <a href="delete.php?id=<?= $task['id'] ?>" class="delete">Delete</a>
            <a href="index.php" class="back">< Back</a>
        </div>
    </div>

    <footer>
        © 2025 Task Manager | All Rights Reserved
    </footer>

</body>
</html>
