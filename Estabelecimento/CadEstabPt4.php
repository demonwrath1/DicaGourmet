<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estiloCad.css">
    <script src="https://kit.fontawesome.com/7489919d60.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
    session_start();
    require_once '../conexao.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $botaoplano = $_POST['btn_plano'];
        $redirecionar = '';
        $valor = '';
        $id_estabelecimento = $_SESSION['id_estabelecimento'];
        switch ($botaoplano) {
            case 'Prime':
                $valor = "R$ 19,99";
                $redirecionar = "PlanoPrime.php";
                break;
            case 'Deluxe':
                $valor = "R$34,99";
                $redirecionar = "PlanoDeluxe.php";
                break;
            case 'Elegance':
                $valor = "R$ 49,99";
                $redirecionar = "PlanoElegance.php";
                break;
            default:
                echo "Botão não reconhecido.";
                exit; 
        }

        $sqlplano = "INSERT INTO plano (nome, valor, id_estabelecimento) values ('$botaoplano', '$valor', $id_estabelecimento)";
        $adicionar = mysqli_query($con, $sqlplano);
        if ($redirecionar) {
            header("Location: $redirecionar");
            exit; 
        }
    }
    ?>
    <main>
        <section class="section_nav_cadastro">
            <div class="close_nav">
               <a href="../LandingPage/cadastro.php"> <img src="img/close.png" alt=""></a>
            </div>
                <div class="nav_cadastro">
                        <div class="opcao_nav margin">
                            <p>Dados do Estabelecimento</p>
                            <button class="num_opcao_nav"><a href="CadEstabPt1.php">1</a></button>
                        </div>
                        <div class="opcao_nav margin">
                            <p>Informações Adicionais</p>
                            <button class="num_opcao_nav"><a href="CadEstabPt2.php">2</a></button>
                        </div>
                        <div class="opcao_nav margin">
                            <p>Personalizar Perfil</p>
                            <button class="num_opcao_nav"><a href="CadEstabPt3.php">3</a></button>
                        </div>
                        <div class="opcao_nav" id="no_margim">
                            <p>Pagamento</p>
                            <button class="num_opcao_nav" id="btn_selecionado"><a href="#">4</a></button>
                        </div>
                </div>
            </section>

        <section class="section_form_cadastro">
           
            <form id="form_plano" method="post">
                <h2 class="titulo_form">Escolha seu plano ideal</h2>
                    <div class="container_plano">
                        <div class="plano">
                            <img src="img/logo plano prime.png" class="logo_plano" alt="">
                            <h3 class="titulo_plano">Prime</h3>
                            <ul>
                                <li><img class="correto_icone" src="img/correto 1.png" alt=""><p>100 reservas mensais</p></li>
                                <li><img src="img/correto 1.png" class="correto_icone" alt=""><p>Acesso em um dispositivo</p></li>
                                <li><img src="img/correto 1.png" class="correto_icone" alt=""><p>Acesso a avaliação de usuários</p></li>
                                <li><img src="img/correto 1.png" class="correto_icone" alt=""><p>Divulgação básica</p></li>
                            </ul>
                            <p class="preco_plano">R$19,99</p>
                            <input name="btn_plano" value="Prime" id="btn_plano_prime" class="btn_plano" onclick="prime()" type="submit" value="Continuar">
                        </div>
                        <div class="plano">
                            <img src="img/plano-deluxe-logo.png" class="logo_plano" alt="">
                            <h3 class="titulo_plano">Deluxe</h3>
                            <ul>
                                <li><img src="img/correto 1.png" class="correto_icone" alt=""><p>250 reservas mensais</p></li>
                                <li><img src="img/correto 1.png" class="correto_icone" alt=""><p>Acesso em dois dispositivo</p></li>
                                <li><img src="img/correto 1.png" class="correto_icone" alt=""><p>Acesso a avaliação de usuários</p></li>
                                <li><img src="img/correto 1.png" class="correto_icone" alt=""><p>Personalização de perfil</p></li>
                            </ul>
                            <p class="preco_plano">R$34,99</p>
                            
                            <input name="btn_plano" id="btn_plano_deluxe" value="Deluxe" class="btn_plano" onclick="deluxe()" type="submit" value="Continuar">
                        </div>
                        <div class="plano">
                            <img src="img/plano-elegance-logo.png" class="logo_plano" alt="">
                            <h3 class="titulo_plano">Elegance</h3>
                            <ul>
                                <li><img src="img/correto 1.png" class="correto_icone" alt=""><p>Reservas ilimitadas</p></li>
                                <li><img src="img/correto 1.png" class="correto_icone" alt=""><p>Acesso livre</p></li>
                                <li><img src="img/correto 1.png" class="correto_icone" alt=""><p>Acesso a avaliação de usuários</p></li>
                                <li><img src="img/correto 1.png" class="correto_icone" alt=""><p>Divulgação básica</p></li>
                            </ul>
                            <p class="preco_plano">R$49,99</p>

                            <input onclick="elegance()" id="btn_plano_elegance" value="Elegance" name="btn_plano" class="btn_plano" type="submit" value="Continuar">
                        </div>
                    </div>
             
</form>
        </section>
    </main>
   
</body>
</html>