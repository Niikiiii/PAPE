<?php
require_once "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT e.idEquipamento, c.nome AS cliente, e.tipo, e.marca, e.modelo, e.numeroSerie, e.estado
            FROM Equipamentos e
            JOIN Clientes c ON e.idCliente = c.idCliente
            WHERE e.idEquipamento = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipamento</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Assuming you have a styles.css file -->
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body>
            <main class="main-content" style="flex: 1; padding: 20px;">
                <div class="main-title">
                    <h1 class="font-weight-bold">Editar Equipamento</h1>
                </div>
                <form action="atualizar_equipamento.php" method="POST" style="max-width: 600px; margin: auto;">
                    <input type="hidden" name="idEquipamento" value="<?= $row['idEquipamento']; ?>">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="cliente" style="display: block; margin-bottom: 5px;">Cliente</label>
                        <input type="text" id="cliente" name="cliente" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" value="<?= $row['cliente']; ?>" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="tipo" style="display: block; margin-bottom: 5px;">Tipo</label>
                        <input type="text" id="tipo" name="tipo" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" value="<?= $row['tipo']; ?>" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="marca" style="display: block; margin-bottom: 5px;">Marca</label>
                        <input type="text" id="marca" name="marca" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" value="<?= $row['marca']; ?>" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="modelo" style="display: block; margin-bottom: 5px;">Modelo</label>
                        <input type="text" id="modelo" name="modelo" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" value="<?= $row['modelo']; ?>" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="numeroSerie" style="display: block; margin-bottom: 5px;">Número de Série</label>
                        <input type="text" id="numeroSerie" name="numeroSerie" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" value="<?= $row['numeroSerie']; ?>" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="estado" style="display: block; margin-bottom: 5px;">Estado</label>
                        <span id="estado-color-box" style="display:inline-block;width:18px;height:18px;border-radius:3px;vertical-align:middle;margin-right:8px;background:#ffc107;"></span>
                        <select id="estado" name="estado" class="form-control" style="width: 80%; display:inline-block; vertical-align:middle;" required>
                            <option value="em analise" <?= $row['estado'] == 'em analise' ? 'selected' : ''; ?>>Em Analise</option>
                            <option value="concluido" <?= $row['estado'] == 'concluido' ? 'selected' : ''; ?>>Concluido</option>
                            <option value="cancelado" <?= $row['estado'] == 'cancelado' ? 'selected' : ''; ?>>Cancelado</option>
                            <option value="em reparaçao" <?= $row['estado'] == 'em reparaçao' ? 'selected' : ''; ?>>Em Reparaçao</option>
                        </select>
                    </div>
                    <div class="form-group" style="text-align: right;">
                        <button type="submit" class="btn btn-primary" style="background-color: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 5px;">Salvar</button>
                    </div>
                </form>
            </main>
            <script>
            function updateEstadoColor() {
                const estado = document.getElementById('estado').value;
                const box = document.getElementById('estado-color-box');
                let color = '#ffc107'; // em analise
                if (estado === 'concluido') color = '#28a745';
                else if (estado === 'cancelado') color = '#dc3545';
                else if (estado === 'em reparaçao') color = '#007bff';
                box.style.background = color;
            }
            document.getElementById('estado').addEventListener('change', updateEstadoColor);
            updateEstadoColor();
            </script>
</body>
</html>