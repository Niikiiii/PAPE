<?php
include_once 'db.php';

$idEquipamento = $_GET['id'] ?? null;
if (!$idEquipamento) {
    echo "Equipamento não encontrado.";
    exit;
}

// Buscar dados do equipamento e cliente
$sql = "SELECT e.*, c.nome AS cliente_nome, c.telemovel, c.email, c.nif, c.morada
        FROM equipamentos e
        JOIN clientes c ON e.idCliente = c.idCliente
        WHERE e.idEquipamento = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idEquipamento);
$stmt->execute();
$equipamento = $stmt->get_result()->fetch_assoc();

if (!$equipamento) {
    echo "Equipamento não encontrado.";
    exit;
}

// Definir classe de cor para o estado (MOVA ESTE BLOCO PARA CÁ)
$estadoClass = 'estado-em-analise';
switch (strtolower($equipamento['estado'])) {
    case 'em analise':
        $estadoClass = 'estado-em-analise';
        break;
    case 'concluido':
        $estadoClass = 'estado-concluido';
        break;
    case 'cancelado':
        $estadoClass = 'estado-cancelado';
        break;
    case 'em reparaçao':
    case 'em reparação':
        $estadoClass = 'estado-em-reparacao';
        break;
}

// Buscar pagamentos (exemplo)
$pagamentos = [];
$sqlPag = "SELECT p.* 
        FROM pagamentos p
        JOIN reparacoes r ON p.idReparacao = r.idReparacao
        WHERE r.idEquipamento = ?";
$stmtPag = $conn->prepare($sqlPag);
$stmtPag->bind_param("i", $idEquipamento);
$stmtPag->execute();
$resPag = $stmtPag->get_result();
while ($row = $resPag->fetch_assoc()) {
    $pagamentos[] = $row;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Equipamento</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .detalhe-container { max-width: 900px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 12px #ccc; padding: 32px; }
        .detalhe-title { font-size: 2rem; font-weight: bold; margin-bottom: 24px; }
        .detalhe-section { margin-bottom: 32px; }
        .detalhe-section h2 { font-size: 1.2rem; color: #007bff; margin-bottom: 12px; }
        .detalhe-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        .detalhe-table th, .detalhe-table td { padding: 8px 12px; border-bottom: 1px solid #eee; text-align: left; }
        .detalhe-table th { background: #f5f5f5; }
        .pagamentos-table th, .pagamentos-table td { text-align: center; }
        .estado-box {
        display: inline-block;
        width: 14px;
        height: 14px;
        border-radius: 3px;
        margin-right: 8px;
        vertical-align: middle;
        }
        .estado-em-analise { background: #ffc107; }
        .estado-concluido { background: #28a745; }
        .estado-cancelado { background: #dc3545; }
        .estado-em-reparacao { background: #007bff; }
    </style>
</head>
<body>
    <div class="detalhe-container">
        <div class="detalhe-title">Detalhes do Equipamento #<?= htmlspecialchars($equipamento['idEquipamento']) ?></div>
        
        <div class="detalhe-section">
            <h2>Informações do Equipamento</h2>
            <table class="detalhe-table">
                <tr><th>Tipo</th><td><?= htmlspecialchars($equipamento['tipo']) ?></td></tr>
                <tr><th>Marca</th><td><?= htmlspecialchars($equipamento['marca']) ?></td></tr>
                <tr><th>Modelo</th><td><?= htmlspecialchars($equipamento['modelo']) ?></td></tr>
                <tr><th>Número de Série</th><td><?= htmlspecialchars($equipamento['numeroSerie']) ?></td></tr>
                <tr>
                    <th>Estado</th>
                    <td>
                        <span class="estado-box <?= $estadoClass; ?>"></span>
                        <?= htmlspecialchars($equipamento['estado']) ?>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="detalhe-section">
            <h2>Informações do Cliente</h2>
            <table class="detalhe-table">
                <tr><th>Nome</th><td><?= htmlspecialchars($equipamento['cliente_nome']) ?></td></tr>
                <tr><th>Telemóvel</th><td><?= htmlspecialchars($equipamento['telemovel']) ?></td></tr>
                <tr><th>Email</th><td><?= htmlspecialchars($equipamento['email']) ?></td></tr>
                <tr><th>NIF</th><td><?= htmlspecialchars($equipamento['nif']) ?></td></tr>
                <tr><th>Morada</th><td><?= htmlspecialchars($equipamento['morada']) ?></td></tr>
            </table>
        </div>
        
        <div class="detalhe-section">
            <h2>Pagamentos</h2>
            <?php if (count($pagamentos)): ?>
                <table class="detalhe-table pagamentos-table">
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Método</th>
                        <th>Detalhes</th>
                    </tr>
                    <?php foreach ($pagamentos as $pag): ?>
                        <tr>
                            <td><?= htmlspecialchars($pag['idPagamento']) ?></td>
                            <td><?= htmlspecialchars($pag['dataPagamento']) ?></td>
                            <td><?= htmlspecialchars($pag['valorPago']) ?> €</td>
                            <td><?= htmlspecialchars($pag['metodoPagamento']) ?></td>
                            <td><?= htmlspecialchars($pag['detalhes']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>Nenhum pagamento registado.</p>
            <?php endif; ?>
        </div>
        
        <a href="tables.php" style="color:#007bff; text-decoration:underline;">&larr; Voltar à lista de equipamentos</a>
    </div>
</body>
</html>