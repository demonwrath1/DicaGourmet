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
    $chavepix = uniqid();
   
    
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
                <form id="payment-form" method="post" action="Dashboard/dashboard.php">
                    
                        <div id="confirmation-message"  >
                            <p>Após realizar o pagamento, por favor, aguarde a confirmação. Você receberá um e-mail de confirmação assim que a transação for processada.
                                Se após dois minutos o email não chegar, o email digitado é inválido.
                            </p>
                        </div>
            
                        <button  id="continuar">Finalizar</button>    
                    </form>
                  
                </div>
            </div>
        </section>
    </main>
    <script> 
 

    </script>
    </body>
    </html>