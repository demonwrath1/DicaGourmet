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

// Inclua o autoload do Composer e o PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

// Inicie a sessão
session_start();

// Defina as variáveis do estabelecimento
$nomeestab = $_SESSION['nome'];
$emailestab = $_SESSION['email_estab'];


$chavepix = uniqid();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = new PHPMailer(true);

    try {
        
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'novosis.dicagourmet@gmail.com'; 
        $mail->Password   = 'cwpi aewn uovn eusp'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 587; 

        
        $mail->setFrom('novosis.dicagourmet@gmail.com', 'Dica Gourmet');
        $mail->addAddress($emailestab, $nomeestab); 

        
        $mail->isHTML(true);
        $mail->Subject = 'Pagamento confirmado';
        $mail->Body    = "Olá {$nomeestab}, <br><br>
        Seu pagamento foi recebido com sucesso! Agradecemos pela sua compra.<br><br>
        Se você tiver alguma dúvida, não hesite em nos contatar.<br><br>
        Atenciosamente,<br>
        Dica Gourmet";

        $mail->send();
        echo 'Mensagem enviada com sucesso';
    } catch (Exception $e) {
        echo "Email inválido. Erro do Mailer: {$mail->ErrorInfo}";
    }

   
}
?>

    <main>
        <section class="section_nav_cadastro">
            <div class="close_nav">
               <a href=""> <img src="img/close.png" alt=""></a>
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
            <form id="payment-form" method="post" action="PlanoPrime.php">
                <h1 id="titulo_pagar">Pagamento</h1>
                <div class="container_pagar">
                    <div class="esquerda_pagar" id="payment-info">
                        <div class="forma_pag">
                            <label for="forma_pagamento">Forma de Pagamento</label>
                            <select class="select_forma_pag" name="forma_pagamento" id="forma_pagamento">
                                <option value="credito">Cartão de crédito</option>
                                <option value="debito">Cartão de Débito</option>
                                <option value="pix">Pix</option>
                            </select>
                        </div>

                        <div id="cartao-info">
                            <label for="numero_cartao">Número do cartão</label>
                            <input type="number" name="numero_cartao" id="numero_cartao" class="number">
                            <label for="nome_cartao">Nome no cartão</label>
                            <input type="text" name="nome_cartao" id="nome_cartao">
                            <div class="linha_pagar">
                                <div>
                                    <label for="data_validade">Data de validade</label>
                                    <input type="date" name="data_validade" id="data_validade" class="data">
                                </div>
                                <div>
                                    <label for="cvv">CVV</label>
                                    <input type="number" name="cvv" id="cvv" maxlength="3" class="cvv number">
                                </div>
                            </div>
                            <label for="cpf">CPF</label>
                            <input type="number" name="cpf" id="cpf" class="number">
                        </div>

                        <div id="pix-info" style="display: none;">
                            <label for="chave_pix">Chave Pix</label>
                            <input type="text" readonly value="<?=$chavepix?>" name="chave_pix" id="chave_pix">
                            <button type="button" onclick="copyPixKey()">Copiar Chave Pix</button>
                            <p id="instrucaopix" >Para realizar o pagamento via Pix, copie a chave Pix fornecida e cole no seu aplicativo de banco. Certifique-se de verificar os detalhes antes de confirmar a transação.</p>
                            
                        </div>
                     
                    </div>
                    <div class="direita_pagar">
                        <h2 id="titulo_direita">Plano Deluxe</h2>
                        <ul>
                            <li><img class="correto_icone" src="img/correto 1.png" alt=""><p>250 reservas mensais</p></li>
                            <li><img src="img/correto 1.png" class="correto_icone" alt=""><p>Acesso em dois dispositivo</p></li>
                            <li><img src="img/correto 1.png" class="correto_icone" alt=""><p>Acesso a avaliação de usuários</p></li>
                            <li><img src="img/correto 1.png" class="correto_icone" alt=""><p>Personalização de perfil</p></li>
                        </ul>
                        <p class="preco_plano">R$19,99</p>
                        <input type="submit" value="Concluir" id="btn_finalizar">
                    </div>
                </div>
            </form>
        </section>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const formaPagamento = document.getElementById('forma_pagamento');
        const cartaoInfo = document.getElementById('cartao-info');
        const pixInfo = document.getElementById('pix-info');
        const form = document.getElementById('payment-form');
        const confirmationMessage = document.getElementById('confirmation-message');

        function togglePaymentInfo() {
            const selectedValue = formaPagamento.value;

            if (selectedValue === 'pix') {
                cartaoInfo.style.display = 'none';
                pixInfo.style.display = 'block';
            } else {
                cartaoInfo.style.display = 'block';
                pixInfo.style.display = 'none';
            }
        }

        formaPagamento.addEventListener('change', togglePaymentInfo);
        togglePaymentInfo();

       
    });

    function copyPixKey() {
        const pixKey = document.getElementById('chave_pix');
        pixKey.select();
        document.execCommand('copy');
        alert('Chave Pix copiada para a área de transferência!');
    }


    
    document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('payment-form');
            const submitButton = document.getElementById('btn_finalizar');

            submitButton.addEventListener('click', function(event) {
                
                event.preventDefault();

               
                form.submit();

               
                setTimeout(() => {
                    window.location.href = 'confirmarPagamento.php'; 
                }, 100); 
            });
        });
    
    </script>
 
</body>
</html>