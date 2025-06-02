<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Charts - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <?php include('topnav.php');?>
    <div id="layoutSidenav">
        <?php include('sidenav.php');?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Charts</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Charts</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            Chart.js is a third party plugin that is used to generate the charts in this template. The charts below have been customized - for further customization options, please visit the official
                            <a target="_blank" href="https://www.chartjs.org/docs/latest/">Chart.js documentation</a>
                            .
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Bar Chart Example 1
                                </div>
                                <div class="card-body">
                                    <canvas id="myBarChart1"></canvas>
                                </div>
                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                <script>
                                    const ctx1 = document.getElementById('myBarChart1').getContext('2d');
                                    new Chart(ctx1, {
                                        type: 'bar',
                                        data: {
                                            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                                            datasets: [{
                                                label: '# of Votes',
                                                data: [12, 19, 3, 5, 2, 3],
                                                backgroundColor: [
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
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
                                <div class="card-footer small text-muted">Updated just now</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Bar Chart Example 2
                                </div>
                                <div class="card-body">
                                    <canvas id="myBarChart2"></canvas>
                                </div>
                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                <script>
                                    const ctx2 = document.getElementById('myBarChart2').getContext('2d');
                                    new Chart(ctx2, {
                                        type: 'bar',
                                        data: {
                                            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                                            datasets: [{
                                                label: 'Dataset 1',
                                                data: [65, 59, 80, 81, 56, 55, 40],
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
                                <div class="card-footer small text-muted">Updated just now</div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <!-- Remove the following lines to avoid conflicts -->
        <!-- <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
</body>
</html>