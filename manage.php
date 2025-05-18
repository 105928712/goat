<?php
session_start();
include 'settings.php';

// Create manager table if it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS managers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    failed_attempts INT DEFAULT 0,
    lockout_time DATETIME DEFAULT NULL
)");

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM managers WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $manager = $result->fetch_assoc();

    if ($manager) {
        $now = new DateTime();
        $lockout = new DateTime($manager['lockout_time']);
        $lockout->modify('+15 minutes'); // 15 minutes lockout period


        if ($manager['failed_attempts'] >= 3 && $now < $lockout) {
            die("Too many failed login attempts. Please try again later.");
        }

        if (password_verify($password, $manager['password'])) { // hashed password check
            $_SESSION['manager'] = $manager['username'];
            $conn->query("UPDATE managers SET failed_attempts = 0, lockout_time = NULL WHERE username = '$username'");

        } else {
            // increment failed attempts and lockout
            $conn->query("UPDATE managers SET failed_attempts = failed_attempts + 1, lockout_time = NOW() WHERE username = '$username'");
            die("Invalid credentials.");
        }
    } else {
        die("Invalid credentials.");
    }
}
?>