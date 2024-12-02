<?php
// Incluir a conexão com o banco de dados
include '../../conexao.php';
include '../../Cliente/apitest.php';

// Incluir a biblioteca FPDF
require('../../fpdf/fpdf.php');

// Definindo o mês e ano atual
$mes_atual = date('m');  // Mês no formato 2 dígitos
$ano_atual = date('Y');  // Ano atual

// Definir o filtro para o mês atual
$mes = "$ano_atual-$mes_atual";  // Ex: 2024-11 para novembro de 2024

// Lista de meses em português
$meses = [
    '01' => 'janeiro', '02' => 'fevereiro', '03' => 'março', '04' => 'abril', '05' => 'maio', '06' => 'junho',
    '07' => 'julho', '08' => 'agosto', '09' => 'setembro', '10' => 'outubro', '11' => 'novembro', '12' => 'dezembro'
];

// Obter o nome do mês em português
$nome_mes = $meses[$mes_atual] . ' ' . $ano_atual;  // Ex: novembro 2024

// Consulta para buscar todas as reservas feitas no mês atual
$query = "SELECT r.id_reserva, r.id_cliente, r.data_reserva, r.data_reserva_criacao, r.id_mesa, r.mesa_s, c.nome_cliente
          FROM reserva r
          JOIN usu_cliente c ON r.id_cliente = c.id_cliente
          WHERE DATE_FORMAT(r.data_reserva_criacao, '%Y-%m') = '$mes'";

$result = mysqli_query($con, $query);

// Verifica se há registros
if (mysqli_num_rows($result) > 0) {
    
    $pdf = new FPDF();
    $pdf->AddPage(); // Adicionar uma página
    $pdf->AddFont('DejaVu','','DejaVuSans.php'); // Adicione a fonte DejaVu
    $pdf->SetFont('DejaVu','',16); // Definir a fonte
    $pdf->Cell(0, 10, utf8_decode('Relatório de Reservas'), 0, 1, 'C'); // Centraliza o título
    $pdf->Ln(10); // Nova linha

    // Adicionando a fonte DejaVu Sans (convertida para o formato FPDF)
    // Aqui usamos a fonte convertida DejaVuSans (substitua pelo caminho correto)
    $pdf->AddFont('DejaVu', '', 'DejaVuSans.ttf', true);  // Adicione o caminho correto do arquivo .ttf
    
    // Definir a fonte para UTF-8
    $pdf->SetFont('DejaVu', '', 12);
    
    // Definir título com o mês e ano atual em português
    $pdf->Cell(0, 10, utf8_decode('Relatório de Reservas - Mês de ') . utf8_decode($nome_mes), 0, 1, 'C');
    
    // Cabeçalho da Tabela
    $pdf->Ln(10);  // Espaçamento para o cabeçalho
    $pdf->SetFont('DejaVu', '', 12);
    
    // Cálculos para centralizar a tabela
    $largura_total = 180; // Largura total da tabela (ajuste conforme necessário)
    $largura_colunas = [
        20, // ID Reserva
        60, // Nome Cliente
        20, // Mesa(s)
        30, // Data Reserva
        50  // Data Criação
    ];
    
    // Cabeçalhos
    $pdf->SetX(($pdf->GetPageWidth() - $largura_total) / 2); // Move o cursor para centralizar
    $pdf->Cell($largura_colunas[0], 10, utf8_decode('ID '), 1, 0, 'C');
    $pdf->Cell($largura_colunas[1], 10, utf8_decode('Nome Cliente'), 1, 0, 'C');
    $pdf->Cell($largura_colunas[2], 10, utf8_decode('Mesa(s)'), 1, 0, 'C');
    $pdf->Cell($largura_colunas[3], 10, utf8_decode('Data Reserva'), 1, 0, 'C');
    $pdf->Cell($largura_colunas[4], 10, utf8_decode('Data Criação'), 1, 1, 'C');
    
    // Adicionar dados de cada reserva
    while ($row = mysqli_fetch_assoc($result)) {
        $id_reserva = $row['id_reserva'];
        $nome_cliente = $row['nome_cliente'];  // Nome do cliente
        $mesa = $row['mesa_s'];  // Mesas selecionadas
        $data_reserva = $row['data_reserva'];  // Data da reserva
        $data_reserva_criacao = $row['data_reserva_criacao'];  // Data de criação da reserva

        // Depuração: Verificar os valores de data antes de tentar formatar
        if (empty($data_reserva) || empty($data_reserva_criacao)) {
            echo "Erro: Data de reserva ou data de criação não encontrada. ID Reserva: $id_reserva";
            continue;
        }

        // Verificar se o formato da data está correto no banco
        // Usando strtotime() para verificar se a data está sendo interpretada corretamente
        $data_reserva_formatada = date('d/m/Y', strtotime($data_reserva));  // Formatar data da reserva
        $data_reserva_criacao_formatada = date('d/m/Y H:i:s', strtotime($data_reserva_criacao));  // Formatar data de criação da reserva

        // Verificar se a data foi interpretada corretamente
        if ($data_reserva_formatada === false || $data_reserva_criacao_formatada === false) {
            // Se a data for inválida
            $data_reserva_formatada = "Data inválida";
            $data_reserva_criacao_formatada = "Data inválida";
        }

        // Centralizar cada linha de dados
        $pdf->SetX(($pdf->GetPageWidth() - $largura_total) / 2); // Move o cursor para centralizar
        $pdf->Cell($largura_colunas[0], 10, $id_reserva, 1, 0, 'C');
        $pdf->Cell($largura_colunas[1], 10, $nome_cliente, 1, 0, 'C');
        $pdf->Cell($largura_colunas[2], 10, $mesa, 1, 0, 'C');
        $pdf->Cell($largura_colunas[3], 10, utf8_decode($data_reserva), 1, 0, 'C');  // Exibir data formatada
        $pdf->Cell($largura_colunas[4], 10, utf8_decode($data_reserva_criacao_formatada), 1, 1, 'C');  // Exibir data de criação formatada
    }
    
    // Gerar o PDF
    $pdf->Output('relatorio_reservas_' . date('Y-m') . '.pdf', 'I');
} else {
    echo "<p>Não há reservas para o mês de " . utf8_decode($nome_mes) . ".</p>";
}
?>
