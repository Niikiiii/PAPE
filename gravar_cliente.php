<?php
require_once "db.php";

if (isset($_POST['submit'])) {
    $nome = $_POST["nome"];
    $telemovel = $_POST["telemovel"];
    $email = $_POST["email"];
    $nif = $_POST["nif"];
    $morada = $_POST["morada"];

    $sql = "INSERT INTO clientes (nome, telemovel, email, nif, morada) VALUES ('$nome', '$telemovel', '$email', '$nif', '$morada')";

    if ($conn->query($sql) === TRUE) {
        echo "Registo inserido com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }

    $conn->close();
    header("Location: cliente.php");
    exit();
}
?>