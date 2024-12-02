<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/LoginStyle.css">
    <script src="https://kit.fontawesome.com/7489919d60.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
       

    <main>
        <div class="container_esquerda">
            <a href="../LandingPage/landing-page.php"><img id="logo" src="img/g1 (4).png" alt=""></a>
            <div class="container_txt">
                <h1>Bem Vindo!</h1>
                <p>É um prazer recebê-lo em nosso mundo gastronômico, onde cada reserva é uma experiência única.Ao fazer login, você poderá realizar reservas de forma prática e personalizada, e acompanhar suas preferências e histórico de visitas. </p>
            </div>
            <p class="p_footer">Dica Gourmet © 2024 Login Form. All rights reserved | Design by 0477</p>
        </div>
        <form action="validacao.php" method="post">
            <h1>Login</h1>
            <label for="email">E-mail</label>
            <div class="input_container">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" required>
            </div>
            <label for="senha">Senha</label>
            <div class="input_container">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="senha" required>
            </div>
            <label for="">Tipo de usuário</label>
            <div class="tipo_usuario">
            <select name="tipo_usu" id="tipo_usu"> 
            <option value="cliente">Cliente</option>
            <option value="estabelecimento">Estabelecimento</option>
            </select>

            </div>

            <input id="btn_enviar" type="submit" value="Entrar">
            <p class="p_desc">Não possui uma conta? <a href="../LandingPage/cadastro.php">Cadastre-se</a></p>
        </form>
    </main>

    
    <?php
    session_start();
    
    if($_SERVER['REQUEST_METHOD'] == "POST") {

    
    $id_estabelecimento = $_SESSION['id_estabelecimento'];
    }
    
    
  
    
    ?>

    
    
 


    


    
    
   
</body>
</html>