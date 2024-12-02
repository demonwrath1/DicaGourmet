<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../conexao.php';
include 'apitest.php';
require('../fpdf/fpdf.php');

function gerarRelatorio() {
    global $con; // Certifique-se de que $con está acessível aqui
    
    // Consulta SQL para obter os 10 primeiros estabelecimentos com mais reservas
    $sql = "SELECT e.id_estabelecimento, e.nome_estabelecimento, COUNT(r.id_reserva) AS total_reservas
            FROM reserva r
            JOIN usu_estabelecimento e ON r.id_estabelecimento = e.id_estabelecimento
            GROUP BY e.id_estabelecimento, e.nome_estabelecimento   -- Agrupando por id_estabelecimento para garantir contagem correta
            ORDER BY total_reservas DESC
            LIMIT 10";  // Limitar para 10 resultados
    
    // Executa a consulta
    $resultado = $con->query($sql);
    
    if (!$resultado) {
        die("Erro na consulta: " . $con->error);
    }

    if ($resultado->num_rows > 0) {
        // Criação do objeto PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        
        // Usando a fonte Arial, que já suporta caracteres acentuados
        $pdf->SetFont('Arial', 'B', 16); // Definindo a fonte para o título
        $pdf->Cell(190, 10, "Relatorio de Restaurantes com mais Reservas", 0, 1, 'C'); // Título sem utf8_decode()
        $pdf->Ln(10); // Linha em branco
        
        // Cabeçalho da tabela
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(130, 10, "Restaurante", 1, 0, 'C');
        $pdf->Cell(60, 10, "Total de Reservas", 1, 1, 'C');
        
        // Definindo a fonte para o conteúdo
        $pdf->SetFont('Arial', '', 12);
        
        // Preenchendo a tabela com os dados
        while ($linha = $resultado->fetch_assoc()) {
            // Depuração: Exibir os valores de id_estabelecimento e nome
            // echo "ID Estabelecimento: " . $linha['id_estabelecimento'] . " - Nome: " . $linha['nome_estabelecimento'] . " - Reservas: " . $linha['total_reservas'] . "<br>";

            $pdf->Cell(130, 10, $linha['nome_estabelecimento'], 1, 0, 'C');
            $pdf->Cell(60, 10, $linha['total_reservas'], 1, 1, 'C');
        }
        
        // Exibe o PDF no navegador
        $pdf->Output();
    } else {
        echo "Nenhum resultado encontrado.";
    }
    
    $con->close();
}

// Gerar o relatório
gerarRelatorio();
?>
