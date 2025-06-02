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

        <style>
            /* From Uiverse.io by 3HugaDa3 */ 
.wave-btn {
  position: relative;
  display: inline-block;
  padding: 5px 12px;
  text-align: center;
  font-size: 1rem;
  letter-spacing: 1px;
  text-decoration: none;
  color: #ffffff;
  background: #2196f3;
  cursor: pointer;
  transition: 0.3s;
  border-radius: 5px;
  overflow: hidden;
  font-family: Arial, sans-serif;
  min-width: 90px; 
  height: 36px;
  vertical-align: middle;
}

.wave-btn:hover {
  background: #1e88e5;
  box-shadow: 0 0 20px rgba(33, 150, 243, 0.7);
}

.wave-btn span {
  position: relative;
  z-index: 1;
  color: #fff;
  text-transform: uppercase;
}

.wave-btn .waves {
  position: absolute;
  top: -80px;
  left: 0;
  width: 200px;
  height: 200px;
  transition: 0.5s;
}

.wave-btn .waves::before,
.wave-btn .waves::after {
  content: "";
  position: absolute;
  width: 200%;
  height: 200%;
  top: 0;
  left: 50%;
  transform: translate(-50%, -75%);
  background: #000;
}

.wave-btn .waves::before {
  border-radius: 45%;
  background: rgba(255, 255, 255, 0.2);
  animation: waves 5s linear infinite;
}

.wave-btn .waves::after {
  border-radius: 40%;
  background: rgba(255, 255, 255, 0.1);
  animation: waves 10s linear infinite;
}

.wave-btn:hover .waves {
  top: -120px;
}

@keyframes waves {
  0% {
    transform: translate(-50%, -75%) rotate(0deg);
  }
  100% {
    transform: translate(-50%, -75%) rotate(360deg);
  }
}

.wave-btn::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(45deg, #00a8ff, #00ff7f, #00a8ff);
  background-size: 200% 200%;
  animation: gradient 15s ease infinite;
  opacity: 0;
  transition: opacity 0.5s ease;
  z-index: 0;
}

.wave-btn:hover::before {
  opacity: 1;
}

@keyframes gradient {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

.wave-btn .shimmer {
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    120deg,
    rgba(255, 255, 255, 0) 0%,
    rgba(255, 255, 255, 0.3) 50%,
    rgba(255, 255, 255, 0) 100%
  );
  z-index: 2;
  animation: shimmer 3s infinite;
}

@keyframes shimmer {
  0% {
    left: -100%;
    opacity: 0;
  }
  50% {
    opacity: 1;
  }
  100% {
    left: 100%;
    opacity: 0;
  }
}

.wave-btn::after {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  width: 5px;
  height: 5px;
  background: rgba(255, 255, 255, 0.5);
  opacity: 0;
  border-radius: 100%;
  transform: scale(1, 1) translate(-50%);
  transform-origin: 50% 50%;
}

@keyframes ripple {
  0% {
    transform: scale(0, 0);
    opacity: 1;
  }
  20% {
    transform: scale(25, 25);
    opacity: 1;
  }
  100% {
    opacity: 0;
    transform: scale(40, 40);
  }
}

.wave-btn:focus:not(:active)::after {
  animation: ripple 1s ease-out;
}

.wave-btn:active {
  transform: scale(0.97);
}

.wave-btn:active .waves::before,
.wave-btn:active .waves::after {
  top: -10px;
  transition: 0.2s;
}

        </style>
    </head>
    <body class="sb-nav-fixed">
<?php include_once 'topnav.php'; ?>
        <div id="layoutSidenav">
<?php include_once 'sidenav.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Equipamentos</h1>
                        <!-- Nova Reparação Button -->
                    <div class="new-client-button" style="text-align: right; margin-bottom: 20px;">
                        <a href="novo_equipamento.php" class="btn btn-success" style="background-color: #28a745; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">Nova Reparação</a>
                    </div>
                        <div class="card mb-4">

                            <div class="card-body">



                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID </th>
                                            <th>Clientes</th>
                                            <th>Tipo</th>
                                            <th>Marca</th>
                                            <th>Modelo</th>
                                            <th>Número de Série</th>
                                            <th>Estado</th>
                                        
                                            <th>Açãoes</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>ID </th>
                                            <th>Clientes</th>
                                            <th>Tipo</th>
                                            <th>Marca</th>
                                            <th>Modelo</th>
                                            <th>Número de Série</th>
                                            <th>Estado</th>
                                            
                                            <th>Açãoes</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    
                                    <?php
                            $sql = "SELECT e.idEquipamento, c.nome AS cliente, e.tipo, e.marca, e.modelo, e.numeroSerie, e.estado
                                    FROM Equipamentos e
                                    JOIN Clientes c ON e.idCliente = c.idCliente
                                    ORDER BY e.idEquipamento DESC";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                $estadoClass = 'estado-em-analise';
                                switch ($row['estado']) {
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
                                        $estadoClass = 'estado-em-reparacao';
                                        break;
                                }
                            ?>
                                        <tr>
                                        <td style="text-align:center"><?= $row['idEquipamento']; ?></td>
                                <td style="text-align:center"><?= $row['cliente']; ?></td>
                                <td style="text-align:center"><?= $row['tipo']; ?></td>
                                <td style="text-align:center"><?= $row['marca']; ?></td>
                                <td style="text-align:center"><?= $row['modelo']; ?></td>
                                <td style="text-align:center"><?= $row['numeroSerie']; ?></td>
                                <td style="text-align:center">
                                    <span class="estado-box <?= $estadoClass; ?>"></span>
                                    <?= $row['estado']; ?>
                                </td>
<!----------CRUD-------------------------CRUD----------------CRUD------------------CRUD------------------CRUD-------------------CRUD---------------CRUD-----------------------CRUD---------->
                                <td style="text-align:center">
                                    <form method="POST" action="eliminar_equipamento.php" style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $row['idEquipamento']; ?>">
                                        <button type="submit" style="background-color:rgb(199, 62, 53); color: #fff; padding: 5px 10px; border-radius: 5px; margin-right: 5px;"
                                                class="btn-eliminar"
                                                onclick="return confirm('Tem a certeza que deseja eliminar este registo?');">
                                            Eliminar
                                        </button>
                                    </form>
                                    <form method="GET" action="editar_equipamento.php" style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $row['idEquipamento']; ?>">
                                        <button type="submit" style="background-color:rgb(156, 192, 71); color: #fff; padding: 5px 10px; border-radius: 5px; margin-right: 5px;"
                                                class="btn-editar">
                                            Editar
                                        </button>
                                    </form>
                                        <a href="detalhe_equipamento.php?id=<?= $row['idEquipamento']; ?>" style="text-decoration:none;display:inline-block;">
                                        <button type="button" class="wave-btn">
                                            <span>Ver Detalhes</span>
                                            <div class="waves"></div>
                                            <div class="shimmer"></div>
                                        </button>
                                        </a>
                                        
                                </td>
<!----------CRUD-------------------------CRUD----------------CRUD------------------CRUD------------------CRUD-------------------CRUD---------------CRUD-----------------------CRUD---------->
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
