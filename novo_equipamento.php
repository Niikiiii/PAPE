<?php
include('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Equipamento</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Assuming you have a styles.css file -->
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>





<body class="sb-nav-fixed">
        <?php include('topnav.php');?>
        <div id="layoutSidenav">
            <?php include('sidenav.php');?>
            <div id="layoutSidenav_content">

                <main class="main-content" style="flex: 1; padding-left: 15px; padding-top: 50px;">         
                <div class="main-title">
                    <h1 class="font-weight-bold">Novo Equipamento</h1>
                </div>
                <form action="gravar_equipamento.php" method="POST" style="max-width: 600px; margin: auto;">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="cliente" style="display: block; margin-bottom: 5px;">Cliente</label>
                        <select id="cliente" name="cliente" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                            <option value="">Selecione um cliente</option>
                            <?php
                            $sql = "SELECT idCliente, nome FROM clientes";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['idCliente'] . "'>" . $row['nome'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="tipo" style="display: block; margin-bottom: 5px;">Tipo</label>
                        <input type="text" id="tipo" name="tipo" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="marca" style="display: block; margin-bottom: 5px;">Marca</label>
                        <input type="text" id="marca" name="marca" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="modelo" style="display: block; margin-bottom: 5px;">Modelo</label>
                        <input type="text" id="modelo" name="modelo" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="numeroSerie" style="display: block; margin-bottom: 5px;">Número de Série</label>
                        <input type="text" id="numeroSerie" name="numeroSerie" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                    </div>
<!----------CRUD-------------------------CRUD----------------CRUD------------------CRUD------------------CRUD-------------------CRUD---------------CRUD-----------------------CRUD---------->

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="user" style="display: block; margin-bottom: 5px;">Usuário</label>
                        <select id="user" name="user" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                            <option value="">Selecione um usuário</option>
                            <?php
                            $sql = "SELECT idUser, nomeCompleto FROM users";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['idUser'] . "'>" . $row['nomeCompleto'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" style="text-align: right;">
                        <button type="submit" name="submit" class="btn btn-primary" style="background-color: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 5px;">Enviar</button>
                    </div>
<!----------CRUD-------------------------CRUD----------------CRUD------------------CRUD------------------CRUD-------------------CRUD---------------CRUD-----------------------CRUD---------->

                </form>
                <div id="selectedUser" style="margin-top: 20px; text-align: center;">
                    <!-- Div to display the selected user -->
                </div>
            </main>
            </div>
        </div>
        <script>
        document.getElementById('user').addEventListener('change', function() {
            var selectedUser = this.options[this.selectedIndex].text;
            document.getElementById('selectedUser').innerText = 'Usuário selecionado: ' + selectedUser;
        });
    </script>



    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
</body>
</html>