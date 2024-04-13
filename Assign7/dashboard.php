<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

echo "<h1>Welcome to Dashboard</h1>";
echo "<p>You are logged in as " . htmlspecialchars($_SESSION['user_id']) . "</p>";
echo '<a href="logout.php">Logout</a>';
