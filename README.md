Task Manager

Task Manager is a simple PHP and MySQL-based web application that allows users to manage tasks. It supports the basic CRUD operations: Create, Read, Update, and Delete tasks.

Features

Add new tasks with a title and description.

View a list of all tasks.

Edit task details.

Delete tasks.

Prerequisites

To run this project, you need:

A local server environment such as:

XAMPP

WAMP

MAMP

Laragon

PHP (7.4 or higher recommended).

MySQL database.

A web browser.

Installation

Step 1: Clone the Repository

Clone this repository to your local machine:

git clone https://github.com/yourusername/task_manager.git
cd task_manager

Step 2: Set Up the Database

Open your MySQL interface (phpMyAdmin, CLI, etc.).

Create a new database named task_manager:

CREATE DATABASE task_manager;

Create the tasks table:

USE task_manager;

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL
);

Step 3: Configure the Database Connection

Open the db.php file in the project.

Update the database credentials:

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'task_manager';

Step 4: Start the Server

Place the project folder in your local server's root directory:

For XAMPP: C:/xampp/htdocs/task_manager

For WAMP: C:/wamp/www/task_manager

For MAMP: /Applications/MAMP/htdocs/task_manager

Start your local server (Apache and MySQL).

Open a browser and navigate to:

http://localhost/task_manager

Usage

Open the application in your browser.

Add new tasks using the "Add New Task" link.

Edit or delete existing tasks from the task list.

Contributing

If you'd like to contribute, please fork the repository and submit a pull request.

License

This project is open-source and available under the MIT License.
