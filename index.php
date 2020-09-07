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
            <input type="button" name="signUP" value="Cadastrar" class="form button" onclick="location.href='cadastro.php'"/>
        </form>
    </div>
</body>
</html>
<?php
    $senha = $login = '';
    if($_SERVER["REQUEST_METHOD"] == 'POST') {
        $login = $_POST['email'];
        $senha = $_POST['senha'];
        if(!($senha && $login)){
            echo "<script>
                    alert(\"Erro ao enviar dados \\nTente novamente!!\");
                    history.back()
                </script>";
        } else {
            include_once 'conectar.php';
            $result = $conection->query("
                SELECT email, senha, tipo_usuario 
                FROM user_data 
                WHERE email = '$login'
                LIMIT 1
            ");
            
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if(password_verify($senha, $row['senha'])) {
                        echo "<script>
                                alert(\"Login efetuado com sucesso!\");
                                history.back()
                            </script>";
                    } else {
                        echo "<script>
                                alert(\"Senha invalida!\");
                                history.back()
                            </script>";
                    }
                }
            } else
                echo "<script>
                        alert(\"Usuario não cadastrado!\");
                        history.back()
                    </script>";

        }
    }
    echo "<br/>E-mail: ".$login." <br/>Senha: ".$senha;
    
?>
