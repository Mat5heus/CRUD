<?php
abstract class Pessoa {
    private string $nome, $cpf, $cnh, $placa, $telefone;

    public function Pessoa($nome, $cpf, $cnh, $placa, $telefone) {
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setCnh($cnh);
        $this->setPlaca($placa);
        $this->setTelefone($telefone);
    }

    public function validarDados() {
        $valores = [
            $this->getNome(),
            $this->getCpf(),
            $this->getCnh(),
            $this->getPlaca(),
            $this->getTelefone()
        ];
        foreach($valores as $texto) {
            if(!empty($texto))
                return false;
        }

        return true;
    }

    public function guardarDados() {
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
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of cpf
     */ 
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set the value of cpf
     *
     * @return  self
     */ 
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get the value of cnh
     */ 
    public function getCnh()
    {
        return $this->cnh;
    }

    /**
     * Set the value of cnh
     *
     * @return  self
     */ 
    public function setCnh($cnh)
    {
        $this->cnh = $cnh;

        return $this;
    }

    /**
     * Get the value of telefone
     */ 
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     *
     * @return  self
     */ 
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get the value of placa
     */ 
    public function getPlaca()
    {
        return $this->placa;
    }

    /**
     * Set the value of placa
     *
     * @return  self
     */ 
    public function setPlaca($placa)
    {
        $this->placa = $placa;

        return $this;
    }
}
?>