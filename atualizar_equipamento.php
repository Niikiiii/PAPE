<?php
require_once "db.php";

if (isset($_POST['idEquipamento'])) {
    $idEquipamento = $_POST['idEquipamento'];
    $cliente = $_POST['cliente'];
    $tipo = $_POST['tipo'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $numeroSerie = $_POST['numeroSerie'];
    $estado = $_POST['estado'];

    // Update the Equipamentos table with the new values
    $sql = "UPDATE Equipamentos 
            SET tipo = '$tipo', marca = '$marca', modelo = '$modelo', numeroSerie = '$numeroSerie', estado = '$estado'
            WHERE idEquipamento = '$idEquipamento'";

    if ($conn->query($sql) === TRUE) {
        echo "Registo atualizado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }

    $conn->close();
    header("Location: tables.php");
    exit();
} else {
    echo "Invalid request.";
    exit();
}
?>