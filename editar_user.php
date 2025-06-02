<?php


session_start();
require_once 'db.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_email']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: users.php");
    exit();
}

// Fetch user details
$sql = "SELECT * FROM users WHERE idUser = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $nomeCompleto = $_POST['nomeCompleto'];
    $email = $_POST['email'];
    $tipoUtilizador = $_POST['tipoUtilizador'];

    $sql = "UPDATE users SET username = ?, nomeCompleto = ?, email = ?, tipoUtilizador = ? WHERE idUser = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $username, $nomeCompleto, $email, $tipoUtilizador, $id);

    if ($stmt->execute()) {
        header("Location: users.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit User</h1>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="nomeCompleto" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" value="<?= htmlspecialchars($user['nomeCompleto']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="tipoUtilizador" class="form-label">User Type</label>
                <select class="form-control" id="tipoUtilizador" name="tipoUtilizador" required>
                    <option value="Admin" <?= $user['tipoUtilizador'] === 'Admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="Tecnico" <?= $user['tipoUtilizador'] === 'Tecnico' ? 'selected' : ''; ?>>Tecnico</option>
                    <option value="Rececionista" <?= $user['tipoUtilizador'] === 'Rececionista' ? 'selected' : ''; ?>>Rececionista</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="users.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>