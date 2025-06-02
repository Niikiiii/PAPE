<?php

session_start();
include_once 'db.php';

if (
    !isset($_SESSION['user_type']) ||
    ($_SESSION['user_type'] !== 'Admin' && $_SESSION['user_type'] !== 'Rececionista')
) {
    echo "You do not have permission to eliminate repairs.<br>Only <strong>Admin</strong> or <strong>Rececionista</strong> users can perform this action.";
    exit();
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // First, delete from historico_estado
    $sql1 = "DELETE FROM historico_estado WHERE idReparacao = '$id'";
    $conn->query($sql1);

    // Then, delete from pagamentos
    $sql2 = "DELETE FROM pagamentos WHERE idReparacao = '$id'";
    $conn->query($sql2);

    // Then, delete from reparacoes
    $sql3 = "DELETE FROM reparacoes WHERE idReparacao = '$id'";
    if ($conn->query($sql3)) {
        echo "Reparação eliminada com sucesso!";
    } else {
        echo "Erro ao eliminar: " . $conn->error;
    }
} else {
    echo "ID inválido.";
}
?>