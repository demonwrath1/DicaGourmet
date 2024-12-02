<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/stylePerfilEstab.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
    <?php
    include '../conexao.php';
    include 'apitest.php';

    // Captura o ID do estabelecimento da URL
    $establishmentId = $_GET['id'] ?? null;
    $establishmentData = null;

    // Procura o estabelecimento correspondente
    if (isset($nearbyEstablishments) && count($nearbyEstablishments) > 0) {
        foreach ($nearbyEstablishments as $establishment) {
            if ($establishment['id_estabelecimento'] == $establishmentId) {
                $establishmentData = $establishment;
               
                break;
            }
        }
    }

    // Se não encontrar, redirecionar ou mostrar uma mensagem de erro
    if (!$establishmentData) {
        echo "<p>Estabelecimento não encontrado.</p>";
        exit;
    }
    
    ?>
   <?php
 echo "<script>console.log('Latitude: " . $establishmentData['latitude'] . "', 'Longitude: " . $establishmentData['longitude'] . "');</script>";
?>
    <main>
        <section class="principal">
            <div class="header">
                <img src="img/logo.png" id="logo">
                <nav class="nav_header">
                    <ul>
                        <li><a href="">Home</a></li>
                        <li><a href="">Perfil</a></li>
                        <li><a href="">Histórico</a></li>
                        <li><a href="">Favoritos</a></li>
                        <li><a href="">Minhas Reservas</a></li>
                    </ul>
                </nav>
            </div>

            <div class="container_principal">
                <div class="div_esquerda">
                    <img style="
                    border-radius: 10px;
                    border: 2px solid white;
                    
                    " id="img_principal_div" src="../Estabelecimento/<?php echo $establishmentData['primeira_imagem']; ?>" alt="">
                    <div class="imgs_pequenas">
                        <img class="img_pequena " style ="
                       height: 16vh;
                       width: 13vw;
                       border-radius: 10px;
                        border: 2px solid white;
                         margin-bottom: 3em;
                        "
                        
                        src="../Estabelecimento/<?=$establishment['segunda_imagem']?>" alt="">
                        <img class="img_pequena "
                        style ="
                       height: 16vh;
                       width: 13vw;
                       border-radius: 10px;
                       border: 2px solid white;
                        margin-bottom: 3em;
                        "
                        
                        src="../Estabelecimento/<?=$establishment['terceira_imagem']?>" alt="">
                        <img
                        style ="
                       height: 16vh;
                       width: 13vw;
                       border-radius: 10px;
                    border: 2px solid white;
                     margin-bottom: 3em;
                        "
                        class="img_pequena" src="../Estabelecimento/<?=$establishment['quarta_imagem']?>" alt="">
                    </div>
                </div>
                <div class="div_direita">
                    <h1 id="titulo_div_direita"><?php echo $establishmentData['nome_estabelecimento']; ?></h1>
                    <div class="div_servicos_oferecidos">
                        <?php
                       if (isset($servicos)) {
                        foreach ($servicos as $servico) {
                            // Define a imagem com base no serviço
                            $imagem = '';
                            switch ($servico) {
                                case 'pets':
                                    $imagem = 'img/pet 1.png';
                                    break;
                                case 'ar_condicionado':
                                    $imagem = 'img/air-conditioning 1.png';
                                    break;
                                case 'juntar_mesa':
                                    $imagem = 'img/mesa-e-cadeiras-de-restaurante.png';
                                    break;
                                case 'estacionamento':
                                    $imagem = 'img/carro-garagem.png';
                                    break;

                                case 'espaco_infantil':
                                $imagem = 'img/menino-menino.png';
                                break;   

                                case 'ar_livre':
                                $imagem = 'img/ar-livre.png';
                                break;

                                case 'wifi':
                                $imagem = 'img/Group 366.png';
                                break;  

                                case 'rodizio':
                                $imagem = 'img/garfo-e-faca-de-prato.png';
                                break;          

                                case 'musica':
                                    $imagem = 'img/nota-musical.png';
                                    break;  

                                case 'acessibilidade':
                                $imagem = 'img/acessibilidade.png';
                                 break;

                                case 'espaço_para_eventos':
                                $imagem = 'img/festa.png';
                                break;  

                                case 'tv_telao':
                                $imagem = 'img/televisao-de-ecra-plano.png';
                                break; 
                                
                                case 'buffet' : 
                                    $imagem = 'img/cruz-de-garfo-e-faca-em-um-prato-para-nao-comer.png';
                                    break;
                                

                               
                                default:
                                    $imagem = ''; 
                            }
                    
                            echo "
                            <div class='border serv'>
                                <img src='$imagem' alt=''>
                                <p>$servico</p>
                            </div>";
                        }
                    }
                        ?>
                    </div>
                    <h2 class="titulo_desc">Descrição</h2>
                    <p class="txt_desc"><?=$establishmentData['sobre_estab']?></p>

                    <h2 class="titulo_desc">Termos de uso</h2>
                    <p class="txt_desc"><?=$establishmentData['regras_jurisdicoes']?></p>
                    <a href="Reservar/reserva.php?id=<?php echo $establishmentId;?>" id="btn_reservar">Reserve já</a>
                </div>
            </div>
        </section>
                   
        <section class="section_cardapio">
            <h1>Menu</h1>
            <nav class="nav_cardapio">
                <ul>
                    <li>Hamburguer</li>
                    <li>Bebidas</li>
                    <li>Acompanhamento</li>
                </ul>
            </nav>
            <?php
