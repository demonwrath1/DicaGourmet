<?php
session_start();
include "../conexao.php";

// Verificando se a requisição está vindo via AJAX e se o id_cliente está na URL
if (isset($_GET['id_cliente'])) {
    $id_cliente = $_GET['id_cliente']; // Usando o valor enviado via GET

    // Consulta para buscar informações dos estabelecimentos das reservas do cliente
    $sql = "
        SELECT 
            r.id_reserva,
            r.horario_reserva,
            r.data_reserva,
            e.id_estabelecimento,
            e.nome_estabelecimento,
            l.logradouro,  -- Logradouro agora vindo da tabela localidade
           
            (SELECT SUBSTRING_INDEX(GROUP_CONCAT(f.imgs_ambiente SEPARATOR ';'), ';', 1) 
             FROM foto_ambiente_estab f 
             WHERE f.id_estabelecimento = e.id_estabelecimento
             LIMIT 1) AS primeira_imagem
        FROM reserva r
        INNER JOIN usu_estabelecimento e ON r.id_estabelecimento = e.id_estabelecimento
        INNER JOIN localidade l ON e.id_localidade = l.id_localidade  
        WHERE r.id_cliente = ?
        ORDER BY r.data_reserva_criacao DESC
    ";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id_cliente);
    $stmt->execute();
    $result = $stmt->get_result();

    $reservas = [];
    while ($row = $result->fetch_assoc()) {
        $reservas[] = $row;
    }

    // Retornando os dados das reservas em formato JSON
    echo json_encode($reservas);
}
?>