<?php
require 'db.php';
$id = $_GET['id'];
$task = $conn->query("SELECT * FROM tasks WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
$success = $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    if (!empty($title) && !empty($description)) {
        $stmt = $conn->prepare("UPDATE tasks SET title = :title, description = :description WHERE id = :id");
        $stmt->execute(['title' => $title, 'description' => $description, 'id' => $id]);
        $success = 'Task updated successfully!';
        
        // Redirect to view.php after success
        header("Location: view.php?id=$id");
        exit(); // Make sure no further code is executed after redirection
    } else {
        $error = 'Please fill out all fields.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Task</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #007BFF;
            margin-top: 20px;
        }

        .container {
            background: #fff;
            padding: 30px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 500px;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #6c757d; /* Grey color */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #5a6268; /* Darker grey on hover */
        }

        form label {
            display: block;
            margin: 10px 0 5px;
            font-weight: 700;
        }

        form input, form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #0056b3;
        }
        form textarea {
            height: 200px;  /* Increased height for the description textarea */
        }
        .success, .error {
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            color: #fff;
            font-weight: 700;
        }

        .success {
            background-color: #28a745;
        }

        .error {
            background-color: #dc3545;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <h1>Update Task</h1>
    <div class="container">
        <?php if ($success): ?>
            <div class="success"><?= $success ?></div>
        <?php elseif ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?= htmlspecialchars($task['title']) ?>" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required><?= htmlspecialchars($task['description']) ?></textarea>

            <button type="submit">Update Task</button>
            <a href="view.php?id=<?= $task['id'] ?>" class="back-btn">&lt; Back</a> <!-- Grey Back Button -->

        </form>

    </div>
</body>
</html>
