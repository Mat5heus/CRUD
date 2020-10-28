<?php 
    require_once "isSessionAlive.php";
    require_once 'Usuario.php';
    require_once 'Carro.php';
    require_once 'Empresa.php';

    $user = new Usuario();
    $user->setEmail($_SESSION['email']);
    $user->pegarDadosAtribuir();
    $carro = new Carro();
    $carro->pegarDadosAtribuir($user->getId_usuario());
    $empresa = new Empresa();
    $empresa->pegarDadosAtribuir($user->getId_usuario());
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="estilo/estilo.css" rel="stylesheet" type="text/css"/>
    <title>Dashboard de <?php echo $user->getNome(); ?></title>
    <style>
        
    </style>
</head>
<body>
    <h1>Bem-vindo(a) <?php echo $user->getNome();?></h1>
    <div class="table">
        <div class="table linha" id="1">
            <div class="table linha cabecalho" id="id">Id</div>
            <div class="table linha cabecalho" id="nome">Nome</div>
            <div class="table linha cabecalho" id="telefone">Telefone</div>
            <div class="table linha cabecalho" id="carro">Estacionado</div>
            <div class="table linha cabecalho" id="placa">placa</div>
            <div class="table linha cabecalho" id="empresa">Empresa</div>
            <div class="table linha cabecalho" id="tipo_usuario">Tipo de usuario</div>
        </div>
        <?php 
        require 'conectar.php';
        $result = $conection->query("
                SELECT  u.id_usuario as id, u.nome as usnome, u.telefone, c.estacionado,
                        c.placa, e.nome_fantasia as empnome, u.tipo_usuario
                FROM usuario u join carro c on (u.id_usuario = c.id_usuario)
                join compania e on (u.id_usuario = e.id_usuario);
            ");
        $id = 2;
        while($row = $result->fetch_assoc()) {
            if($row['estacionado'] == 'false')
                $row['estacionado'] = 'Não';
            else
                $row['estacionado'] = 'Sim';

            if($row['tipo_usuario'] == 'user')
                $row['tipo_usuario'] = 'Comum';
            
            echo "
                <div class='table linha' id='$id'>
                    <div class='table linha cabecalho' id='id'>".$row['id']."</div>
                    <div class='table linha cabecalho' id='nome'>".$row['usnome']."</div>
                    <div class='table linha cabecalho' id='telefone'>".$row['telefone']."</div>
                    <div class='table linha cabecalho' id='carro'>".$row['estacionado']."</div>
                    <div class='table linha cabecalho' id='placa'>".$row['placa']."</div>
                    <div class='table linha cabecalho' id='empresa'>".$row['empnome']."</div>
                    <div class='table linha cabecalho' id='tipo_usuario'>".ucfirst($row['tipo_usuario'])."</div>
                </div>
              ";
            $id++; 
        }
        ?>
        </div>
            <div class="container buttons">
                <form name="dashboard" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>">
                    <?php
                        if($user->getNivelAcesso() == 'admin')
                            echo "<input id='editar' type='submit' name='editar' value='Editar' class='button'/>";       
                    ?>
                    <input id='logout' type='submit' name='sair' class='button' value="Sair"/>
                </form>
            </div>
            <?php
                if(isset($_POST['editar']))
                    header('Location: editar.php');
                else if (isset($_POST['sair']))
                    header('Location: logout.php');
            
            ?>
        
    <footer class="footer">
    <?php
        if($user->getNivelAcesso() != 'admin') 
            echo "<form action='".htmlentities($_SERVER['PHP_SELF'])."' method='POST'>
                    <label for='inputADM'>senha de administador:</label> 
                    <input type='password' id='inputADM' name='senha' minlength='8' maxlength='12'/> 
                    <input type='submit' name='adm' value='Tornar ADM'/>
                </form>";
        
            if(isset($_POST['adm'])) {
                if(!empty($_POST['senha'])) {
                    require 'conectar.php';
                    $result = $conection->query("
                        SELECT senha
                        FROM usuario
                        WHERE id_usuario = '1' 
                        LIMIT 1;
                    ");
                    if($row = $result->fetch_assoc()) {
                        //agrsouadm
                        if(password_verify($_POST['senha'], $row['senha'])) {

                            $result = $conection->query("
                                UPDATE usuario
                                SET tipo_usuario = 'admin'
                                WHERE  id_usuario = '".$user->getId_usuario()."'
                                LIMIT 1;
                            ");
                            if($result) 
                                $_SESSION["nivelAcesso"] = 'admin';
                                echo "<script>
                                        alert(\"Conta alterada para ADM!\");
                                        history.back()
                                    </script>";
                        }else 
                            echo "<script>
                                alert(\"Senha Incorreta!\");
                                history.back()
                            </script>";
                        
                    } else
                        echo "<script>
                                alert(\"Não há admins no DB!\");
                                history.back()
                            </script>";

                    $result->close();
                } else
                    echo "<script>
                            alert(\"Campo vazio!\");
                            history.back()
                        </script>"; 
            }
        ?>
    </footer>
</body>
</html>
