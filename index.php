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
    <div class="container login">
        <fieldset>
            <legend>Login</legend>
        <form name="login" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>">
            <label for="email">E-mail: </label>
            <input id="email" type="email" name="email" placeholder="joazinho.alfredo@gmail.com" minlength="10" maxlength="50"/><br/> 
            <label for="senha">Senha: </label>
            <input id="senha" type="password" name="senha" minlength="8" maxlength="12"/><br/>
            <input type="submit" id="login" name="login" value="Logar" class="form button"/>
            <input type="submit" id="cadastro" name="signUp" value="Cadastrar" class="form button"/>
        </form>
        </fieldset>
        
    </div>
</body>
</html>
<?php
    if($_SERVER["REQUEST_METHOD"] == 'POST') {
        if(isset($_POST['login'])) {
            require_once 'Usuario.php';
            require_once 'conectar.php';
            $user = new Usuario();
            $user->setEmail($_POST['email']);
            $user->setSenha($_POST['senha']);

            if(!($user->estaVazio()))
                echo "<script>
                        alert(\"Erro ao enviar dados \\nTente novamente!!\");
                        history.back()
                    </script>";
            else {
                
                if($row = $user->pegarDados()->fetch_assoc()) {
                    if($user->validarSenha($row)) {
                        
                        $_SESSION["email"] = $row["email"];
                        $_SESSION["id"] = $row["id"];
                        $_SESSION["nivelAcesso"] = $row["tipo_usuario"];

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

        } else 
            header('Location: cadastrar.php');
    }
    
?>
