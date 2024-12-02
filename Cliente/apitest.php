<?php
session_start();


function getCoordinates($address) {
    $apiKey = 'f3bad22e9f8f4fe5a0e26fec2d966574';
    $url = "https://api.opencagedata.com/geocode/v1/json?q=" . urlencode($address) . "&key=$apiKey";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'SeuAplicativo/1.0 (contato@seuemail.com)');
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Erro na requisição: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }

    curl_close($ch);
    $data = json_decode($response, true);

    if (empty($data) || !isset($data['results'][0])) {
        echo 'Dados decodificados: ' . print_r($data, true);
        return null;
    }

    return [
        'latitude' => $data['results'][0]['geometry']['lat'] ?? null,
        'longitude' => $data['results'][0]['geometry']['lng'] ?? null
    ];
}

// Verificar se as informações necessárias estão na sessão
if (!isset($_SESSION['id_cliente']) || !isset($_SESSION['logradourocliente'])) {
    die("Informações insuficientes na sessão.");
}

$id_cliente = $_SESSION['id_cliente'];
$logradouro_cliente = $_SESSION['logradourocliente'];

// Obter a latitude e longitude do cliente
$query = "SELECT latitude, longitude FROM localidade WHERE id_localidade = (SELECT id_localidade FROM usu_cliente WHERE id_cliente = ?)";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();
$localidadeData = $result->fetch_assoc();
$stmt->close();

if (!$localidadeData) {
    die("Localidade não encontrada.");
}

$clientLatitude = $localidadeData['latitude'] ?? null;
$clientLongitude = $localidadeData['longitude'] ?? null;

if (!$clientLatitude || !$clientLongitude) {
    $coordinates = getCoordinates($logradouro_cliente);
    if (!$coordinates || !$coordinates['latitude'] || !$coordinates['longitude']) {
        die("Não foi possível obter as coordenadas.");
    }
    $clientLatitude = $coordinates['latitude'];
    $clientLongitude = $coordinates['longitude'];

    $updateQuery = "UPDATE localidade SET latitude = ?, longitude = ? WHERE id_localidade = (SELECT id_localidade FROM usu_cliente WHERE id_cliente = ?)";
    $updateStmt = $con->prepare($updateQuery);
    $updateStmt->bind_param("ddi", $clientLatitude, $clientLongitude, $id_cliente);
    if (!$updateStmt->execute()) {
        die("Erro ao atualizar coordenadas na tabela localidade: " . $con->error);
    }
    $updateStmt->close();
}

$radius = 10;

function haversineGreatCircleDistance($lat1, $lon1, $lat2, $lon2) {
    $earthRadius = 6371; // Raio da Terra em km
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);
    $a = sin($dLat / 2) * sin($dLat / 2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLon / 2) * sin($dLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    return $earthRadius * $c;
}

// Obter estabelecimentos próximos
$query = "
     SELECT ue.id_estabelecimento, ue.nome_estabelecimento, l.logradouro, l.latitude, l.longitude,l.cidade, l.complemento, ue.sobre_estab, ue.regras_jurisdicoes, ue.telefone_estab, 
           SUBSTRING_INDEX(GROUP_CONCAT(f.imgs_ambiente SEPARATOR ';'), ';', 1) AS primeira_imagem,
           SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(f.imgs_ambiente SEPARATOR ';'), ';', 2), ';', -1) AS segunda_imagem,
           SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(f.imgs_ambiente SEPARATOR ';'), ';', 3), ';', -1) AS terceira_imagem,
           SUBSTRING_INDEX(SUBSTRING_INDEX(GROUP_CONCAT(f.imgs_ambiente SEPARATOR ';'), ';', 4), ';', -1) AS quarta_imagem
    FROM usu_estabelecimento ue
    JOIN localidade l ON ue.id_localidade = l.id_localidade
    LEFT JOIN foto_ambiente_estab f ON ue.id_estabelecimento = f.id_estabelecimento
    GROUP BY ue.id_estabelecimento;
";
$result = $con->query($query);

$nearbyEstablishments = [];
while ($row = $result->fetch_assoc()) {
    // Verifique se latitude e longitude estão definidas
    $estabLatitude = $row['latitude'] ?? null;
    $estabLongitude = $row['longitude'] ?? null;

    if ($estabLatitude !== null && $estabLongitude !== null) {
        $distance = haversineGreatCircleDistance($clientLatitude, $clientLongitude, $estabLatitude, $estabLongitude);
        if ($distance <= $radius) {
            $row['distance'] = number_format($distance, 1);

            // Obter serviços do restaurante
            $id_restaurante = $row['id_estabelecimento'];
            $queryServicos = "SELECT nome_serv_oferecido FROM serv_oferecido WHERE id_estabelecimento = ?";
            $stmtServicos = $con->prepare($queryServicos);
            $stmtServicos->bind_param("i", $id_restaurante);
            $stmtServicos->execute();
            $resultServicos = $stmtServicos->get_result();

            $servicos = [];
            while ($rowServicos = $resultServicos->fetch_assoc()) {
                $servicosArray = explode(',', $rowServicos['nome_serv_oferecido']);
                foreach ($servicosArray as $servico) {
                    $servicos[] = trim($servico);
                }
            }
            $stmtServicos->close();

            // Adiciona serviços ao array de estabelecimentos
            $row['servicos'] = $servicos;

            // Aqui você já tem as imagens definidas na consulta SQL
            // Portanto, não é necessário redefini-las
            // Verifique se os valores das imagens estão corretos
            $nearbyEstablishments[] = $row;
        }
    }
}

// Exibir resultados
if (empty($nearbyEstablishments)) {
    echo "";
} else {
    foreach ($nearbyEstablishments as $establishment) {
        // Exibir informações do estabelecimento
   //     echo "<p>ID: " . $establishment['id_estabelecimento'] . 
       //      " - Nome: " . $establishment['nome_estabelecimento'] . 
      //       " - Logradouro: " . $establishment['logradouro'] . 
      //       " - Distância: " . $establishment['distance'] . " km" .
      //       " - Primeira Imagem: <img src='" . $establishment['primeira_imagem'] . "' alt='Imagem de " . $establishment['nome_estabelecimento'] . "' style='max-width: 200px;'></p>";
        
        // Exibe serviços associados
        if (!empty($establishment['servicos'])) {
      //      echo "<p>Serviços: " . implode(", ", $establishment['servicos']) . "</p>";
        }
    }
}


?>
