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
    ?>
    <main>
        <section class="section_nav_cadastro">
            <div class="close_nav">
               <a href="../LandingPage/cadastro.php"><img src="img/close.png" alt=""></a>
            </div>
                <div class="nav_cadastro">
                        <div class="opcao_nav margin">
                            <p>Dados do Estabelecimento</p>
                            <button class="num_opcao_nav" ><a href="CadEstabPt2.php">1</a></button>
                        </div>
                        <div class="opcao_nav margin">
                            <p>Informações Adicionais</p>
                            <button class="num_opcao_nav" id="btn_selecionado"><a href="CadEstabPt2.php">2</a></button>
                        </div>
                        <div class="opcao_nav margin">
                            <p>Personalizar Perfil</p>
                            <button class="num_opcao_nav"><a href="#">3</a></button>
                        </div>
                        <div class="opcao_nav" id="no_margim">
                            <p>Pagamento</p>
                            <button class="num_opcao_nav"><a href="#">4</a></button>
                        </div>
                </div>
            </section>

        <section class="section_form_cadastro"> 
           
            <form action="CadEstabPt2.php" method="post">
                <h2 class="titulo_form">Informações Adicionais</h2>
                <div class="colunas_form">
                    <div class="coluna_form">
                    <label class="titulo_input" for="">Horário de abertura</label>
                        <div class="input_container">
                            <i class="fa-solid fa-clock"></i>
                            <input type="time" name="horario_abertura" required>
                        </div>
                    <label class="titulo_input" for="">Horário de fechamento</label>
                        <div class="input_container">
                            <i class="fa-solid fa-clock"></i>
                            <input type="time" name="horario_fechamento" required>
                        </div>
                        <div>
                            <div class="titulo_input">
                                <i class="fa-solid fa-utensils"></i>
                                <label for="">Tipos de Comida</label>
                            </div>
                            <div class="div_tipos_comida">
                                <div><input type="checkbox" name="comida[]" value="massa" id="massa" class="checkbox" ><label class="comida" for="massa">Massas</label></div>
                                <div><input type="checkbox" name="comida[]" value="vegana" id="vegana" class="checkbox"><label class="comida" for="vegana">Vegana</label></div>
                                <div><input type="checkbox" name="comida[]" value="vegetariana" id="vegetariana" class="checkbox"><label class="comida" for="vegetariana">Vegetariana</label></div>
                                <div><input type="checkbox" name="comida[]"value="francesa" id="francesa" class="checkbox"><label class="comida" for="francesa">Francesa</label></div>
                                <div><input type="checkbox" name="comida[]"value="espanhola" id="espanhola" class="checkbox"><label class="comida" for="espanhola">Espanhola</label></div>
                                <div><input type="checkbox" name="comida[]"value="tailandesa" id="tailandesa" class="checkbox"><label class="comida" for="tailandesa">Tailandesa</label></div>
                                <div><input type="checkbox" name="comida[]"value="indiana" id="indiana" class="checkbox"><label class="comida" for="indiana">Indiana</label></div>
                                <div><input type="checkbox" name="comida[]"value="pizzaria" id="pizzaria" class="checkbox"><label class="comida" for="pizzaria">Pizzaria</label></div>
                                <div><input type="checkbox" name="comida[]"value="italiana" id="italiana" class="checkbox"><label class="comida" for="italiana">Italiana</label></div>
                                <div><input type="checkbox" name="comida[]"value="mexicana" id="mexicana" class="checkbox"><label class="comida" for="mexicana">Mexicana</label></div>
                                <div><input type="checkbox" name="comida[]"value="peixe" id="peixe" class="checkbox"><label class="comida" for="peixe">Frutos do Mar</label></div>
                                <div><input type="checkbox" name="comida[]"value="carne" id="carne" class="checkbox"><label class="comida" for="carne">Carnes</label></div>
                                <div><input type="checkbox" name="comida[]"value="bar" id="bar" class="checkbox"><label class="comida" for="bar">Bar/Pub</label></div>
                                <div><input type="checkbox" name="comida[]"value="infantil" id="infantil" class="checkbox"><label class="comida" for="infantil">Pratos Infantis</label></div>
                                <div><input type="checkbox" name="comida[]"value="fastfood" id="fastfood" class="checkbox"><label class="comida" for="fastfood">Fast Food</label></div>
                                <div><input type="checkbox" name="comida[]"value="brunch" id="brunch" class="checkbox"><label class="comida" for="brunch">Brunch</label></div>
                                <div><input type="checkbox" name="comida[]"value="lanchonete" id="lanchonete" class="checkbox"><label class="comida" for="lanchonete">Lanchonete/Cafeteria</label></div>
                                <div><input type="checkbox" name="comida[]"value="petiscos" id="petiscos" class="checkbox"><label class="comida" for="petiscos">Entradas e Petiscos</label></div>
                                <div><input type="checkbox" name="comida[]"value="sobremesa" id="sobremesa" class="checkbox"><label class="comida" for="sobremesa">Sobremesas</label></div>
                             
                            </div>
                            <label class="titulo_input" for="">Complemento endereço</label>
                            <div class="input_container">
                            <i class="fa-solid fa-location-dot"></i>
                                <input type="text" name="complemento">
                            </div>
                        </div>
                        </div>
                        <div class="coluna_form">
                            <label class="titulo_input" for="">Aceita reservas até</label>
                            <div id="container_input_max">
                                    <input type="number" id="input_max_reserva" min="1" name="qtdmaxpes">
                                    <p>pessoas</p>
                            </div>
                            <label for="">Tempo Limite de aguardo para reservas</label>
                            <div class="input_container">
                            <i class="fa-solid fa-clock"></i>
                                <input type="time" name="tempomaxatraso" >
                            </div>
                            <div class="titulo_input">
                                <i class="fa-solid fa-bell-concierge"></i>
                                <label for="">Serviços Oferecidos</label>
                            </div>
                            <div class="servicos_cad">
                                <label for="pets">
                                    <input type="checkbox" id="pets" value="pets" name="servico[]" class="checkbox_serv">
                                    <i class="fa-solid fa-dog"> <span for="pets">Aceita Pets</span></i>
                                </label>
                                <label for="ar">
                                    <input type="checkbox" id="ar" value="ar_condicionado" name="servico[]" class="checkbox_serv">
                                    <i class="fa-solid fa-wind"><span for="ar">Ar-Condicionado</span></i>
                                </label>
                                <label for="mesa">
                                    <input type="checkbox" name="servico[]" value="juntar_mesa" id="mesa" class="checkbox_serv">
                                    <i class="fa-solid fa-chair"> <span for="mesa">Junção de Mesas</span></i>
                                </label>
                                <label for="estacionamento">
                                    <input type="checkbox" id="estacionamento" value="estacionamento" name="servico[]" class="checkbox_serv">
                                    <i class="fa-solid fa-car"><span for="estacionamento">Estacionamento</span></i>
                                </label>
                                <label for="crianca">
                                    <input type="checkbox" name="servico[]" value="espaco_infantil" id="crianca" class="checkbox_serv">
                                    <i class="fa-solid fa-child-reaching"><span for="crianca">Espaço Infatil</span></i>
                                </label>
                                <label for="arlivre">
                                    <input type="checkbox" name="servico[]" value="ar_livre" id="arlivre" class="checkbox_serv">
                                    <i class="fa-solid fa-smoking"><span for="arlivre">Espaço Aberto</span></i>                
                                </label>
                                <label for="wifi">
                                    <input type="checkbox" name="servico[]" value="wifi" id="wifi" class="checkbox_serv">
                                    <i class="fa-solid fa-wifi"><span for="wifi">Wifi</span></i>                            
                                </label>
                                <label>
                                    <input type="checkbox" name="servico[]" value="rodizio" id="rodizio" class="checkbox_serv">
                                    <i class="fa-solid fa-pizza-slice"><span>Rodízio</span></i>                               
                                </label>
                                <label for="buffet">
                                    <input type="checkbox" name="servico[]" value="buffet" id="buffet" class="checkbox_serv">
                                    <i class="fa-solid fa-bowl-food"><span for="buffet">Buffet</span></i>
                                </label>
                                <label for="musica">
                                    <input type="checkbox" name="servico[]" value="musica" id="musica" class="checkbox_serv">
                                    <i class="fa-solid fa-music"><span for="musica">Música ao vivo</span></i>
                                </label>
                                <label for="acessibilidade">
                                    <input type="checkbox" name="servico[]" value="acessibilidade" id="acessibilidade" class="checkbox_serv">
                                    <i class="fa-solid fa-wheelchair"><span>Acessibilidade</span></i>                                   
                                </label>
                                <label for="tv">
                                    <input type="checkbox" name="servico[]" id="tv" value="tv_telao " class="checkbox_serv">
                                    <i class="fa-solid fa-tv"><span for="tv">Televisões/Telões</span></i>                                  
                                </label>
                                <label for="evento">
                                    <input type="checkbox" name="servico[]" value="espaço_para_eventos" id="evento" class="checkbox_serv">
                                    <i class="fa-solid fa-champagne-glasses"><span>Espaço para eventos e festas</span></i>                                 
                                </label>
                            </div>

                           </div>
                        </div>
                <input id="btn_enviar" type="submit" value="Enviar">
            </form>
        </section>
    </main>
    




    <?php 
   
   require_once '../conexao.php';
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $horario_abertura = $_POST['horario_abertura'];
    $horario_fechamento = $_POST['horario_fechamento'];
    $qtdmaxpes = $_POST['qtdmaxpes'];    
    $id_estabelecimento = $_SESSION['id_estabelecimento']; 
    $tempomaxatraso = $_POST['tempomaxatraso'];    
    $complemento = $_POST['complemento'];

    $id_localidade = $_SESSION['id_localidade'];    
    
        
    $sql3 = "INSERT INTO horario_func (hora_abertura, hora_fechamento, id_estabelecimento) values ('$horario_abertura','$horario_fechamento', $id_estabelecimento)";
    $resultado3 = mysqli_query($con, $sql3);

    $id_horariofunc = mysqli_insert_id($con);
       

    
       
       if (!empty($_POST['comida'])) {
           
            $comidas = $_POST['comida'];
    
           
            $comidas_str = implode(", ", $comidas);
    
           
            $sql4 = "INSERT INTO serv_oferecido (tipo_comidas, id_estabelecimento) VALUES ('$comidas_str', $id_estabelecimento)";
            $resultado3 = mysqli_query($con, $sql4);

            if($resultado3) {
                echo "<script>window.location.href='CadEstabPt3.php'</script>";
            }
           
    }

            $sql5 = "UPDATE localidade SET complemento = '$complemento' WHERE id_localidade = $id_localidade";
            $resultado5 = mysqli_query($con, $sql5);
   
            $sql6 = "UPDATE usu_estabelecimento SET qtd_max_pesreserva = $qtdmaxpes WHERE id_estabelecimento = $id_estabelecimento";            
            $resultado6 = mysqli_query($con, $sql6);

            $sql7 = "UPDATE horario_func SET tempo_max_atraso = '$tempomaxatraso' WHERE id_horario_func = $id_horariofunc";
            $resultado7 = mysqli_query($con , $sql7);


            if (!empty($_POST['servico'])) {
           
                $servicos = $_POST['servico'];
        
               
                $servicos_str = implode(", ", $servicos);
        
               
                $sql8 = "UPDATE serv_oferecido SET nome_serv_oferecido = '$servicos_str' WHERE id_estabelecimento = $id_estabelecimento ";
                $resultado8 = mysqli_query($con, $sql8);


                
        }

}
    ?>
</body>
</html>