<?php
include_once('db.php');
session_start();

// Query to count the number of equipamentos in "cancelado"
$queryCancelado = "SELECT COUNT(idEquipamento) AS cancelado FROM equipamentos WHERE estado = 'cancelado'";
$resultCancelado = $conn->query($queryCancelado);

// Check if a row is returned
if ($resultCancelado && $resultCancelado->num_rows > 0) {
    $rowCancelado = $resultCancelado->fetch_assoc();
    $cancelado = $rowCancelado['cancelado'];
} else {
    $cancelado = 0; // Default value if no data is found
}

// Query to count the total number of equipamentos
$query = "SELECT COUNT(idEquipamento) AS totalEquipamentos FROM equipamentos";
$result = $conn->query($query);

// Query to count the number of equipamentos in "em analise"
$queryEmAnalise = "SELECT COUNT(idEquipamento) AS emAnalise FROM equipamentos WHERE estado = 'em analise'";
$resultEmAnalise = $conn->query($queryEmAnalise);

// Check if a row is returned
if ($resultEmAnalise && $resultEmAnalise->num_rows > 0) {
    $rowEmAnalise = $resultEmAnalise->fetch_assoc();
    $emAnalise = $rowEmAnalise['emAnalise'];
} else {
    $emAnalise = 0; // Default value if no data is found
}

// Check if a row is returned
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalEquipamentos = $row['totalEquipamentos'];
} else {
    $totalEquipamentos = 0; // Default value if no data is found
}

// Query to count the number of equipamentos in "em reparaçao"
$queryEmReparacao = "SELECT COUNT(idEquipamento) AS emReparacao FROM equipamentos WHERE estado = 'em reparaçao'";
$resultEmReparacao = $conn->query($queryEmReparacao);

// Check if a row is returned
if ($resultEmReparacao && $resultEmReparacao->num_rows > 0) {
    $rowEmReparacao = $resultEmReparacao->fetch_assoc();
    $emReparacao = $rowEmReparacao['emReparacao'];
} else {
    $emReparacao = 0; // Default value if no data is found
}

// Query to fetch the most recent reparacao based on dataEntrada
$queryRecentReparacao = "
    SELECT 
        clientes.nome AS clienteNome, 
        clientes.telemovel AS clienteTelemovel, 
        equipamentos.tipo AS equipamentoTipo, 
        equipamentos.marca AS equipamentoMarca, 
        equipamentos.estado AS equipamentoEstado, 
        reparacoes.dataEntrada AS dataEntrada
    FROM reparacoes
    INNER JOIN equipamentos ON reparacoes.idEquipamento = equipamentos.idEquipamento
    INNER JOIN clientes ON equipamentos.idCliente = clientes.idCliente
    ORDER BY reparacoes.dataEntrada DESC
    LIMIT 1"; // Fetch the most recent reparacao
$resultRecentReparacao = $conn->query($queryRecentReparacao);

// Check if a row is returned
if ($resultRecentReparacao && $resultRecentReparacao->num_rows > 0) {
    $rowRecentReparacao = $resultRecentReparacao->fetch_assoc();
    $clienteNome = $rowRecentReparacao['clienteNome'];
    $clienteTelemovel = $rowRecentReparacao['clienteTelemovel'];
    $equipamentoTipo = $rowRecentReparacao['equipamentoTipo'];
    $equipamentoMarca = $rowRecentReparacao['equipamentoMarca'];
    $equipamentoEstado = $rowRecentReparacao['equipamentoEstado'];
    $dataEntrada = $rowRecentReparacao['dataEntrada'];
} else {
    // Default values if no data is found
    $clienteNome = 'N/A';
    $clienteTelemovel = 'N/A';
    $equipamentoTipo = 'N/A';
    $equipamentoMarca = 'N/A';
    $equipamentoEstado = 'N/A';
    $dataEntrada = 'N/A';
}

$queryConcluido = "SELECT COUNT(idEquipamento) AS concluidos FROM equipamentos WHERE estado = 'concluido'";
$resultConcluido = $conn->query($queryConcluido);
if ($resultConcluido && $resultConcluido->num_rows > 0) {
    $rowConcluido = $resultConcluido->fetch_assoc();
    $concluidos = $rowConcluido['concluidos'];
} else {
    $concluidos = 0;
}
?>
<style>
    .bg-warning-custom {
        background-color: #ff9800 !important; /* Custom orange color */
    }
