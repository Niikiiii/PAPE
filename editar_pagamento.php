<?php
require_once "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT p.idPagamento, p.idReparacao, p.dataPagamento, p.valorPago, p.metodoPagamento, p.detalhes, u.nomeCompleto AS usuario
            FROM pagamentos p
            JOIN users u ON p.idUser = u.idUser
            WHERE p.idPagamento = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Nenhum registro encontrado.";
        exit();
    }
} else {
    echo "Requisição inválida.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Orçamento</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <main class="main-content" style="flex: 1; padding: 20px;">
        <div class="main-title">
            <h1 class="font-weight-bold">Editar Orçamento</h1>
        </div>
        <form action="atualizar_orcamento.php" method="POST" style="max-width: 600px; margin: auto;">
            <input type="hidden" name="idPagamento" value="<?= $row['idPagamento']; ?>">
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="idReparacao" style="display: block; margin-bottom: 5px;">ID Reparação</label>
                <input type="text" id="idReparacao" name="idReparacao" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" value="<?= $row['idReparacao']; ?>" required>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="dataPagamento" style="display: block; margin-bottom: 5px;">Data Pagamento</label>
                <input type="date" id="dataPagamento" name="dataPagamento" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" value="<?= $row['dataPagamento']; ?>" required>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="valorPago" style="display: block; margin-bottom: 5px;">Valor Pago</label>
                <input type="number" id="valorPago" name="valorPago" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" value="<?= $row['valorPago']; ?>" required>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="metodoPagamento" style="display: block; margin-bottom: 5px;">Método de Pagamento</label>
                <select id="metodoPagamento" name="metodoPagamento" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                    <option value="MB Way" <?= $row['metodoPagamento'] == 'MB Way' ? 'selected' : ''; ?>>MB Way</option>
                    <option value="Cartão" <?= $row['metodoPagamento'] == 'Cartão' ? 'selected' : ''; ?>>Cartão</option>
                    <option value="Dinheiro" <?= $row['metodoPagamento'] == 'Dinheiro' ? 'selected' : ''; ?>>Dinheiro</option>
                    <option value="Multibanco" <?= $row['metodoPagamento'] == 'Multibanco' ? 'selected' : ''; ?>>Multibanco</option>
                    <option value="Transferência" <?= $row['metodoPagamento'] == 'Transferência' ? 'selected' : ''; ?>>Transferência</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="detalhes" style="display: block; margin-bottom: 5px;">Detalhes</label>
                <textarea id="detalhes" name="detalhes" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required><?= $row['detalhes']; ?></textarea>
            </div>
            <div class="form-group" style="text-align: right;">
                <button type="submit" class="btn btn-primary" style="background-color: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 5px;">Salvar</button>
            </div>
        </form>
    </main>
</body>
</html>
