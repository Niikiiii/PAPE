<?php
//iniciar session

session_start();
include_once 'db.php';
include_once 'profile.php';

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
<?php include 'topnav.php'; ?>
        <div id="layoutSidenav">
<?php include_once 'sidenav.php'; ?>
            <div id="layoutSidenav_content">
                <main>

                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Clientes</h1>
                        <!-- Novo Cliente Button -->
                <div class="new-client-button" style="text-align: right; margin-bottom: 20px;">
                    <a href="novo_cliente.php" class="btn btn-success" style="background-color: #28a745; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">Novo Cliente</a>
                </div>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Clientes</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Clientes
                            </div>
                            <div class="card-body">




                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID </th>
                                            <th>Nome</th>
                                            <th>Telemovel</th>
                                            <th>Email</th>
                                            <th>NIF</th>
                                            <th>Morada</th>

                                            <th>Açoes</th>
                                        
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>ID </th>
                                            <th>Nome</th>
                                            <th>Telemovel</th>
                                            <th>Email</th>
                                            <th>NIF</th>
                                            <th>Morada</th>
                                            
                                            <th>Açoes</th>
                                            
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    <?php
                            $sql = "SELECT * FROM clientes ORDER BY idCliente DESC";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                            
                            
                            ?>
                                <tr>
                                <td style="text-align:center"><?= $row['idCliente']; ?></td>
                                <td style="text-align:center"><?= $row['nome']; ?></td>
                                <td style="text-align:center"><?= $row["telemovel"]; ?></td>
                                <td style="text-align:center"><?= $row["email"]; ?></td>
                                <td style="text-align:center"><?= $row["nif"]; ?></td>
                                <td style="text-align:center"><?= $row["morada"]; ?></td>
                                <td style="text-align:center">
<!----------CRUD-------------------------CRUD----------------CRUD------------------CRUD------------------CRUD-------------------CRUD---------------CRUD-----------------------CRUD---------->
                                    <form method="POST" action="eliminar_cliente.php" style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $row['idCliente']; ?>">
                                        <button type="submit" style="background-color:rgb(199, 62, 53); color: #fff; padding: 5px 10px; border-radius: 5px; margin-right: 5px;"
                                                class="btn-eliminar"
                                                onclick="return confirm('Tem a certeza que deseja eliminar este registo?');">
                                            Eliminar
                                        </button>
                                    </form>
                                    <form method="GET" action="editar_cliente.php" style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $row['idCliente']; ?>">
                                        <button type="submit" style="background-color:rgb(156, 192, 71); color: #fff; padding: 5px 10px; border-radius: 5px; margin-right: 5px;"
                                                class="btn-editar">
                                            Editar
                                        </button>
                                    </form>
                                    <a href="detalhe_equipamento.php?id=<?= $row['idCliente']; ?>"
                                    class="btn btn-info"
                                    style="background-color:#007bff; color:#fff; padding:5px 12px; border-radius:5px; margin-right:5px; text-decoration:none;">
                                        Detalhes
                                    </a>
<!----------CRUD-------------------------CRUD----------------CRUD------------------CRUD------------------CRUD-------------------CRUD---------------CRUD-----------------------CRUD---------->
                                </td>
                                </tr>
                                    <?php } ?>   
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
    </body>
</html>
