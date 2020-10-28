<?php
class Endereco{
    private $pais, $estado, $cidade, $bairro, $rua, $casa;

    public function Endereco() {}

    public function cadastrar($id) {
        require 'conectar.php';
        $sql = "
            INSERT INTO endereco
                (pais, estado, cidade, bairro, rua, numero, pk_compania) 
            VALUES (
                    '".$this->getPais()."',
                    '".$this->getEstado()."',
                    '".$this->getCidade()."',
                    '".$this->getBairro()."',
                    '".$this->getRua()."',
                    '".$this->getCasa()."',
                    '$id'
                );
            ";

        if($conection->query($sql)) {
            $conection->close();
            return;
        }
        
        echo $conection->error;
        return false;
    }

    public function deletar($id) {
        require 'conectar.php';
        $result = $conection->query("
            DELETE FROM endereco
            WHERE pk_compania = '".$id."';
        ");
        $conection->close();
        return $result;
    }


    public function atualizar($id) {
            require 'conectar.php';
            $result = $conection->query("
                UPDATE endereco
                SET pais = '".$this->getPais()."',
                    estado = '".$this->getEstado()."',
                    cidade = '".$this->getCidade()."',
                    bairro = '".$this->getBairro()."',
                    rua =  '".$this->getRua()."',
                    numero = '".$this->getCasa()."' 
                WHERE pk_compania = '".$id."'
            ");
            $conection->close();
            return $result;
    }

    /**
     * Get the value of pais
     */ 
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set the value of pais
     *
     * @return  self
     */ 
    public function setPais($pais)
    {
        if(!empty($pais))
            $this->pais = $pais;
        else 
            $pais = 'default';
        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        if(!empty($estado))
            $this->estado = $estado;
        else 
            $estado = 'default';

        return $this;
    }

    /**
     * Get the value of cidade
     */ 
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set the value of cidade
     *
     * @return  self
     */ 
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get the value of bairro
     */ 
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set the value of bairro
     *
     * @return  self
     */ 
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get the value of rua
     */ 
    public function getRua()
    {
        return $this->rua;
    }

    /**
     * Set the value of rua
     *
     * @return  self
     */ 
    public function setRua($rua)
    {
        $this->rua = $rua;

        return $this;
    }

    /**
     * Get the value of casa
     */ 
    public function getCasa()
    {
        return $this->casa;
    }

    /**
     * Set the value of casa
     *
     * @return  self
     */ 
    public function setCasa($casa)
    {
        $this->casa = $casa;

        return $this;
    }
}



?>