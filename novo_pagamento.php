<?php
include('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Pagamento</title>
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
    <?php include('topnav.php'); ?>
    <div id="layoutSidenav">
        <?php include('sidenav.php'); ?>
        <div id="layoutSidenav_content">
            <main class="main-content" style="flex: 1; padding-left: 15px; padding-top: 50px;">
                <div class="main-title">
                    <h1 class="font-weight-bold">Novo Pagamento</h1>
                </div>
                <form action="pagamento.php" method="POST" style="max-width: 600px; margin: auto;">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="dataPagamento" style="display: block; margin-bottom: 5px;">Data Pagamento</label>
                        <input type="date" id="dataPagamento" name="dataPagamento" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="valorPago" style="display: block; margin-bottom: 5px;">Valor Pago</label>
                        <input type="number" id="valorPago" name="valorPago" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="metodoPagamento" style="display: block; margin-bottom: 5px;">Método de Pagamento</label>
                        <select id="metodoPagamento" name="metodoPagamento" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                            <option value="">Selecione um método</option>
                            <option value="cartao">Cartão</option>
                            <option value="dinheiro">Dinheiro</option>
                            <option value="transferencia">Transferência</option>
                            <option value="mbway">MBway</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="detalhes" style="display: block; margin-bottom: 5px;">Detalhes</label>
                        <textarea id="detalhes" name="detalhes" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" rows="4" ></textarea>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="tecnico" style="display: block; margin-bottom: 5px;">Técnico</label>
                        <select id="tecnico" name="tecnico" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                            <option value="">Selecione um técnico</option>
                            <?php
                            $sql = "SELECT idUser, nomeCompleto FROM users";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['idUser'] . "'>" . $row['nomeCompleto'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="idReparacao" style="display: block; margin-bottom: 5px;">Reparação</label>
                        <select id="idReparacao" name="idReparacao" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                            <option value="">Selecione uma reparação</option>
                            <?php
                            $sql = "SELECT idReparacao, problema, idEquipamento FROM reparacoes";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['idReparacao'] . "'>" . $row['problema']. " , (idEquipamento-". $row['idEquipamento'].")". "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" style="text-align: right;">
                        <button type="submit" name="submit" class="btn btn-primary" style="background-color: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 5px;">Enviar</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
    <script>
        // document.getElementById('user').addEventListener('change', function() {
        //     var selectedUser = this.options[this.selectedIndex].text;
        //     alert('Usuário selecionado: ' + selectedUser);
        // });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>
