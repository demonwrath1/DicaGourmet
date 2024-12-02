<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/Reservarpt3.css">
</head>
<body>
    <?php 
    include '../../conexao.php';
    include '../apitest.php';
    

   
    
    ?>
    <main>
        <div class="header_main">
            <div id="div_logo">
                <a id="a_logo" href="reservarpt2.php"><img id="seta" src="img/Arrow 2.png" alt=""></a>
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
        <div class="container_info">
            <img id="icon_confirma" src="img/correto (1) 2.png" alt="">
            <h2 id="titulo_reserva">Reserva enviada!</h2>
            <p id="txt_reserva">Sua reserva será analisada e em breve você receberá a confirmação</p>
            <a href="../homeDg.php?id=<?php echo $id_cliente;?>" id="btn_finaliza">Finalizar</a>
            
        </div>
        <a style = "margin-bottom: 1em; margin-top:1em; color: gray;"  href="gerar_relatorio.php"><i>Relatório de reserva</i></a>
    </main>
     
</body>
</html>