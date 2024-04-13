<?php
session_start();
session_unset(); // Remove session data
session_destroy(); // Destroy the session
setcookie(session_name(), '', time() - 42000); // Destroy the session cookie
header('Location: login.php');
exit();
