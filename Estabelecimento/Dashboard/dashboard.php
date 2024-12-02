<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/NavStyle.css">
</head>
<body>
    <?php 
    session_start();
    include "../../conexao.php";

    $id_estabelecimento = $_GET['id'] ?? $_SESSION['user_id'];

    // Verifica se o ID foi passado corretamente
    if (!$id_estabelecimento) {
        echo "ID do estabelecimento não encontrado!";
        exit();
    }
        $total_mesas = isset($_SESSION['totalmesas']) && $_SESSION['totalmesas'] !== null ? (int) $_SESSION['totalmesas'] : 0;


        $total_pratos = isset($_SESSION['totalpratos']) && $_SESSION['totalpratos'] !== null ? (int) $_SESSION['totalpratos'] : 0;
        
   

    ?>
    <section class="principal">
        <div class="nav_esquerda">
            <img id="logo" src="img/g1 (4).png" alt="">
            <nav>
                <ul>
                    <a href="dashboard.php?id=<?php echo $id_estabelecimento;?>"><li><img class="img_nav" src="img/botao-home 1.png" alt="">Home</li></a>
                    <a href=""><li><img class="img_nav" src="img/perfil 2.png" alt="">Meu Perfil</li></a>
                    <a href="CadMesa.php?id=<?php echo $id_estabelecimento; ?>"><li><img class="img_nav" src="img/mesa-de-jantar 1.png" alt="">Mesas</li></a>
                    <a href="CadCardapio.php?id=<?php echo $id_estabelecimento; ?>"><li><img class="img_nav" src="img/cardapio 1.png" alt="">Cardápio</li></a>
                    <a href="ReservaPen.php"><li><img class="img_nav" src="img/sino-do-hotel 1.png" alt="">Reservas</li></a>
                    <a href=""><li><img class="img_nav" src="img/notificacao 1.png" alt="">Notificação</li></a>
                    <a href=""><li><img class="img_nav" src="img/avaliacao 8.png" alt="">Avaliações</li></a>
                    <a href="../../login/login.php"><li><img id='sair_icone' src="img/sair.png" alt="">Sair</li></a>
                </ul>
            </nav>
        </div>

        <div class="painel_direita">
            <div class="informativo">
                <div class="txts_informativo">
                    <h1 class="titulo_informativo">Bem-vindo ao seu Dashboard!</h1>
                    <p class="txt_informativo">Aqui, você encontrará uma visão abrangente das suas principais métricas, relatórios detalhados e ferramentas poderosas para maximizar seu sucesso.</p>
                </div>
                <img id="img_informativo" src="img/Telecommuting-pana 1.png" alt="">
            </div>
            <div class="card_secao">
                <div class="card">
                    <p class="num_card"><?=$total_pratos?></p>
                    <p>Pratos cadastrados</p>
                </div>
                <div class="card">
                    <p class="num_card"><?=$total_mesas?></p>
                    <p>Mesas cadastradas</p>
                </div>
                <div class="card">
                    <p class="num_card">100</p>
                    <p>Reservas realizadas</p>
                </div>
            </div>
            <div>
                <div class="container_relatorio"><img src="img/documentos.png" alt=""><a href="gerar_relatorio.php">Relatório Mensal</a></div>
                <div class="div_grafico">
                    <img class="grafico" src="img/Group 408.png" alt="">
                    <img class="grafico" src="img/Group 408 (1).png" alt="">
                </div>
            </div>
        </div>
    </section>
</body>
</html>