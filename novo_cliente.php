<?php
include('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Cliente</title>
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
            <h1 class="font-weight-bold">Novo Cliente</h1>
        </div>
        <form action="gravar_cliente.php" method="POST" style="max-width: 600px; margin: auto;">
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="client-name" style="display: block; margin-bottom: 5px;">Nome do Cliente</label>
                <input type="text" id="client-name" name="nome" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="client-email" style="display: block; margin-bottom: 5px;">Email</label>
                <input type="email" id="client-email" name="email" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="client-phone" style="display: block; margin-bottom: 5px;">Telefone</label>
                <input type="tel" id="client-phone" name="telemovel" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="client-nif" style="display: block; margin-bottom: 5px;">NIF</label>
                <input type="text" id="client-nif" name="nif" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" >
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="household" style="display: block; margin-bottom: 5px;">Morada</label>
                <textarea id="household" name="morada" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required></textarea>
            </div>
<!----------CRUD-------------------------CRUD----------------CRUD------------------CRUD------------------CRUD-------------------CRUD---------------CRUD-----------------------CRUD---------->
            <div class="form-group" style="text-align: right;">
                <button type="submit" name="submit" class="btn btn-primary" style="background-color: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 5px;">Enviar</button>
            </div>
<!----------CRUD-------------------------CRUD----------------CRUD------------------CRUD------------------CRUD-------------------CRUD---------------CRUD-----------------------CRUD---------->

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