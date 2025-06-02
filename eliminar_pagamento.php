<?php
session_start();
require_once "db.php";
if (
    !isset($_SESSION['user_type']) ||
    ($_SESSION['user_type'] !== 'Admin' && $_SESSION['user_type'] !== 'Rececionista')
) {
    echo "You do not have permission to eliminate payments.<br>Only <strong>Admin</strong> or <strong>Rececionista</strong> users can perform this action.";
    exit();
}

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $sql = "DELETE FROM pagamentos WHERE idPagamento = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Orçamento eliminado com sucesso!";
    } else {
        echo "Erro ao eliminar o orçamento: " . $conn->error;
    }
} else {
    echo "ID inválido.";
}
?>
