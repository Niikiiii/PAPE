<?php
$conn = new mysqli("localhost","root","","jk_informatica1");
if($conn->connect_error){
    die("connection failed : ".$con->connect_error);
    
}

function getUserEmail($username) {
    $conn = new mysqli('localhost', 'root', '', 'jk_informatica1');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT email FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    return $email;
}

?>