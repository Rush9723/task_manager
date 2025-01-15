<?php
require 'db.php';
$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    if (!empty($title) && !empty($description)) {
        $stmt = $conn->prepare("INSERT INTO tasks (title, description) VALUES (:title, :description)");
        $stmt->execute(['title' => $title, 'description' => $description]);
        $success = 'Task created successfully!';
        header("Location: index.php"); // Redirect to the homepage
        exit; 
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
    <title>Create Task</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        .button-container {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin: 20px 0;
        }

        /* Back button grey color */
        .button-container a button {
            background-color: #6c757d; /* Grey color */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button-container a button:hover {
            background-color: #5a6268; /* Darker grey color on hover */
        }

        textarea {
            width: 100%;
            height: 150px; /* Adjust this value to increase or decrease height */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            resize: vertical; /* Allows the user to resize the textarea vertically */
        }
        
        .snackbar {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
            opacity: 0;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .snackbar.show {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>
<body>
    <h1>Create Task</h1>
    
    <?php if ($success): ?>
        <div id="snackbar" class="snackbar"><?= $success ?></div>
        <script>
            window.onload = function() {
                var snackbar = document.getElementById("snackbar");
                snackbar.className = "snackbar show";
                setTimeout(function() {
                    snackbar.className = snackbar.className.replace("show", "");
                }, 3000);
            };
        </script>
    <?php elseif ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
        
        <div class="button-container">
            <button type="submit">Create Task</button>
            <a href="index.php"><button type="button">< Back</button></a> <!-- Grey Back Button -->
        </div>
    </form>
</body>
</html>
