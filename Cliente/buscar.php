<?php
include '../conexao.php'; // Conexão com o banco de dados

if (isset($_GET['pesquisa'])) {
    $pesquisa = $_GET['pesquisa'];
    $pesquisa = mysqli_real_escape_string($con, $pesquisa); // Previne SQL Injection

    // Consulta o banco de dados
    $sql = "
      SELECT ue.id_estabelecimento, ue.nome_estabelecimento, ue.sobre_estab, 
             SUBSTRING_INDEX(GROUP_CONCAT(f.imgs_ambiente SEPARATOR ';'), ';', 1) AS primeira_imagem
      FROM usu_estabelecimento ue
      LEFT JOIN foto_ambiente_estab f ON ue.id_estabelecimento = f.id_estabelecimento
      WHERE ue.nome_estabelecimento LIKE '%$pesquisa%'
      GROUP BY ue.id_estabelecimento;
    ";
    $resultado = $con->query($sql);

    // Verifica se encontrou resultados
    if ($resultado->num_rows > 0) {
        // Exibe os resultados em cards
        while ($row = $resultado->fetch_assoc()) {
            // Define a imagem de fundo
            $imagemFundo = $row['primeira_imagem'] ? '../Estabelecimento/' . $row['primeira_imagem'] : 'img/default.jpg'; // Imagem padrão caso não haja foto

            echo "
            <a href='HomeEstab.php?id=" . htmlspecialchars($row['id_estabelecimento']) . "'>
                <div class='cardBuscar'  style='
                width:20em;
                height:15em;
                padding:1em;
                margin:auto;
                margin-bottom:2em;
                position: relative;
                background-image: url($imagemFundo);
                background-size: cover;
                background-position: center;
                background-repeat:no-repeat;
                color: white;
                border-radius: 10px;
                '>
                      <div class='desc'>  <h2 class='h2B'>" . htmlspecialchars($row['nome_estabelecimento']) . "</h2>
                            <p class='pB'>" . htmlspecialchars($row['sobre_estab']) . "</p> </div>
                    <div class='img-card-B' style='background-image: url($imagemFundo);'></div>
                </div>
            </a>";
        }
    } else {
        echo "Nenhum estabelecimento encontrado!";
    }
} else {
    echo "Por favor, insira um termo para pesquisa.";
}
?>
