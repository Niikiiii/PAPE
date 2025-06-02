<?php


include_once 'db.php';

// Helper: Insert new cliente if needed
function getOrCreateCliente($conn, $cliente_id, $novo_nome, $novo_telemovel, $novo_email, $novo_nif, $novo_morada) {
    if ($novo_nome !== "") {
        $stmt = $conn->prepare("INSERT INTO clientes (nome, telemovel, email, nif, morada) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $novo_nome, $novo_telemovel, $novo_email, $novo_nif, $novo_morada);
        $stmt->execute();
        return $stmt->insert_id;
    } else {
        return $cliente_id;
    }
}

// Helper: Insert new equipamento if needed
function getOrCreateEquipamento($conn, $equipamento_id, $novo_tipo, $novo_marca, $novo_modelo, $novo_numeroSerie, $cliente_id) {
    if ($novo_modelo !== "") {
        $estado = 'em analise'; // Estado padrão
        $stmt = $conn->prepare("INSERT INTO equipamentos (tipo, marca, modelo, numeroSerie, idCliente, estado) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssis", $novo_tipo, $novo_marca, $novo_modelo, $novo_numeroSerie, $cliente_id, $estado);
        $stmt->execute();
        return $stmt->insert_id;
    } else {
        return $equipamento_id;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cliente
    $cliente = $_POST['cliente'] ?? '';
    $novo_cliente_nome = trim($_POST['novo_cliente_nome'] ?? '');
    $novo_cliente_telemovel = trim($_POST['novo_cliente_telemovel'] ?? '');
    $novo_cliente_email = trim($_POST['novo_cliente_email'] ?? '');
    $novo_cliente_nif = trim($_POST['novo_cliente_nif'] ?? '');
    $novo_cliente_morada = trim($_POST['novo_cliente_morada'] ?? '');

    // Equipamento
    $equipamento = $_POST['equipamento'] ?? '';
    $novo_tipo = trim($_POST['novo_tipo'] ?? '');
    $novo_marca = trim($_POST['novo_marca'] ?? '');
    $novo_modelo = trim($_POST['novo_modelo'] ?? '');
    $novo_numeroSerie = trim($_POST['novo_numeroSerie'] ?? '');

    // Get or create cliente
    $idCliente = getOrCreateCliente($conn, $cliente, $novo_cliente_nome, $novo_cliente_telemovel, $novo_cliente_email, $novo_cliente_nif, $novo_cliente_morada);

    // Get or create equipamento
    $idEquipamento = getOrCreateEquipamento($conn, $equipamento, $novo_tipo, $novo_marca, $novo_modelo, $novo_numeroSerie, $idCliente);

    // Reparação fields
    $dataEntrada = $_POST['dataEntrada'];
    $dataPrevisao = $_POST['dataPrevisao'];
    $problema = $_POST['problema'];
    $orcamento = $_POST['orcamento'];

    $idEstado = $_POST['idEstado'] ?? 4; // valor padrão 4 (Em análise)

    $sql = "INSERT INTO reparacoes (idEquipamento, dataEntrada, dataPrevisao, problema, orcamento, idEstado)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssdi", $idEquipamento, $dataEntrada, $dataPrevisao, $problema, $orcamento, $idEstado);


    if ($stmt->execute()) {
        header('Location: reparaçoes.php');
        exit;
    } else {
        echo "Erro ao gravar: " . $conn->error;
    }
}

// Get clientes and equipamentos for dropdowns
$clientes = $conn->query("SELECT idCliente, nome FROM clientes ORDER BY nome");
$equipamentos = $conn->query("SELECT e.idEquipamento, e.tipo, e.marca, e.modelo, c.nome FROM equipamentos e JOIN clientes c ON e.idCliente = c.idCliente ORDER BY e.modelo");
$today = date('Y-m-d');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Nova Reparação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-4">
        <h1>Nova Reparação</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="dataEntrada" class="form-label">Data Entrada</label>
                <input type="date" id="dataEntrada" name="dataEntrada" class="form-control" value="<?= $today ?>" required>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="border rounded p-3 mb-3">
                        <h5>Selecionar Cliente Existente</h5>
                        <select name="cliente" class="form-select mb-2">
                            <option value="">Selecione</option>
                            <?php while($row = $clientes->fetch_assoc()): ?>
                                <option value="<?= $row['idCliente'] ?>"><?= htmlspecialchars($row['nome']) ?></option>
                            <?php endwhile; ?>
                        </select>
                        <hr>
                        <h5>Ou Criar Novo Cliente</h5>
                        <input type="text" name="novo_cliente_nome" class="form-control mb-2" placeholder="Nome">
                        <input type="text" name="novo_cliente_telemovel" class="form-control mb-2" placeholder="Telemóvel">
                        <input type="email" name="novo_cliente_email" class="form-control mb-2" placeholder="Email">
                        <input type="text" name="novo_cliente_nif" class="form-control mb-2" placeholder="NIF">
                        <input type="text" name="novo_cliente_morada" class="form-control mb-2" placeholder="Morada">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded p-3 mb-3">
                        <h5>Selecionar Equipamento Existente</h5>
                        <select name="equipamento" class="form-select mb-2">
                            <option value="">Selecione</option>
                            <?php while($row = $equipamentos->fetch_assoc()): ?>
                                <option value="<?= $row['idEquipamento'] ?>">
                                    <?= htmlspecialchars($row['tipo'] . " " . $row['marca'] . " " . $row['modelo'] . " (Cliente: " . $row['nome'] . ")") ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <hr>
                        <h5>Ou Criar Novo Equipamento</h5>
                        <input type="text" name="novo_tipo" class="form-control mb-2" placeholder="Tipo">
                        <input type="text" name="novo_marca" class="form-control mb-2" placeholder="Marca">
                        <input type="text" name="novo_modelo" class="form-control mb-2" placeholder="Modelo">
                        <input type="text" name="novo_numeroSerie" class="form-control mb-2" placeholder="Número de Série">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="problema" class="form-label">Problema</label>
                <textarea name="problema" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="dataPrevisao" class="form-label">Data Previsão</label>
                <input type="date" name="dataPrevisao" class="form-control">
            </div>
            <div class="mb-3">
                <label for="orcamento" class="form-label">Orçamento</label>
                <input type="number" name="orcamento" class="form-control" step="0.01" value="0">
            </div>
            
            <input type="hidden" name="idEstado" value="4">

            <div class="form-group" style="text-align: right;">
                <button type="submit" class="btn btn-primary"
                    style="background: linear-gradient(135deg, #444 0%, #bbb 100%); border: none; color: #fff;">
                    Gravar
                </button>
            </div>
            
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <footer class="text-center mt-5 mb-3 text-muted" style="font-size:1.1em;">
        <span id="hora-atual"></span>
        <script>
            function updateTime() {
                const now = new Date();
                const h = String(now.getHours()).padStart(2, '0');
                const m = String(now.getMinutes()).padStart(2, '0');
                const s = String(now.getSeconds()).padStart(2, '0');
                document.getElementById('hora-atual').textContent = `${h}:${m}:${s}`;
            }
            updateTime();
            setInterval(updateTime, 1000);
        </script>
    </footer>
</body>
</html>