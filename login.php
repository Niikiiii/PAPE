<?php
// Include database connection file
require_once 'db.php';

// Start session
session_start();

// Check if a user is already logged in
if (isset($_SESSION['user_email'])) {
    echo "<script>alert('Already logged in!'); window.location.href = 'index.php';</script>";
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL query to fetch user data
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Debugging: print the passwords
        error_log("Entered password: " . $password);
        error_log("Stored password: " . $user['password']);
        // Directly compare passwords
        if ($password === $user['password']) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
             $_SESSION['user_type'] = $user['tipoUtilizador']; // Store user type
            // Redirect to dashboard or home page
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with this email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/c.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
    <body class="bg-dark bg-gradient" style="background: linear-gradient(135deg, #444 0%, #bbb 100%);">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <?php if (isset($error)): ?>
                                            <div class="alert alert-danger"><?php echo $error; ?></div>
                                        <?php endif; ?>
                                        <form action="login.php" method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" style="border-width:2px;" id="inputEmail" name="email" type="email" placeholder="name@example.com" required />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" style="border-width:2px;" id="inputPassword" name="password" type="password" placeholder="Password" required />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                                <button class="btn btn-primary" type="submit" style="background: linear-gradient(135deg, #444 0%, #bbb 100%); border: none; color: #fff;">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
