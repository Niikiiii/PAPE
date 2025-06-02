<!-- filepath: c:\xampp\htdocs\xpto\gravar_reparacao.php -->
<?php
include_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEquipamento = $_POST['idEquipamento'];
    $dataEntrada = $_POST['dataEntrada'];
    $problema = $_POST['problema'];
    $orcamento = $_POST['orcamento'];
    $estado = $_POST['estado'];
    $observacoes = $_POST['observacoes'];

    $sql = "INSERT INTO reparacoes (idEquipamento, dataEntrada, problema, orcamento, estado, observacoes) 
            VALUES ('$idEquipamento', '$dataEntrada', '$problema', '$orcamento', '$estado', '$observacoes')";
    if ($conn->query($sql)) {
        header('Location: reparaçoes.php');
        exit;
    } else {
        echo "Erro ao gravar: " . $conn->error;
    }
}
?>