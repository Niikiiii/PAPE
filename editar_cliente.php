<?php
require_once "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM clientes WHERE idCliente = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Assuming you have a styles.css file -->
</head>
<body>
    

            <main class="main-content" style="flex: 1; padding: 20px;">
                <div class="main-title">
                    <h1 class="font-weight-bold">Editar Cliente</h1>
                </div>
                <form action="atualizar_cliente.php" method="POST" style="max-width: 600px; margin: auto;">
                    <input type="hidden" name="idCliente" value="<?= $row['idCliente']; ?>">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="nome" style="display: block; margin-bottom: 5px;">Nome</label>
                        <input type="text" id="nome" name="nome" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" value="<?= $row['nome']; ?>" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="telemovel" style="display: block; margin-bottom: 5px;">Telemovel</label>
                        <input type="text" id="telemovel" name="telemovel" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" value="<?= $row['telemovel']; ?>" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="email" style="display: block; margin-bottom: 5px;">Email</label>
                        <input type="email" id="email" name="email" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" value="<?= $row['email']; ?>" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="nif" style="display: block; margin-bottom: 5px;">NIF</label>
                        <input type="text" id="nif" name="nif" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" value="<?= $row['nif']; ?>" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="morada" style="display: block; margin-bottom: 5px;">Morada</label>
                        <input type="text" id="morada" name="morada" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" value="<?= $row['morada']; ?>" required>
                    </div>
                    <div class="form-group" style="text-align: right;">
                        <button type="submit" class="btn btn-primary" style="background-color: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 5px;">Salvar</button>
                    </div>
                </form>
            </main>
        
</body>
</html>