<?php
require 'db.php';

// Fetch all tasks
$tasks = $conn->query("SELECT * FROM tasks ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch the most recently created task
$recent_created = $conn->query("SELECT * FROM tasks ORDER BY created_at DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);

// Fetch the most recently updated task
$recent_updated = $conn->query("SELECT * FROM tasks ORDER BY updated_at DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General Layout */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        header {
            background-color: #007BFF;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 24px;
        }

        .tabs {
            display: flex;
            justify-content: center;
            background-color: #343a40;
            margin-top: 20px;
        }

        .tab {
            padding: 10px 20px;
            color: white;
            cursor: pointer;
            font-size: 18px;
            background-color: #495057;
            transition: background-color 0.3s;
        }

        .tab:hover {
            background-color: #007BFF;
        }

        .tab.active {
            background-color: #007BFF;
        }

        .tab-content {
            display: none;
            padding: 20px;
            background-color: white;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .tab-content.active {
            display: block;
        }

        .task {
            margin-bottom: 20px;
        }

        .task h3 {
            color: #007BFF;
        }

        .task p {
            color: #666;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        .create-task-btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #28a745;
            color: white;
            font-size: 18px;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .create-task-btn:hover {
            background-color: #218838;
        }

        /* Divider Styling */
        .divider {
            border: 0;
            height: 1px;
            background-color: #ddd;
            margin: 20px 0;
        }

        /* Container for Task Cards */
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
        }

        /* Individual Task Card */
        .card {
            background-color: #fff;
            padding: 20px;
            width: 280px;
            border-radius: 10px;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card h2 {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
        }

        .card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }

        .card a {
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 14px;
            color: #007BFF;
            text-decoration: none;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .card a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .card {
                width: 90%;
            }
        }

        /* Footer Styling */
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <header>
        Task Manager
    </header>

    <!-- Tab navigation -->
    <div class="tabs">
        <div class="tab active" id="dashboard-tab">Dashboard</div>
        <div class="tab" id="recent-created-tab">Recent Created</div>
        <div class="tab" id="recent-updated-tab">Recent Updated</div>
    </div>

    <!-- Tab Content -->
    <div id="dashboard-content" class="tab-content active">
        <h2>Dashboard</h2>
        <p>Welcome to the Task Manager dashboard! Here you can manage your tasks efficiently.</p>

        <!-- Create New Task Button (Moved Above All Tasks) -->
        <a href="create.php" class="create-task-btn">Create New Task</a>

        <!-- Divider below Create Task Button -->
        <hr class="divider">

        <!-- Display all tasks in Card Layout -->
        <h3>All Tasks</h3>
        <div class="container">
            <?php if ($tasks): ?>
                <?php foreach ($tasks as $task): ?>
                    <div class="card">
                        <h2><?= htmlspecialchars($task['title']) ?></h2>
                        <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($task['description'])) ?></p>
                        <a href="view.php?id=<?= $task['id'] ?>">View Task</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No tasks found.</p>
            <?php endif; ?>
        </div>
    </div>

    <div id="recent-created-content" class="tab-content">
        <h2>Recently Created Task</h2>

        <!-- Display Recently Created Task -->
        <?php if ($recent_created): ?>
            <div class="task">
                <h3>Title: <?= htmlspecialchars($recent_created['title']) ?></h3>
                <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($recent_created['description'])) ?></p>
                <a href="view.php?id=<?= $recent_created['id'] ?>">View Task</a>
            </div>
        <?php else: ?>
            <p>No recent tasks found.</p>
        <?php endif; ?>
    </div>

    <div id="recent-updated-content" class="tab-content">
        <h2>Recently Updated Task</h2>

        <!-- Display Recently Updated Task -->
        <?php if ($recent_updated): ?>
            <div class="task">
                <h3>Title: <?= htmlspecialchars($recent_updated['title']) ?></h3>
                <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($recent_updated['description'])) ?></p>
                <a href="view.php?id=<?= $recent_updated['id'] ?>">View Task</a>
            </div>
        <?php else: ?>
            <p>No recent updates found.</p>
        <?php endif; ?>
    </div>

    <script>
        // JavaScript to switch between tabs
        document.getElementById('dashboard-tab').addEventListener('click', function() {
            setActiveTab('dashboard');
        });

        document.getElementById('recent-created-tab').addEventListener('click', function() {
            setActiveTab('recent-created');
        });

        document.getElementById('recent-updated-tab').addEventListener('click', function() {
            setActiveTab('recent-updated');
        });

        function setActiveTab(tab) {
            // Remove active class from both tabs and content sections
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            
            // Add active class to the clicked tab and corresponding content
            document.getElementById(`${tab}-tab`).classList.add('active');
            document.getElementById(`${tab}-content`).classList.add('active');
        }
    </script>

    <!-- Footer Section -->
    <footer>
        &copy; 2025 Task Manager. All rights reserved.
    </footer>

</body>
</html>
