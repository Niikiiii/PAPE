<?php
//iniciar session

session_start();

include_once 'db.php';

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
        <link href="css/c.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        
    </head>
    <body class="sb-nav-fixed">

<?php include('topnav.php'); ?>
        <div id="layoutSidenav">
        <?php include('sidenav.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Reparaçoes</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Reparaçoes</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Registos de Reparaçoes
                            </div>
                            <div class="card-body">



                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>ID Reparação</th>
                                        <th>Cliente</th>
                                        <th>Equipamento</th>
                                        <th>Problema</th>
                                        <th>Data Entrada</th>
                                        <th>Data Previsão</th>
                                        <th>Orçamento</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID Reparação</th>
                                        <th>Cliente</th>
                                        <th>Equipamento</th>
                                        <th>Problema</th>
                                        <th>Data Entrada</th>
                                        <th>Data Previsão</th>
                                        <th>Orçamento</th>
                                        <th>Ações</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                    $sql = "SELECT 
                                                r.idReparacao, 
                                                c.nome AS cliente, 
                                                CONCAT(e.tipo, ' - ', e.marca) AS equipamento, 
                                                r.problema, 
                                                r.dataEntrada, 
                                                r.dataPrevisao, 
                                                r.orcamento
                                            FROM reparacoes r
                                            INNER JOIN equipamentos e ON r.idEquipamento = e.idEquipamento
                                            INNER JOIN clientes c ON e.idCliente = c.idCliente
                                            ORDER BY r.idReparacao DESC";

                                    $result = $conn->query($sql); // Execute the query

                                    if ($result->num_rows > 0) { // Check if there are rows
                                        while ($row = $result->fetch_assoc()) { // Fetch each row
                                    ?>
                                            <tr>
                                                <td style="text-align:center"><?= $row['idReparacao']; ?></td>
                                                <td style="text-align:center"><?= $row['cliente']; ?></td>
                                                <td style="text-align:center"><?= $row['equipamento']; ?></td>
                                                <td style="text-align:center"><?= $row['problema']; ?></td>
                                                <td style="text-align:center"><?= $row['dataEntrada']; ?></td>
                                                <td style="text-align:center"><?= $row['dataPrevisao']; ?></td>
                                                <td style="text-align:center"><?= $row['orcamento']; ?></td>
<!----------CRUD-------------------------CRUD----------------CRUD------------------CRUD------------------CRUD-------------------CRUD---------------CRUD-----------------------CRUD---------->
                                                <td style="text-align:center">
                                                    <!-- Example delete button in your table -->
                                                    <form class="delete-reparacao-form" method="POST" action="eliminar_reparacao.php" style="display:inline;">
                                                        <input type="hidden" name="id" value="<?= $row['idReparacao']; ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                                    </form>
                                                    <form method="GET" action="editar_reparacao.php" style="display: inline;">
                                                        <input type="hidden" name="id" value="<?= $row['idReparacao']; ?>">
                                                        <button type="submit" style="background-color:rgb(156, 192, 71); color: #fff; padding: 5px 10px; border-radius: 5px; margin-right: 5px;"
                                                                class="btn-editar">
                                                            Editar
                                                        </button>
                                                    </form>
                                                    <a href="detalhe_equipamento.php?id=<?= $row['idReparacao']; ?>"
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
                                        echo "<tr><td colspan='8' style='text-align:center'>Nenhum registo encontrado.</td></tr>";
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
        <div class="modal fade" id="deletePopup" tabindex="-1" aria-labelledby="deletePopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePopupLabel">Aviso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body" id="deletePopupBody">
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
                    if (e.target.classList.contains('delete-reparacao-form')) {
                        e.preventDefault();
                        const form = e.target;
                        const formData = new FormData(form);
                        fetch('eliminar_reparacao.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.text())
                        .then(msg => {
                            document.getElementById('deletePopupBody').innerHTML = msg;
                            var myModal = new bootstrap.Modal(document.getElementById('deletePopup'));
                            myModal.show();

                            // Refresh page after closing the modal
                            var popup = document.getElementById('deletePopup');
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
