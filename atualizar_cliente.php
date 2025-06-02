<?php
require_once "db.php";

if (isset($_POST['idCliente'])) {
    $id = $_POST['idCliente'];
    $nome = $_POST['nome'];
    $telemovel = $_POST['telemovel'];
    $email = $_POST['email'];
    $nif = $_POST['nif'];
    $morada = $_POST['morada'];

    $sql = "UPDATE clientes SET nome='$nome', telemovel='$telemovel', email='$email', nif='$nif', morada='$morada' WHERE idCliente=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
    header('Location: cliente.php');
    exit();
}
?>