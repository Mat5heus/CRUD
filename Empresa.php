<?php
class Empresa {
    private $id_compania, $nome, $nome_fantasia, $cnpj;

    public function Empresa() {}

    public function cadastrar($id) {
        require 'conectar.php';
        $sql = "
            INSERT INTO compania
                (nome, nome_fantasia, cnpj, id_usuario) 
            VALUES (
                    '".$this->getNome()."',
                    '".$this->getNome_fantasia()."',
                    '".$this->getCnpj()."',
                    '$id'
                    );
                ";
        if($conection->query($sql)) {
            $this->setId_compania($conection->insert_id);
            $conection->close();
            return;
        }
        
        echo $conection->error;
        return false;
    }

    public function pegarDados($id) {
        require 'conectar.php';
        $result = $conection->query("
                SELECT  id_compania, nome, nome_fantasia, cnpj, id_usuario
                FROM compania
                WHERE id_usuario = '".$id."' 
                LIMIT 1
            ");
        return $result;
        
    }

    public function deletar() {
        require 'conectar.php';
        $result = $conection->query("
            DELETE FROM compania
            WHERE id_compania = '".$this->getId_compania()."';
        ");
        $conection->close();
        return $result;
    }

    public function atualizar() {
            require 'conectar.php';
            $result = $conection->query("
                UPDATE compania
                SET nome = '".$this->getNome()."',
                    nome_fantasia = '".$this->getNome_fantasia()."',
                    cnpj = '".$this->getCnpj()."'
                WHERE id_compania = '".$this->getId_compania()."';
            ");
            $conection->close();
            return $result;
    }


    public function pegarDadosAtribuir($id) {
        require 'conectar.php';
        $result = $conection->query("
                SELECT  id_compania, nome, nome_fantasia as fantasia, cnpj
                FROM compania
                WHERE id_usuario = '".$id."' 
                LIMIT 1
            ");
        
        if($row = $result->fetch_assoc()) {
            $this->setId_compania($row['id_compania']);
            $this->setNome($row['nome']);
            $this->setNome_fantasia($row['fantasia']);
            $this->setCnpj($row['cnpj']);
            return true;
        } else {
            echo $conection->connect_error;
        }        
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
     * Get the value of nome_fantasia
     */ 
    public function getNome_fantasia()
    {
        return $this->nome_fantasia;
    }

    /**
     * Set the value of nome_fantasia
     *
     * @return  self
     */ 
    public function setNome_fantasia($nome_fantasia)
    {
        $this->nome_fantasia = $nome_fantasia;

        return $this;
    }

    /**
     * Get the value of cnpj
     */ 
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Set the value of cnpj
     *
     * @return  self
     */ 
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * Get the value of id_compania
     */ 
    public function getId_compania()
    {
        return $this->id_compania;
    }

    /**
     * Set the value of id_compania
     *
     * @return  self
     */ 
    public function setId_compania($id_compania)
    {
        $this->id_compania = $id_compania;

        return $this;
    }
}
?>