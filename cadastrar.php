<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Cadastrar</title>
    <link href="estilo/estilo.css" rel="stylesheet"/>
</head>
<body>
    <div class="container">
        <form name="cadastro" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>">
            <label for="email">*E-mail: </label>
            <input id="email" type="email" name="email" placeholder="joazinho.alfredo@gmail.com" minlength="10" maxlength="50"/><br/>
            <label for="nome">*Nome: </label>
            <input id="nome" type="text" name="nome" minlength="3" maxlength="12"/><br/>
            <label for="cpf">*CPF: </label>
            <input id="cpf" type="number" name="cpf" minlength="11" maxlength="11"/><br/>
            <label for="cnh">*CNH: </label>
            <input id="cnh" type="number" name="cnh" maxlength="11"/><br/>
            <label for="carro">*Carro: </label>
            <input id="carro" type="text" name="carro" maxlength="20"/><br/>
            <label for="senha">*Senha: </label>
            <input id="senha" type="password" name="senha" minlength="8" maxlength="12"/><br/>
            <i class="aviso">A senha deve ter min 8 e max de 12 caracteres</i><br/>
            <label for="confirmacao">*Confirmar Senha: </label>
            <input id="confirmacao" type="password" name="confirmacao" minlength="8" maxlength="12"/><br/>
            <input type="submit" name="signUP" value="Cadastrar" class="form button"/>
        </form>
    </div>
</body>
</html>
<?php
    $senha = $login = $nome = $carro = '';
    require_once 'Usuario.php';
    if($_SERVER["REQUEST_METHOD"] == 'POST') {
        $nome = ucfirst($_POST['nome']);
        $cpf = $_POST['cpf'];
        if(! $cnh = $_POST['cnh'])
            $cnh = NULL;
        if(! $carro = $_POST['carro'])
            $carro = NULL;
        if ($_POST['senha'] == $_POST['confirmacao']) {
            $user = new Usuario(strtolower($_POST['email']),$_POST['senha']);
            $user->validarSenha(12);
            
            include_once 'conectar.php';
            $sql = "
                INSERT INTO user_data
                    (email, senha, nome, CPF, CNH, car, tipo_usuario) 
                    VALUES 
                    ('$login','$senha','$nome', '$cpf', '$cnh', '$carro', '$USUARIO_PADRAO')"
                ;
            if($conection->query($sql) == TRUE)
                echo "Dados salvos com sucesso!";
            else
                echo "Erro ao criar usuario ".$conection->error;
        } else
            echo "<script>alert('As duas senhas não batem!'); history.back()</script>";

    }



?>