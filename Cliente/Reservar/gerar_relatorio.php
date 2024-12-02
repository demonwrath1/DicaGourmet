<?php
require('../../fpdf/fpdf.php'); // Inclua o arquivo da biblioteca FPDF
include '../../conexao.php';
session_start();

// Criar uma nova instância do FPDF
$pdf = new FPDF();
$pdf->AddPage(); // Adicionar uma página
$pdf->AddFont('DejaVu','','DejaVuSans.php'); // Adicione a fonte DejaVu
$pdf->SetFont('DejaVu','',16); // Definir a fonte

// Adicionar título ao PDF
$pdf->Cell(0, 10, utf8_decode('Relatório de Reservas'), 0, 1, 'C'); // Centraliza o título
$pdf->Ln(10); // Nova linha

// Adicionar cabeçalho da tabela com novas larguras
$pdf->SetFont('DejaVu','',12);
$pdf->Cell(20, 10, utf8_decode('Mesa'), 1); // Mesa: largura 25
$pdf->Cell(35, 10, utf8_decode('Data Reserva'), 1); // Data Reserva: largura 35
$pdf->Cell(60, 10, utf8_decode('Nome Completo'), 1); // Nome Completo: largura 60
$pdf->Cell(30, 10, utf8_decode('Horário'), 1); // Horário: largura 30
$pdf->Cell(30, 10, utf8_decode('Qtd. Pessoas'), 1); // Quantidade de Pessoas: largura 30
$pdf->Ln(); // Nova linha

// Consulta ao banco de dados
$id_reserva = $_SESSION['id_reserva']; 
$sql = "SELECT mesa_s, data_reserva, nome_completo, horario_reserva, qnt_pessoas FROM reserva WHERE id_reserva = $id_reserva";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Saída dos dados de cada linha
    $pdf->SetFont('DejaVu','',12);
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(20, 10, utf8_decode($row['mesa_s']), 1); // Mesa
        $pdf->Cell(35, 10, utf8_decode($row['data_reserva']), 1); // Data Reserva
        $pdf->Cell(60, 10, utf8_decode($row['nome_completo']), 1); // Nome Completo
        $pdf->Cell(30, 10, utf8_decode($row['horario_reserva']), 1); // Horário
        $pdf->Cell(30, 10, utf8_decode($row['qnt_pessoas']), 1); // Quantidade de Pessoas
        $pdf->Ln(); // Nova linha
    }
} else {
    $pdf->Cell(0, 10, utf8_decode('Nenhuma reserva encontrada.'), 0, 1);
}

// Fechar a conexão com o banco de dados
$con->close();

// Gerar e baixar o PDF
$pdf->Output('I', 'relatorio_reservas.pdf'); // 'I' para visualizar no navegador
?>
