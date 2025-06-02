<?php
require_once "db.php";

if (isset($_POST['idPagamento'])) {
    $idPagamento = $_POST['idPagamento'];
    $idReparacao = $_POST['idReparacao'];
    $dataPagamento = $_POST['dataPagamento'];
    $valorPago = $_POST['valorPago'];
    $metodoPagamento = $_POST['metodoPagamento'];
    $detalhes = $_POST['detalhes'];

    $sql = "UPDATE pagamentos 
            SET idReparacao = '$idReparacao', dataPagamento = '$dataPagamento', valorPago = '$valorPago', metodoPagamento = '$metodoPagamento', detalhes = '$detalhes'
            WHERE idPagamento = '$idPagamento'";

    if ($conn->query($sql) === TRUE) {
        echo "Orçamento atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o orçamento: " . $conn->error;
    }

    $conn->close();
    header("Location: orçamento.php");
    exit();
} else {
    echo "Requisição inválida.";
    exit();
}
?>
