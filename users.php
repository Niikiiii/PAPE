<?php

session_start();
require_once 'db.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_email']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: index.php");
    exit();
}

// Fetch all users from the database
$sql = "SELECT idUser, username, nomeCompleto, email, tipoUtilizador FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/c.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <?php include('topnav.php'); ?>
    <div id="layoutSidenav">
        <?php include('sidenav.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container mt-5">
                    <h1 class="text-center">User Management</h1>
                    <table class="table table-bordered table-striped mt-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['idUser']); ?></td>
                                        <td><?= htmlspecialchars($row['username']); ?></td>
                                        <td><?= htmlspecialchars($row['nomeCompleto']); ?></td>
                                        <td><?= htmlspecialchars($row['email']); ?></td>
                                        <td><?= htmlspecialchars($row['tipoUtilizador']); ?></td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="editar_user.php?id=<?= $row['idUser']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <!-- Delete Button -->
                                            <form action="eliminar_user.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="idUser" value="<?= $row['idUser']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No users found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
</body>
</html>