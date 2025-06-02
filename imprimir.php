<?php
// filepath: c:\xampp\htdocs\xpto\ppdf.php
session_start();

include_once 'db.php';
require('fpdf/fpdf.php'); // Include FPDF for PDF generation

class PDF extends FPDF
{
    // Add a header with "JK" as a logo
    function Header()
    {
        // Set font for the "JK" logo
        $this->SetFont('Arial', 'B', 20); // Bold, size 20
        $this->SetTextColor(0, 0, 0); // Black color
        $this->Text(10, 15, 'folha de reparacao'); // Position (x=10, y=15) and text "JK"
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
$header = ['Campo', 'Valor'];
$data = [];
foreach ($row as $column => $value) {
    $data[] = [ucfirst($column), $value];
}
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(0, 15, utf8_decode('folha de reparacao'), 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, utf8_decode('Equipamento Report'), 0, 1, 'C');
$pdf->Ln(5);

// Cabeçalho da tabela igual ao preview
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(211, 47, 47); // vermelho
$pdf->SetTextColor(255);
$pdf->Cell(60, 10, 'Campo', 1, 0, 'C', true);
$pdf->Cell(120, 10, 'Valor', 1, 1, 'C', true);

// Dados da tabela igual ao preview
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0);
$fill = false;
foreach ($data as $row) {
    if ($fill) {
        $pdf->SetFillColor(224, 235, 255); // azul claro
    } else {
        $pdf->SetFillColor(255, 255, 255); // branco
    }
    $pdf->Cell(60, 8, utf8_decode($row[0]), 1, 0, 'L', true);
    $pdf->Cell(120, 8, utf8_decode($row[1]), 1, 1, 'L', true);
    $fill = !$fill;
}

// Rodapé igual ao preview (já está no método Footer do PDF)
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
    <?php include 'topnav.php'; ?>
    <div id="layoutSidenav">
<?php include 'sidenav.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container mt-5">
                    <h1>Generate Equipamento Report</h1>
                    <form method="POST" action="imprimir.php">
                        <div class="form-group">
                            <label for="idEquipamento">Select Equipamento ID:</label>
                            <select name="idEquipamento" id="idEquipamento" class="form-control" style="width: 300px;" required>
                                <option value="">       Select     </option>
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

<div id="pdf-preview" style="
    position:fixed; 
    right:40px; 
    top:80px; 
    background:#fff; 
    border:1px solid #ccc; 
    padding:32px 36px 90px 36px; 
    min-width:420px; 
    min-height:420px; 
    z-index:1000; 
    box-shadow:0 2px 16px #aaa;
    border-radius: 10px;
    display:none;
">
    <div style="text-align:center; margin-bottom:18px;">
        <span style="font-size:28px; font-weight:bold;">folha de reparacao</span>
    </div>
    <hr style="margin:12px 0;">
    <div style="text-align:center; margin-bottom:18px;">
        <span style="font-size:20px; font-weight:bold;">Equipamento Report</span>
    </div>
    <table class="table table-bordered" id="pdf-preview-table" style="
        width:100%; 
        font-size:16px; 
        background:#fafbfc;
        margin-bottom: 30px;
    ">
        <!-- Conteúdo dinâmico -->
    </table>
    <div style="
        position:absolute; 
        bottom:16px; 
        left:0; 
        width:100%; 
        font-size:13px; 
        color:#555; 
        text-align:center;
    ">
        <hr style="margin:8px 0;">
        <div>
            <strong>Rules:</strong><br>
            1. This document is confidential.<br>
            2. Do not share without permission.<br>
            3. Handle with care.
        </div>
    </div>
</div>

                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('idEquipamento');
    const preview = document.getElementById('pdf-preview');
    const previewTable = document.getElementById('pdf-preview-table');

    // Esconde preview inicialmente
    preview.style.display = 'none';

    // Mostra preview ao selecionar um equipamento
    select.addEventListener('change', function(e) {
        const id = select.value;
        if (id) {
            fetchPreview(id);
        } else {
            preview.style.display = 'none';
        }
    });

    function fetchPreview(id) {
        fetch('get_equipamento.php?id=' + id)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    let html = '';
                    for (const [key, value] of Object.entries(data)) {
                        html += `<tr><th style="width:40%; background:#f5f5f5;">${key}</th><td>${value}</td></tr>`;
                    }
                    previewTable.innerHTML = html;
                    preview.style.display = 'block';
                } else {
                    preview.style.display = 'none';
                }
            });
    }
});
</script>
</body>
</html>