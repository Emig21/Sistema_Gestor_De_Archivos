<?php
require_once '../config/documentos.php';
require_once '../fpdf/fpdf.php';  // Asegúrate de que la ruta es correcta y que fpdf.php está en la carpeta correcta

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Reporte de Documentos', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function ChapterTitle($label) {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, $label, 0, 1);
        $this->Ln(5);
    }

    function ChapterBody($documentos) {
        $this->SetFont('Arial', '', 12);
        foreach ($documentos as $documento) {
            $this->Cell(0, 10, 'Titulo: ' . $documento['titulo'], 0, 1);
            $this->Cell(0, 10, 'Descripcion: ' . $documento['descripcion'], 0, 1);
            $this->Cell(0, 10, 'Categoria: ' . $documento['categoria_id'], 0, 1);
            $this->Cell(0, 10, 'Fecha: ' . $documento['fecha'], 0, 1);
            $this->Ln(5);
        }
    }
}

if (isset($_GET['tipo']) && isset($_GET['fecha'])) {
    $tipo = $_GET['tipo'];
    $fecha = $_GET['fecha'];

    $documentos = new Documentos();

    if ($tipo == 'diario') {
        $data = $documentos->obtenerReporteDiario($fecha);
    } elseif ($tipo == 'mensual') {
        $data = $documentos->obtenerReporteMensual($fecha);
    } else {
        die("Tipo de reporte no válido.");
    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->ChapterTitle('Reporte ' . ucfirst($tipo));
    $pdf->ChapterBody($data);
    $pdf->Output();
}
?>
