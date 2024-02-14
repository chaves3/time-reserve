<?php

date_default_timezone_set('America/Sao_Paulo');
$pdo = new PDO('mysql:host=localhost;dbname=modulo_8', 'root', '');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Sistema de reserva</title>
</head>
<body>
    <header>
        <div class="center">
        <div class="logo">
            <h2>Chaves TI</h2>
        </div><!--logo-->

        <nav class="menu">
            <ul>
                <li><a class="admin" href="">Reservas Atuais</a></li>

            </ul>
        </nav><!--menu-->
        <div class="clear"></div>
        </div><!--center-->
    </header>

    <section class="agendamentos">
        <div class="center">
            <?php 
            if(isset($_GET['excluir'])){
                $id = (int)$_GET['excluir'];
                $pdo->exec("DELETE FROM tb_agendados WHERE id = $id");
                echo "<div class='deletar'>Seu agendamento foi deletado com sucesso!</div>";
            }
            $info = $pdo->prepare("SELECT * FROM tb_agendados");
            $info->execute();
            $info = $info->fetchAll();

            foreach ($info as $key => $value) {

            ?>
            <div class="box-single-horario">
            <div class="single-wraper">
                Nome: Chaves <?php print($value['nome']); ?>
                <br>
                Data e Horário : <?php print(date('d/m/Y H:i:s', strtotime($value['horario']))); ?>
                <br>
                <a href="?excluir=<?php print $value['id']; ?>">Excluir!</a>
            </div><!--single-wraper-->
            </div><!--box-single-horario-->
            <?php } ?>
       
            <div class="clear"></div>
        </div><!--center-->
    </section><!--agendamentos-->
</body>
</html>