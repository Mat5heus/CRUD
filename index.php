<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Login</title>
    <link href="estilo/estilo.css" rel="stylesheet"/>
</head>
<body>
    <div class="container">
        <form name="login" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>">
            <label for="email">E-mail: </label>
            <input id="email" type="email" name="email" placeholder="joazinho.alfredo@gmail.com" minlength="10" maxlength="50"/><br/>
            <label for="senha">Senha: </label>
            <input id="senha" type="password" name="senha" minlength="8" maxlength="12"/><br/>
            <i class="aviso">A senha deve ter min 8 e max de 12 caracteres</i><br/>
            <input type="submit" name="login" value="Logar" class="form button"/>
            <input type="button" name="signUP" value="Cadastrar" class="form button" onclick="location.href='cadastrar.php'"/>
        </form>
    </div>
</body>
</html>
<?php
    require_once 'Usuario.php';
    if($_SERVER["REQUEST_METHOD"] == 'POST') {
        $user = new Usuario($_POST['email'],$_POST['senha']);

        if(!($user->estaVazio()))
            echo "<script>
                    alert(\"Erro ao enviar dados \\nTente novamente!!\");
                    history.back()
                </script>";
        else {
            $valores = ['email', 'senha', 'nome', 'tipo_usuario'];
            $result = $user->pegarDados($valores);
            if($row = $result->fetch_assoc()) {
                if($user->validarSenha($row)) {
                    //TEMPORARIO
                    echo "<script>
                            alert(\"Login efetuado com sucesso!\");
                            history.back()
                        </script>";
                    
                    $_SESSION["nome"] = ucfirst($row['nome']);
                    $_SESSION["tipo_usuario"] = $row['tipo_usuario'];

                    header('Location: dashboard.php');
                    
                    setcookie("session","",time()+60*60*24*30, '/','http://localhost/CRUD/',false,true);
                } else
                    echo "<script>  
                            alert(\"Senha invalida!\");
                            history.back()
                        </script>";
            } else
                echo "<script>
                        alert(\"Usuario não cadastrado!\");
                        history.back()
                    </script>";
        }
    }
    
?>
