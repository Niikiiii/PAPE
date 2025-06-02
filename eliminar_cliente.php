<?php 
require_once "db.php";
if (isset($_POST["id"])){
    $e = $_POST["id"];

    // Delete related records in the pagamentos table
    $sql_pagamentos = "DELETE FROM pagamentos WHERE idReparacao IN (SELECT idReparacao FROM reparacoes WHERE idEquipamento IN (SELECT idEquipamento FROM equipamentos WHERE idCliente = $e))";
    if ($conn->query($sql_pagamentos) === TRUE) {
        // Delete related records in the historico_estado table
        $sql_historico_estado = "DELETE FROM historico_estado WHERE idReparacao IN (SELECT idReparacao FROM reparacoes WHERE idEquipamento IN (SELECT idEquipamento FROM equipamentos WHERE idCliente = $e))";
        if ($conn->query($sql_historico_estado) === TRUE) {
            // Delete related records in the reparacoes table
            $sql_reparacoes = "DELETE FROM reparacoes WHERE idEquipamento IN (SELECT idEquipamento FROM equipamentos WHERE idCliente = $e)";
            if ($conn->query($sql_reparacoes) === TRUE) {
                // Delete related records in the equipamentos table
                $sql_equipamentos = "DELETE FROM equipamentos WHERE idCliente = $e";
                if ($conn->query($sql_equipamentos) === TRUE) {
                    // Now delete the client
                    $sql_clientes = "DELETE FROM clientes WHERE idCliente = $e";
                    if ($conn->query($sql_clientes) === TRUE) {
                        echo "Record deleted successfully";
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }
                } else {
                    echo "Error deleting related records in equipamentos: " . $conn->error;
                }
            } else {
                echo "Error deleting related records in reparacoes: " . $conn->error;
            }
        } else {
            echo "Error deleting related records in historico_estado: " . $conn->error;
        }
    } else {
        echo "Error deleting related records in pagamentos: " . $conn->error;
    }

    $conn->close();
    header('Location: cliente.php');
    exit();
}
?>