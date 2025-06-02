<?php
require_once "db.php";

if (isset($_POST['submit'])) {
    $cliente = $_POST["cliente"];
    $tipo = $_POST["tipo"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $numeroSerie = $_POST["numeroSerie"];
    $estado = 'em analise'; // Default state

    // Assuming 'cliente' is the ID of the client in the 'Clientes' table
    $sql = "INSERT INTO Equipamentos (idCliente, tipo, marca, modelo, numeroSerie, estado) VALUES ('$cliente', '$tipo', '$marca', '$modelo', '$numeroSerie', '$estado')";

    if ($conn->query($sql) === TRUE) {
        echo "Registo inserido com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }

    $conn->close();
    header("Location: tables.php");
    exit();
}
?>