include '../conexao.php';
if ($con) {
    $sqlc = "SELECT * FROM cardapio WHERE id_estabelecimento = $establishmentId";
    $result = mysqli_query($con, $sqlc);

    if (!$result) {
        die("Erro na consulta: " . mysqli_error($con));
    }

    // Verifica se existem pratos cadastrados
    if (mysqli_num_rows($result) > 0) {
        ?>
        <div class="container_cardapio_comida">
            <div class="row">
                <?php while ($prato = mysqli_fetch_assoc($result)): ?>
                    <div class="col-md-4">
                        <div class="div_comida">
                            <img class="foto_prato" src="<?php echo '../Estabelecimento/Dashboard/' . $prato['foto_prato']; ?>" alt="">
                            <h3><?php echo $prato['nome_prato']; ?></h3>
                            <p id="descricaoprato"><?php echo $prato['descricao_prato']; ?></p>
                            <p class="valor_prato">R$ <?php echo number_format($prato['valor_prato'], 2, ',', '.'); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php
    } else {
        // Exibe mensagem se não houver pratos cadastrados
        echo "<div class='container_cardapio_comida'><p style='color: rgb(99, 99, 99);'><b><i>Este estabelecimento não cadastrou seu menu.</i></b></p></div>";
    }
} else {
    die("Erro na conexão: " . mysqli_connect_error());
}
?>
        </section>

        <section class="section_localizacao">
            <div class="localizacao_esquerda">
                <h1>Localização</h1>
                <nav>
                    <a href=""><?=$establishmentData['cidade']?></a>
                   
                </nav>

                <div class="div_info_local">
                    <h3>Endereço</h3>
                    <p><?php echo $establishmentData['logradouro'] . ', ' . $establishmentData['complemento'] ; ?></p>
                </div>

                <div class="div_info_local">
                    <h3>Telefone</h3>
                    <p><?=$establishmentData['telefone_estab']?></p> 
                </div>
            </div>

            <div class="mapa">
            <div id="map" style="width: 80%; height: 600px; margin-left: 20em; border-radius: 1.3em;"></div>
            </div>
        </section>

        <section class="section_avaliacao">
            <h1 id="titulo_aval">Avaliações</h1>
            <div class="cards_aval">
                
                <div class="card_aval">
                    <div class="header_cad">
                        <img class="foto_perfil" src="img/Ellipse 48.png" alt="">
                        <h2>Pizzagamer01</h2>
                    </div>
                    <p>É um lugar onde a paixão pela comida se reflete em cada detalhe, desde a escolha dos ingredientes até o atendimento amigável. Se você está em busca de uma refeição deliciosa e um.</p>
                    <div class="footer_card">
                        <img class="estrela_aval" src="img/avaliacao 4.png" alt="">
                        <p>3 days ago</p>
                    </div>
                </div>
                <!-- Repita para outras avaliações -->
            </div>
        </section>
    </main>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtenha as coordenadas do PHP
        let latitude = <?php echo isset($establishmentData['latitude']) ? $establishmentData['latitude'] : 'null'; ?>;
        let longitude = <?php echo isset($establishmentData['longitude']) ? $establishmentData['longitude'] : 'null'; ?>;

        if (latitude !== null && longitude !== null) {
            // Inicializa o mapa com as coordenadas
            let map = L.map('map').setView([latitude, longitude], 15);

            // Adiciona o tile layer do OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            // Adiciona um marcador no endereço
            L.marker([latitude, longitude]).addTo(map)
                .bindPopup("<?php echo $establishmentData['logradouro']; ?>")
                .openPopup();
        } else {
            console.error("Coordenadas inválidas. Latitude ou longitude estão faltando.");
        }
    });
</script>
</body>
</html>