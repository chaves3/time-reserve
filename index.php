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
                <li><a href="index.php">Reservar</a></li>
                <li><a href="admin.php">Reservas</a></li>
                
            </ul>
        </nav><!--menu-->
        <div class="clear"></div>
        </div><!--center-->
    </header>

    <section class="reserva">
        <div class="center">
            <?php
                if (isset($_POST['acao'])) {
                    $nome = $_POST['nome'];
                    $dataHora = $_POST['dataHora'];
                    $date = DateTime::createFromFormat('d-m-Y H:i:s', $dataHora);
                    $dataHora = $date->format('Y-m-d H:i:s');

                    $sql = $pdo->prepare('INSERT INTO `tb_agendados` VALUES (null, ?, ?)');
                    $sql->execute([$nome, $dataHora]);
                    echo "<div class='sucesso'>Seu horário foi agendado com sucesso!</div>";
                }
?>
            <form action="" method="post">
                <input type="text" name="nome" id="nome" placeholder="Nome:">
                <select name="dataHora" id="dataHora">
                    <?php

            for ($i = 0; $i <= 23; ++$i) {
                $hora = $i;
                if ($i < 10) {
                    $hora = '0'.$hora;
                }

                $hora .= ':00:00';

                $verifica = date('Y-m-d').' '.$hora;
                $sql = $pdo->prepare("SELECT * FROM tb_agendados WHERE horario = '$verifica' ");
                $sql->execute();

                if ($sql->rowCount() == 0 && strtotime($verifica) > time()) {
                    $dataHora = date('d-m-Y').' '.$hora;
                    echo '<option value="'.$dataHora.'">'.$dataHora.'</option>';
                }
            }

?>
                </select>
                <input type="submit" name="acao" value="Enviar">
            </form>
        </div><!--center-->
    </section><!--reserva-->
</body>
</html>