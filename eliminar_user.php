<?php

session_start();
require_once 'db.php';

// Only allow admins to delete users
if (!isset($_SESSION['user_email']) || $_SESSION['user_type'] !== 'Admin') {
    echo "<script>alert('Access denied! Only admins can perform this action.'); window.location.href = 'index.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idUser'])) {
    $idUser = intval($_POST['idUser']);

    // Prevent admin from deleting their own account (optional)
if ($_SESSION['user_id'] == $idUser) {
    echo "<script>alert('You cannot delete your own account!'); window.location.href = 'users.php';</script>";
    exit();
}

    $sql = "DELETE FROM users WHERE idUser = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUser);

    if ($stmt->execute()) {
        echo "<script>alert('User deleted successfully!'); window.location.href = 'users.php';</script>";
    } else {
        echo "<script>alert('Error deleting user.'); window.location.href = 'users.php';</script>";
    }
} else {
    header("Location: users.php");
    exit();
}
?>