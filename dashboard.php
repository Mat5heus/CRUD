<?php 
    session_start();
    require_once "isSessionAlive.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de <?php echo $_SESSION['nome']; ?></title>
    <link href="estilo/estilo.css" rel="stylesheet"/>
    <style>
        div.table {
            width: 800px;
            height: 300px;
        }
        div.table.linha {
            width: 100%;
            height: 40px;
            float: left;
        }

        div.table.linha.cabecalho {
            width: 13%;
            height: 95%;
            text-align: center;
            font-weight: bold;
            float: left;
        }
    </style>
</head>
<body>
    <h1>Bem-vindo <?php echo $_SESSION['nome'];?></h1>
    <div class="table">
        <div class="table linha" id="1">
            <div class="table linha cabecalho" id="id">id</div>
            <div class="table linha cabecalho" id="nome">Nome</div>
            <div class="table linha cabecalho" id="telefone">Telefone</div>
            <div class="table linha cabecalho" id="carro">Carro</div>
            <div class="table linha cabecalho" id="endereco">Endereço</div>
            <div class="table linha cabecalho" id="empresa">Empresa</div>
            <div class="table linha cabecalho" id="tipo_usuario">Tipo de usuario</div>
        </div>
        <?php 
            //require_once 'conectar.php';
           // $sql = "SELECT FROM user_data as u join ´address´ as a join ";
        ?>
    </div>
</body>
</html>
<?php 
    //session_unset();
    //session_destroy();
?>