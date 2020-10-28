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
        <fieldset>
                <legend>Empresa</legend>
                <label for="nomeEmp">Empresa: </label>
                <input id="nomeEmp" type="text" name="empresa" minlength="3" maxlength="30"/><br/>
                <label for="nomeFant">Nome fantasia: </label>
                <input id="nomeFant" type="text" name="nome_fantasia" minlength="3" maxlength="30"/><br/>
                <label for="cnpj">CNPJ: </label>
                <input id="cnpj" type="text" name="cnpj" maxlength="14"/><br/>
            </fieldset>
            <fieldset>
                <legend>Usuário</legend>
                <label for="email">E-mail: </label>
                <input id="email" type="email" name="email" placeholder="joazinho.alfredo@gmail.com" minlength="10" maxlength="50"/><br/>
                <label for="nome">Nome: </label>
                <input id="nome" type="text" name="nome" minlength="3" maxlength="12"/><br/>
                <label for="telefone">Telefone: </label>
                <input id="telefone" type="tel" name="telefone" minlength="10" maxlength="14"/><br/>
                <label for="cpf">CPF: </label>
                <input id="cpf" type="number" name="cpf" minlength="11" maxlength="12"/><br/>
                <label for="cnh">CNH: </label>
                <input id="cnh" type="number" name="cnh" maxlength="14"/><br/>
                <label for="placa">Placa do Carro: </label>
                <input id="placa" type="text" name="placa" maxlength="7"/><br/>
                <label for="senha">Senha: </label>
                <input id="senha" type="password" name="senha" minlength="8" maxlength="12"/><br/>
                <label for="confirmacao">Confirmar Senha: </label>
                <input id="confirmacao" type="password" name="confirmacao" minlength="8" maxlength="12"/><br/>
                <i class="aviso">A senha deve ter min 8 e max de 12 caracteres</i><br/>
            </fieldset>
    
            <fieldset>
                <legend>Endereco</legend>
                <label for="nome">Pais: </label>
                <input id="nome" type="text" name="pais" minlength="3" value="Brasil" maxlength="20"/><br/>
                <label for="nome">Estado: </label>
                <input id="nome" type="text" name="estado" minlength="1" value="SP" maxlength="2"/><br/>
                <label for="nome">Cidade: </label>
                <input id="nome" type="text" name="cidade" minlength="3" maxlength="30"/><br/>
                <label for="nome">Bairro: </label>
                <input id="nome" type="text" name="bairro" minlength="3" maxlength="30"/><br/>
                <label for="nome">Rua: </label>
                <input id="nome" type="text" name="rua" minlength="3" maxlength="30"/><br/>
                <label for="nome">Nº: </label> 
                <input id="nome" type="number" name="numero" minlength="3" maxlength="6"/><br/>
            </fieldset>
            
            <input type="submit" id="cadastrar" name="signUp" value="Cadastrar" class="form button"/>
            <input type="submit" id="logar" name="logar" value="Login" class="form button"/> 
        </form>
    </div>
</body>
</html>
<?php
    if($_SERVER["REQUEST_METHOD"] == 'POST') {
        
        if (isset($_POST['signUp']) && $_POST['senha'] == $_POST['confirmacao']) {
            
            include 'isEmpty.php';

            if($isValid) {
                require_once 'Usuario.php';
                require_once 'Empresa.php';
                require_once 'Carro.php';
                require_once 'Endereco.php';

                $user = new Usuario();
                $empresa = new Empresa();
                $carro = new Carro();
                $end = new Endereco();

                $user->setEmail(strtolower($valores['email']));
                $user->setSenha($valores['senha']);
                $user->setNome(ucfirst($_POST['nome']));
                $user->setCpf($_POST['cpf']);
                $user->setCnh($_POST['cnh']);
                $user->setTelefone($_POST['telefone']);

                if($row = $user->pegarDados()->fetch_assoc()) {
                    echo "<script>
                            alert('Usuario já cadastrado!');
                            history.back()
                        </script>";
                    return;
                }
                
                $carro->setPlaca($_POST['placa']);
                
                $empresa->setNome($valores['empresa']);
                $empresa->setNome_fantasia($valores['nome_fantasia']);
                $empresa->setCnpj($valores['cnpj']);

                $end->setPais($_POST['pais']);
                $end->setEstado($_POST['estado']);
                $end->setCidade($_POST['cidade']);
                $end->setBairro($_POST['bairro']);
                $end->setRua($_POST['rua']);
                $end->setCasa($_POST['numero']);
                
                $user->cadastrar();
                $empresa->cadastrar($user->getId_usuario());
                $end->cadastrar($empresa->getId_compania());
                $carro->cadastrar($user->getId_usuario());

                if(!empty($user->getId_usuario()) || $user->getId_usuario() > 0) {
                    echo "<script>alert('Dados cadastrados!')</script>";
                    header('Location: index.php');
                } else {
                    echo "<script>alert('Falha na conexao com o banco de dados'); history.back()</script>";
                }
            } else {
                echo "<script>alert('É necessario preencher todos os campos'); history.back()</script>";
            }
        } else if (isset($_POST['logar']))
            header('Location: index.php');
        else
            echo "<script>alert('As duas senhas não batem!'); history.back()</script>";

    }



?>