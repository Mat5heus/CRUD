<?php
    require_once 'isSessionAlive.php';

    if($_SESSION["nivelAcesso"] != 'admin')
        header("Location: dashboard.php");

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Editar</title>
    <link href="estilo/estilo.css" rel="stylesheet"/>
</head>
<body>
    <div class="container busca">
        <form name="buscar" method="GET" action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>">
            <label for="pesq">Buscar usuario:</label>
            <input type="text" name="pesq" id="pesq" maxlength="20" minlength="1"
                title="Buscar por: &#013;-Id &#013;-Telefone &#013;-placa &#013;-CPF &#013;-CNH"
            />
            <input type="Submit" name="Buscar" value="Buscar" class="form button"/>
            <input type="submit" id="cancelar" name="cancelar" value="voltar" class="form button"/> 
        </form>
        
    </div>
    <?php 
        if($_SERVER["REQUEST_METHOD"] == 'GET') {
            if(!empty($_GET['pesq'])) {
                $busca = $_GET['pesq'];
                require 'conectar.php';
                $result = $conection->query("
                        SELECT comp.id_compania, comp.nome as empNome, comp.nome_fantasia as fantasia, comp.cnpj,
                                u.id_usuario, u.email, u.nome as usNome, u.telefone, u.cpf, u.cnh,
                                c.placa, c.estacionado, c.checkIn, c.checkOut,
                                e.pais, e.estado, e.cidade, e.bairro, e.rua, e.numero
                        FROM usuario u join carro c on (u.id_usuario = c.id_usuario)
                            join compania comp on (u.id_usuario = comp.id_usuario)
                            left join endereco e on (comp.id_compania = e.id_endereco)
                        WHERE 
                                (u.id_usuario = '$busca') 
                            OR 
                                (c.placa = '$busca')
                            OR
                                (u.telefone = '$busca')
                            OR
                                (u.cpf = '$busca')
                            OR
                                (u.cnh = '$busca')
                        LIMIT 1;
                ");
                $conection->close();
                if($row = $result->fetch_assoc()) {
                    
                    $_SESSION['id_user_busca'] = $row['id_usuario'];
                    $_SESSION['id_compania_busca'] = $row['id_compania'];

                    if(empty($row['pais'])) $row['pais'] = "Brasil";
                    if(empty($row['estado'])) $row['estado'] = "SP";
                    if(empty($row['cidade'])) $row['cidade'] = "Araras";

                    require_once 'formularioAtl.php';
                } else
                    echo "<script>  
                            alert(\"Nada encontrado!\");
                            history.back()
                        </script>";
                
            } else if(isset($_GET['cancelar'])) 
                header('Location: dashboard.php');
        }
    ?>
    
    </div>
</body>

</html>
<?php
    if($_SERVER["REQUEST_METHOD"] == 'POST') {

        require_once 'Carro.php';
        require_once 'Endereco.php';
        require_once 'Usuario.php';
        require_once 'Empresa.php';

        $user = new Usuario();
        $empresa = new Empresa();
        $end = new Endereco();
        $carro = new Carro();

        $user->setId_usuario($_SESSION['id_user_busca']);
        $empresa->setId_compania($_SESSION['id_compania_busca']);
        
        if(isset($_POST['salvar'])) {

                $_POST['senha'] = 'null';
                include 'isEmpty.php';
                
                if($isValid) {
                        
                    $user->setEmail(strtolower($_POST['email']));
                    $user->setNome(ucfirst($_POST['nome']));
                    $user->setCpf($_POST['cpf']);
                    $user->setCnh($_POST['cnh']);
                    $user->setTelefone($_POST['telefone']);

                    $carro->setPlaca($_POST['placa']);
                    $carro->setEstacionado($_POST['estacionado']);
                    $carro->setHoraCheckOut($_POST['checkOut']);
                    $carro->setHoraCheckIn($_POST['checkIn']);

                    $empresa->setNome($_POST['empresa']);
                    $empresa->setNome_fantasia($_POST['nome_fantasia']);
                    $empresa->setCnpj($_POST['cnpj']);

                    $end->setPais($_POST['pais']);
                    $end->setEstado($_POST['estado']);
                    $end->setCidade($_POST['cidade']);
                    $end->setBairro($_POST['bairro']);
                    $end->setRua($_POST['rua']);
                    $end->setCasa($_POST['numero']);
                    
                    if(
                        $user->atualizar() && $carro->atualizar($user->getId_usuario()) 
                        && $empresa->atualizar() &&  $end->atualizar($empresa->getId_compania()) 
                    ) {
                        echo "<script>alert('Dados alterados!')</script>";
                    } else 
                        echo "<script>alert('Falha na alteracao de dados'); history.back()</script>";
                } else
                    echo "<script>alert('É necessario preencher todos os campos'); history.back()</script>";
        }

        if ($user->getId_usuario() == 1) {
            echo "<script>alert('ADM principal nao pode ser deletado!')</script>";
            return;
        }
            
        if(isset($_POST['deletar'])) {
            if( 
               $carro->deletar($user->getId_usuario()) && $end->deletar($empresa->getId_compania())
               && $empresa->deletar() && $user->deletar()
            )
                echo "<script>alert('Conta deletada!')</script>";
            else
                echo "<script>alert('Falha ao excluir dados'); history.back()</script>";
        }
    }

?>