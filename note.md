    <script>
        <?php
        include('db.php');
        include('cliente.php');
        // Fetch number of clients created in the current month
        $sql_clients = "SELECT COUNT(*) as count FROM Clientes WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())";
        $result_clients = $conn->query($sql_clients);
        $clients_count = $result_clients->fetch_assoc()['count'];

        // Fetch equipment status counts
        $sql_equipments = "SELECT status, COUNT(*) as count FROM Equipamentos GROUP BY status";
        $result_equipments = $conn->query($sql_equipments);
        $equipments_status = [];
        while ($row = $result_equipments->fetch_assoc()) {
            $equipments_status[$row['status']] = $row['count'];
        }
        ?>

        // Data for clients created in the current month
        var clientsCount = <?php echo $clients_count; ?>;

        // Data for equipment status
        var equipmentsStatus = {
            pronto: <?php echo isset($equipments_status['pronto']) ? $equipments_status['pronto'] : 0; ?>,
            em_reparacao: <?php echo isset($equipments_status['em reparacao']) ? $equipments_status['em reparacao'] : 0; ?>,
            cancelado: <?php echo isset($equipments_status['cancelado']) ? $equipments_status['cancelado'] : 0; ?>
        };

        // Bar Chart for Clients Created
        const labels = ["Current Month"];
        const dataBar = {
            labels: labels,
            datasets: [{
                label: 'Clients Created',
                data: [clientsCount],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        };

        const configBar = {
            type: 'bar',
            data: dataBar,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        var ctxBar = document.getElementById("myBarChart").getContext('2d');
        var myBarChart = new Chart(ctxBar, configBar);

        // Pie Chart for Equipment Status
        const dataPie = {
            labels: [
                'Pronto',
                'Em Reparação',
                'Cancelado'
            ],
            datasets: [{
                label: 'Equipment Status',
                data: [equipmentsStatus.pronto, equipmentsStatus.em_reparacao, equipmentsStatus.cancelado],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        };

        const configPie = {
            type: 'pie',
            data: dataPie,
        };

        var ctxPie = document.getElementById("myPieChart").getContext('2d');
        var myPieChart = new Chart(ctxPie, configPie);

        // New Chart Example
        const dataNewChart = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'New Data',
                data: [65, 59, 80, 81, 56, 55, 40],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        const configNewChart = {
            type: 'line',
            data: dataNewChart,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        var ctxNewChart = document.getElementById("myNewChart").getContext('2d');
        var myNewChart = new Chart(ctxNewChart, configNewChart);
    </script>
















                                    <div>
                                    <canvas id="myChart"></canvas>
                                </div>
                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                <script>
                                    const clients = <?php echo json_encode($clients); ?>;
                                    console.log(<?php echo json_encode($clients); ?>);
                                    new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho','julho','agosto','setembro', 'outubro', 'novembro', 'dezembro'],
                                        datasets: [{
                                        label: 'clients',
                                        data: clients,
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







adicionar um site onde os clientes possam inserir o seu equipamento id para ver o estado da reparaçao que e dado na folha que eles levam 
depois quando der o orçamento e lançado um email , com o link one time only para ele que manda para o site onde pode ver o estado e os detalhes

---



Criar uma página onde:
- O cliente pode inserir o seu "equipamento id" (fornecido na folha entregue ao cliente) para consultar o estado da reparação.
- Quando o orçamento estiver pronto, é enviado um email ao cliente com um link "one time only" para uma página onde pode ver o estado e detalhes do orçamento/reparação.


- Formulário para inserir o ID do equipamento e mostrar o estado.
- Página acedida via link único enviado por email, mostrando detalhes do orçamento/estado.
- Adicionar lógica para gerar e guardar tokens únicos na base de dados e enviar email ao cliente. 