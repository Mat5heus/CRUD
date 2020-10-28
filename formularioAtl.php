<div class="container">
    <form name="cadastro" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>">
        <fieldset>
                <legend>Empresa</legend>
                <label for="nomeEmp">Empresa: </label>
                <input id="nomeEmp" type="text" name="empresa" minlength="3" maxlength="30" value="<?php echo $row['empNome']?>"/><br/>
                <label for="nomeFant">Nome fantasia: </label>
                <input id="nomeFant" type="text" name="nome_fantasia" minlength="3" maxlength="30" value="<?php echo $row['fantasia']?>"/><br/>
                <label for="cnpj">CNPJ: </label>
                <input id="cnpj" type="text" name="cnpj" maxlength="14" value="<?php echo $row['cnpj']?>"/><br/>
        </fieldset>
        <fieldset>
                <legend>Usuário</legend>
                <label for="email">E-mail: </label>
                <input id="email" type="email" name="email" minlength="10" maxlength="50" value="<?php echo $row['email']?>"/><br/>
                <label for="nome">Nome: </label>
                <input id="nome" type="text" name="nome" minlength="3" maxlength="12" value="<?php echo $row['usNome']?>"/><br/>
                <label for="telefone">Telefone: </label>
                <input id="telefone" type="tel" name="telefone" minlength="10" maxlength="14" value="<?php echo $row['telefone']?>"/><br/>
                <label for="cpf">CPF: </label>
                <input id="cpf" type="number" name="cpf" minlength="11" maxlength="12" value="<?php echo $row['cpf']?>"/><br/>
                <label for="cnh">CNH: </label>
                <input id="cnh" type="number" name="cnh" maxlength="14" value="<?php echo $row['cnh']?>"/><br/>
        </fieldset>
        <fieldset>
            <legend>Veiculo</legend>
            <label for="placa">Placa: </label>
            <input id="placa" type="text" name="placa" maxlength="7" value="<?php echo $row['placa']?>"/>
            <label for="estacionado">Estacionado: </label>
            <select name="estacionado" id="estacionado">
                <option value="true" <?php if($row['estacionado'] == 'true') echo 'selected';?>>Sim</option>
                <option value="false" <?php if($row['estacionado'] == 'false') echo 'selected';?>>Não</option>
            </select><br/>
            <label for="placa">Check in: </label>
            <input id="placa" type="text" name="checkIn" maxlength="18" value="<?php echo $row['checkIn']?>" placeholder="dd/mm/aaaa hh:mm"/><br/>
            <label for="placa">Check out: </label>
            <input id="placa" type="text" name="checkOut" maxlength="18" value="<?php echo $row['checkOut']?>" placeholder="dd/mm/aaaa hh:mm"/><br/>
        </fieldset>
        <fieldset>
                <legend>Endereço</legend>
                <label for="pais">Pais: </label>
                <input id="pais" type="text" name="pais" minlength="3" maxlength="20" value="<?php echo $row['pais']?>"/><br/>
                <label for="estado">Estado (sigla): </label>
                <input id="estado" type="text" name="estado" minlength="1" maxlength="2" value="<?php echo $row['estado']?>"/><br/>
                <label for="cidade">Cidade: </label>
                <input id="cidade" type="text" name="cidade" minlength="3" maxlength="30" value="<?php echo $row['cidade']?>"/><br/>
                <label for="bairo">Bairro: </label>
                <input id="bairo" type="text" name="bairro" minlength="3" maxlength="30" value="<?php echo $row['bairro']?>"/><br/>
                <label for="rua">Rua: </label>
                <input id="rua" type="text" name="rua" minlength="3" maxlength="30" value="<?php echo $row['rua']?>"/><br/>
                <label for="n">Nº: </label> 
                <input id="n" type="number" name="numero" minlength="3" maxlength="6" value="<?php echo $row['numero']?>"/><br/>
        </fieldset>
           

        <input type="submit" id="salvar" name="salvar" value="Salvar" class="form button"/>
        <input type="submit" id="deletar" name="deletar" value="deletar" class="form button"/>
    </form>
</div>