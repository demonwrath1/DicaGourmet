<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/Reservarpt2.css">
    <link rel="stylesheet" href="css/Reservarstyle.css">
</head>
<body>
<main>
    <?php
     include '../../conexao.php';
     include '../apitest.php';
     
    ?>
        <div class="header_main">
            <div id="div_logo">
                <a id="a_logo" href="reserva.php"><img id="seta" src="img/Arrow 2.png" alt=""></a>
                <img id="logo" src="img/logo (2).png" alt="">
            </div>
            <div>
                <h1 id="nome_rest" >Le Central</h1>
                <div class="end_info">
                    <img id="icon_local" src="img/mapas-e-bandeiras 5.png" alt="">
                    <p><?=$establishment['logradouro']?></p>
                </div>
            </div>
        </div>
        <form action="" method="post">
            
                <div class="container_infos">
                <div class="div_esquerda">
                    <h2 id="titulo_rest">Le Central</h2>
                    <div class="linha1">
                        <div>
                            <label for="nome">Nome Completo</label>
                            <input type="text" name="nome_comp" id="nome" required>
                        </div>
                        <div>
                            <label for="npessoa">N° de pessoas</label>
                            <input type="number" class="number" name="npessoa" id="npessoa" required>
                        </div>
                    </div>
                    <div class="linha2">
                        <div>
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" required>
                        </div>
                        <div>
                            <label for="tel">Telefone</label>
                            <input type="tel" class="number" name="tel" id="tel" required>
                        </div>
                    </div>
                    <div class="div_time">
                        <label for="hora">Horário da reserva</label>
                        <input type="time" name="hora" id="hora" required>
                    </div>
                </div>
                <div class="div_direita">
                    <img id="img_form" src="img/Design sem nome (1) 2.png" alt="">
                </div>
            </div>
               
            
            <input id="btn_avancar" type="submit" value="Avançar">
        </>
       
     <?php 
    
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                               
                        $nomeCompleto = $_POST['nome_comp'];
                        $npessoas = $_POST['npessoa'];
                        $email = $_POST['email'];
                        $hora = $_POST['hora'];
                        $telefone = $_POST['tel'];
                        $datareserva = $_SESSION['data_reserva'];
                        $id_reserva = $_SESSION['id_reserva'];

                        
                        $sql = "UPDATE reserva SET qnt_pessoas = '$npessoas', nome_completo = '$nomeCompleto', horario_reserva = '$hora' WHERE id_reserva = $id_reserva  ";
                        $result = mysqli_query($con, $sql);



                        echo "<script> window.location.href='reservarpt3.php' </script>";
                    }   




                    ?>
</body>
</html>