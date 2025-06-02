<?php
include_once 'db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEquipamento = $_POST['idEquipamento'];
    $dataEntrada = $_POST['dataEntrada'];
    $dataPrevisao = $_POST['dataPrevisao'];
    $problema = $_POST['problema'];
    $orcamento = $_POST['orcamento'];
    $observacoes = $_POST['observacoes'];

$sql = "UPDATE reparacoes 
        SET idEquipamento = '$idEquipamento', dataEntrada = '$dataEntrada', dataPrevisao = '$dataPrevisao', problema = '$problema', 
            orcamento = '$orcamento', observacoes = '$observacoes' 
        WHERE idReparacao = '$id'";
    if ($conn->query($sql)) {
        header('Location: reparaçoes.php');
        exit;
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}

$sql = "SELECT * FROM reparacoes WHERE idReparacao = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reparação</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Assuming you have a styles.css file -->
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body>
    <main class="main-content" style="flex: 1; padding: 20px;">
        <div class="main-title">
            <h1 class="font-weight-bold">Editar Reparação</h1>
        </div>
        <form action="" method="POST" style="max-width: 600px; margin: auto;">
            <input type="hidden" name="idReparacao" value="<?= $row['idReparacao']; ?>">
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="idEquipamento" style="display: block; margin-bottom: 5px;">Equipamento</label>
                <input type="text" id="idEquipamento" name="idEquipamento" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" value="<?= $row['idEquipamento']; ?>" required>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="dataEntrada" style="display: block; margin-bottom: 5px;">Data Entrada</label>
                <input type="date" id="dataEntrada" name="dataEntrada" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" value="<?= $row['dataEntrada']; ?>" required>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="dataPrevisao" style="display: block; margin-bottom: 5px;">Data Previsão</label>
                <input type="date" id="dataPrevisao" name="dataPrevisao" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" value="<?= $row['dataPrevisao']; ?>">
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="problema" style="display: block; margin-bottom: 5px;">Problema</label>
                <textarea id="problema" name="problema" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required><?= $row['problema']; ?></textarea>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="orcamento" style="display: block; margin-bottom: 5px;">Orçamento</label>
                <input type="number" id="orcamento" name="orcamento" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" step="0.01" value="<?= $row['orcamento']; ?>">
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="observacoes" style="display: block; margin-bottom: 5px;">Observações</label>
                <textarea id="observacoes" name="observacoes" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"><?= $row['observacoes']; ?></textarea>
            </div>
            <div class="form-group" style="text-align: right;">
                <button type="submit" class="btn btn-primary" style="background-color: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 5px;">Atualizar</button>
            </div>
        </form>
    </main>
</body>
</html>