</style>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            #chartTipoEquipamento {
                max-width: 345px;
                max-height: 345px;
                width: 100% !important;
                height: auto !important;
                margin: 0 auto;
                display: block;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <?php include('topnav.php');?>
        <div id="layoutSidenav">
            <?php include('sidenav.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>

                        <div class="row">
                        <!-- Em Reparação -->
                            <div class="col">
                                <a href="tables.php" style="text-decoration: none;">
                                    <div class="card bg-warning-custom text-white mb-4 position-relative" style="cursor:pointer;">
                                        <div class="card-body">
                                            Em Reparação: <?= htmlspecialchars($emReparacao); ?>
                                            <span class="stretched-link"></span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Em Análise -->
                            <div class="col">
                                <a href="tables.php" style="text-decoration: none;">
                                    <div class="card bg-warning text-white mb-4 position-relative" style="cursor:pointer;">
                                        <div class="card-body">
                                            Em Análise: <?= htmlspecialchars($emAnalise); ?>
                                            <span class="stretched-link"></span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Concluídos -->
                            <div class="col">
                                <a href="tables.php" style="text-decoration: none;">
                                    <div class="card bg-success text-white mb-4 position-relative" style="cursor:pointer;">
                                        <div class="card-body">
                                            Concluídos: <?= htmlspecialchars($concluidos); ?>
                                            <span class="stretched-link"></span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Cancelado -->
                            <div class="col">
                                <a href="tables.php" style="text-decoration: none;">
                                    <div class="card bg-danger text-white mb-4 position-relative" style="cursor:pointer;">
                                        <div class="card-body">
                                            Cancelado: <?= htmlspecialchars($cancelado); ?>
                                            <span class="stretched-link"></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-xl-6 col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Equipamentos por Estado
                                </div>
                                <div class="card-body">
                                    <canvas id="myBarChart1" width="100%" height="40"></canvas>
                                </div>
                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                <script>
                                    const ctx1 = document.getElementById('myBarChart1').getContext('2d');
                                    new Chart(ctx1, {
                                        type: 'bar',
                                        data: {
                                            labels: ['cancelados', 'Concluidos', 'Em Analise', 'Em reparação'],
                                            datasets: [{
                                                label: 'numero de equipamentos',
                                                data: [<?= $cancelado; ?>,<?= $concluidos; ?>, <?= $emAnalise; ?>, <?= $emReparacao; ?>],
                                                backgroundColor: [
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 235, 108, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgb(54, 235, 136)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(255, 159, 64, 1)'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Rendimento por Mês
                                    </div>
                                    <div class="card-body">
                                        <canvas id="myBarChartPagamentos" width="100%" height="40"></canvas>
                                    </div>
                                    <?php
                                        // Query to group payments by month and sum the `valorPago`
                                        $queryPagamentos = "
                                            SELECT 
                                                MONTH(dataPagamento) AS mes, 
                                                SUM(valorPago) AS totalPago 
                                            FROM pagamentos 
                                            GROUP BY MONTH(dataPagamento)";
                                        $resultPagamentos = $conn->query($queryPagamentos);

                                        // Prepare data for the chart
                                        $meses = [];
                                        $valores = [];
                                        while ($row = $resultPagamentos->fetch_assoc()) {
                                            $meses[] = date('F', mktime(0, 0, 0, $row['mes'], 10)); // Convert month number to name
                                            $valores[] = $row['totalPago'];
                                        }
                                        ?>
                                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                        <script>
                                            const ctxPagamentos = document.getElementById('myBarChartPagamentos').getContext('2d');
                                            new Chart(ctxPagamentos, {
                                                type: 'bar',
                                                data: {
                                                    labels: <?= json_encode($meses); ?>, // Months
                                                    datasets: [{
                                                        label: 'Valor (euros)',
                                                        data: <?= json_encode($valores); ?>, // Payment values
                                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                        borderColor: 'rgba(75, 192, 192, 1)',
                                                        borderWidth: 1
                                                    }]
                                                },
                                                options: {
                                                    scales: {
                                                        y: {
                                                            beginAtZero: true
                                                        }
                                                    }
                                                }
                                            });
                                        </script>
                                </div>
                            </div>
                        </div>

<div class="row">
    <div class="col-xl-6 col-md-6">
<?php
$queryTipos = "SELECT tipo, COUNT(*) as total FROM equipamentos GROUP BY tipo";
$resultTipos = $conn->query($queryTipos);
$tipos = [];
$tiposCount = [];
while ($row = $resultTipos->fetch_assoc()) {
    $tipos[] = $row['tipo'];
    $tiposCount[] = $row['total'];
}
?>
<div class="card mb-4">
    <div class="card-header"><i class="fas fa-chart-pie me-1"></i>Reparações por Tipo</div>
    <div class="card-body">
        <canvas id="chartTipoEquipamento"></canvas>
    </div>
</div>
<script>
const ctxTipo = document.getElementById('chartTipoEquipamento').getContext('2d');
new Chart(ctxTipo, {
    type: 'pie',
    data: {
        labels: <?= json_encode($tipos); ?>,
        datasets: [{
            data: <?= json_encode($tiposCount); ?>,
            backgroundColor: [
                '#007bff', // azul
                '#28a745', // verde
                '#ffc107', // amarelo
                '#dc3545', // vermelho
                '#17a2b8', // azul claro
                '#6f42c1', // roxo
                '#fd7e14', // laranja
                '#20c997', // verde água
                '#e83e8c', // rosa
                '#343a40'  // cinza escuro
            ],
            borderColor: [
                '#fff','#fff','#fff','#fff','#fff','#fff','#fff','#fff','#fff','#fff'
            ]
        }]
    }
});
</script>
    </div>

    <div class="col-xl-6 col-md-6">
<?php
$queryRepsMes = "
    SELECT MONTH(dataEntrada) as mes, COUNT(*) as total
    FROM reparacoes
    GROUP BY MONTH(dataEntrada)";
$resultRepsMes = $conn->query($queryRepsMes);
$mesesRep = [];
$totaisRep = [];
while ($row = $resultRepsMes->fetch_assoc()) {
    $mesesRep[] = date('F', mktime(0, 0, 0, $row['mes'], 10));
    $totaisRep[] = $row['total'];
}
?>
<div class="card mb-4">
    <div class="card-header"><i class="fas fa-chart-line me-1"></i>Reparações por Mês</div>
    <div class="card-body">
        <canvas id="chartRepsMes"></canvas>
    </div>
</div>
<script>
const ctxRepsMes = document.getElementById('chartRepsMes').getContext('2d');
new Chart(ctxRepsMes, {
    type: 'line',
    data: {
        labels: <?= json_encode($mesesRep); ?>,
        datasets: [{
            label: 'Nº Reparações',
            data: <?= json_encode($totaisRep); ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 2,
            fill: true
        }]
    }
});
</script>

    </div>
</div>




<?php
// Fetch the most recent reparacao data
// Query to fetch the 3 most recent equipamentos and their client info
$queryRecentEquipamentos = "
    SELECT 
        e.idEquipamento,
        e.tipo AS equipamentoTipo, 
        e.marca AS equipamentoMarca, 
        e.estado AS equipamentoEstado, 
        c.nome AS clienteNome, 
        c.telemovel AS clienteTelemovel
    FROM equipamentos e
    INNER JOIN clientes c ON e.idCliente = c.idCliente
    ORDER BY e.idEquipamento DESC
    LIMIT 3";
$resultRecentEquipamentos = $conn->query($queryRecentEquipamentos);

$recentEquipamentos = [];
if ($resultRecentEquipamentos && $resultRecentEquipamentos->num_rows > 0) {
    while ($row = $resultRecentEquipamentos->fetch_assoc()) {
        $recentEquipamentos[] = $row;
    }
}
?>


<div class="card mb-4 border-0">

    <div class="card-body">
        <?php if (!empty($recentEquipamentos)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr style="background-color:rgb(236, 237, 238);">
                        <th>ID Equipamento</th>
                        <th>Cliente Nome</th>
                        <th>Cliente Telemovel</th>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <?php
                function estadoColor($estado) {
                    switch (strtolower($estado)) {
                        case 'em analise':
                            return '#ffc107'; // amarelo
                        case 'concluido':
                            return '#28a745'; // verde
                        case 'cancelado':
                            return '#dc3545'; // vermelho
                        case 'em reparaçao':
                        case 'em reparação':
                            return '#007bff'; // azul
                        default:
                            return '#adb5bd'; // cinza para desconhecido
                    }
                }
                ?>
                    <tbody>
                        <?php foreach ($recentEquipamentos as $equip): ?>
                            <tr>
                                <td><?= htmlspecialchars($equip['idEquipamento']); ?></td>
                                <td><?= htmlspecialchars($equip['clienteNome']); ?></td>
                                <td><?= htmlspecialchars($equip['clienteTelemovel']); ?></td>
                                <td><?= htmlspecialchars($equip['equipamentoTipo']); ?></td>
                                <td><?= htmlspecialchars($equip['equipamentoMarca']); ?></td>
                                <td>
                                    <span style="display:inline-block;width:14px;height:14px;border-radius:3px;vertical-align:middle;margin-right:6px;background:<?= estadoColor($equip['equipamentoEstado']); ?>"></span>
                                    <?= htmlspecialchars($equip['equipamentoEstado']); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum equipamento encontrado.</p>
        <?php endif; ?>
    </div>

</div>
<!-------recent equipamentos----------------------->

                    </div>
                </main>
                <footer>

                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
