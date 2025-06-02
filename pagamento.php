<?php
//iniciar session

session_start();

include_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $dataPagamento = $_POST['dataPagamento'];
    $valorPago = $_POST['valorPago'];
    $metodoPagamento = $_POST['metodoPagamento'];
    $detalhes = $_POST['detalhes'];
    $tecnico = $_POST['tecnico'];
    $reparacao = $_POST['idReparacao'];

    // Validate idReparacao
    if (empty($reparacao)) {
        die("Erro: O campo 'Reparação' é obrigatório.");
    }

    // Prepare and execute the SQL query
    $sql = "INSERT INTO pagamentos (idPagamento, idReparacao, dataPagamento, valorPago, metodoPagamento, detalhes, idUser) 
            VALUES (NULL, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isdssi", $reparacao, $dataPagamento, $valorPago, $metodoPagamento, $detalhes, $tecnico);

    if ($stmt->execute()) {
        echo "Pagamento adicionado com sucesso!";
        // Redirect to a success page or back to the form
        header("Location: pagamento.php?success=1");
        exit();
    } else {
        echo "Erro ao adicionar pagamento: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método de requisição inválido.";
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tables - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <style>
            .estado-em-analise {
            background-color: rgb(255, 226, 99);
            color: black;
        }
        .estado-concluido {
            background-color: rgb(107, 163, 34);
            color: white;
        }
        .estado-cancelado {
            background-color: rgb(204, 89, 81);
            color: white;
        }
        .estado-em-reparacao {
            background-color: rgb(255, 188, 63);
            color: black;
        }
        .estado-box {
            display: inline-block;
            width: 15px;
            height: 15px;
            margin-right: 5px;
            border-radius: 50%;
        }
        </style>
<?php include 'topnav.php'; ?>
        <div id="layoutSidenav">
<?php include 'sidenav.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Pagamentos</h1>
                        <!-- Nova Reparação Button -->
                    <div class="new-client-button" style="text-align: right; margin-bottom: 20px;">
                        <a href="novo_pagamento.php" class="btn btn-success" style="background-color: #28a745; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">Novo Pagamentos</a>
                    </div>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pagamentos</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Pagamentos
                            </div>
                            <div class="card-body">



                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID pagamento </th>
                                            <th>ID reparaçao</th>
                                            <th>Data pagamento</th>
                                            <th>Valor pago</th>
                                            <th>Metodo de pagamento</th>
                                            <th>Detalhes</th>
                                            <th>Tecnico</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>ID pagamento </th>
                                            <th>ID reparaçao</th>
                                            <th>Data pagamento</th>
                                            <th>Valor pago</th>
                                            <th>Metodo de pagamento</th>
                                            <th>Detalhes</th>
                                            <th>Tecnico</th>
                                            <th>Ações</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    
                                    <?php
                            $sql = "SELECT p.idPagamento, p.idReparacao, p.dataPagamento, p.valorPago, p.metodoPagamento, p.detalhes, u.nomeCompleto
                                    FROM Pagamentos p
                                    JOIN users u ON p.idUser = u.idUser
                                    ORDER BY p.idPagamento DESC";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td style="text-align:center"><?= $row['idPagamento']; ?></td>
                                <td style="text-align:center"><?= $row['idReparacao']; ?></td>
                                <td style="text-align:center"><?= $row['dataPagamento']; ?></td>
                                <td style="text-align:center"><?= $row['valorPago']; ?></td>
                                <td style="text-align:center"><?= $row['metodoPagamento']; ?></td>
                                <td style="text-align:center"><?= $row['detalhes']; ?></td>
                                <td style="text-align:center"><?= $row['nomeCompleto']; ?></td>
<!----------CRUD-------------------------CRUD----------------CRUD------------------CRUD------------------CRUD-------------------CRUD---------------CRUD-----------------------CRUD---------->
                                <td style="text-align:center">
                                    <form class="delete-pagamento-form" method="POST" action="eliminar_pagamento.php" style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $row['idPagamento']; ?>">
                                        <button type="submit" class="btn btn-danger text-white mb-4 position-relative">
                                            Eliminar
                                        </button>
                                    </form>
                                    <form method="GET" action="editar_pagamento.php" style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $row['idPagamento']; ?>">
                                        <button type="submit" class="btn bg-success text-white mb-4 position-relative">
                                            Editar
                                        </button>
                                    </form>
                                    <a href="detalhe_equipamento.php?id=<?= $row['idPagamento']; ?>"
                                    class="btn btn-info"
                                    style="background-color:#007bff; color:#fff; padding:5px 12px; border-radius:5px; margin-right:5px; text-decoration:none;">
                                        Detalhes
                                    </a>
                                </td>
<!----------CRUD-------------------------CRUD----------------CRUD------------------CRUD------------------CRUD-------------------CRUD---------------CRUD-----------------------CRUD---------->
                            </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='8' style='text-align:center'>Nenhum pagamento encontrado.</td></tr>";
                            }
                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <!-- Modal for popup message -->
        <div class="modal fade" id="deletePagamentoPopup" tabindex="-1" aria-labelledby="deletePagamentoPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePagamentoPopupLabel">Aviso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body" id="deletePagamentoPopupBody">
                <!-- Message will be inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
            </div>
        </div>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.addEventListener('submit', function(e) {
                if (e.target.classList.contains('delete-pagamento-form')) {
                    e.preventDefault();
                    const form = e.target;
                    const formData = new FormData(form);
                    fetch('eliminar_pagamento.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(msg => {
                        document.getElementById('deletePagamentoPopupBody').innerHTML = msg;
                        var myModal = new bootstrap.Modal(document.getElementById('deletePagamentoPopup'));
                        myModal.show();

                        // Add event listener to refresh page when modal is closed
                        var popup = document.getElementById('deletePagamentoPopup');
                        popup.addEventListener('hidden.bs.modal', function handler() {
                            location.reload();
                            popup.removeEventListener('hidden.bs.modal', handler);
                        });
                    });
                }
            });
        });
        </script>
    </body>
</html>
