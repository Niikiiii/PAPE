<?php
// filepath: c:\xampp\htdocs\xpto\ppdf.php
session_start();

include_once 'db.php';
require('fpdf/fpdf.php'); // Include FPDF for PDF generation

class PDF extends FPDF
{
    // Add a header with a logo
    function Header()
    {
        // Add the logo (replace 'logo.png' with your actual logo file path)
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, '', 0, 1); // Add some space
        $this->Image('logo.png', 10, 10, 30); // Logo at top-left corner (x=10, y=10, width=30)
        $this->SetY(20); // Adjust Y position after the logo
    }

    // Add a footer with rules
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-30);
        $this->SetFont('Arial', 'I', 10);
        $this->MultiCell(0, 10, "Rules:\n1. This document is confidential.\n2. Do not share without permission.\n3. Handle with care.", 0, 'C');
    }

    // Fancy table function
    function FancyTable($header, $data)
    {
        // Colors, line width, and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');

        // Header
        $w = array(60, 130); // Column widths
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        }
        $this->Ln();

        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        // Data
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill; // Alternate row colors
        }

        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate_pdf'])) {
    // Retrieve the selected data from the form
    $idEquipamento = $_POST['idEquipamento'];

    // Fetch data from the database
    $sql = "SELECT * FROM equipamentos WHERE idEquipamento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idEquipamento);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Prepare data for the table
        $header = ['Column', 'Value'];
        $data = [];
        foreach ($row as $column => $value) {
            $data[] = [ucfirst($column), $value];
        }

        // Create a new PDF
        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        // Add a title
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Equipamento Report', 0, 1, 'C');
        $pdf->Ln(10);

        // Add the table
        $pdf->FancyTable($header, $data);

        // Output the PDF to the browser
        $pdf->Output('I', 'equipamento_report.pdf');
        exit();
    } else {
        echo "<script>alert('No data found for the selected Equipamento.');</script>";
    }
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
    <title>Imprimir - Equipamento</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="tables.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Equipamentos
                        </a>
                        <a class="nav-link" href="cliente.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Clientes
                        </a>
                        <a class="nav-link" href="orçamento.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Orçamento
                        </a>
                        <a class="nav-link" href="reparaçoes.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Reparaçoes
                        </a>
                        <a class="nav-link" href="imprimir.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Imprimir
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container mt-5">
                    <h1>Generate Equipamento Report</h1>
                    <form method="POST" action="imprimir.php">
                        <div class="form-group">
                            <label for="idEquipamento">Select Equipamento ID:</label>
                            <select name="idEquipamento" id="idEquipamento" class="form-control" required>
                                <option value="">-- Select --</option>
                                <?php
                                // Fetch all equipamentos from the database
                                $sql = "SELECT idEquipamento, tipo FROM equipamentos";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['idEquipamento'] . '">' . $row['idEquipamento'] . ' - ' . $row['tipo'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" name="generate_pdf" class="btn btn-primary mt-3">Generate PDF</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>