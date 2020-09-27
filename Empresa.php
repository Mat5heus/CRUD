<?php
class Empresa {
    private $nome, $nome_fantasia, $cnpj;

    public function Empresa($nome, $nome_fantasia, $cnpj) {
        $this->setNome($nome);
        $this->setNome_fantasia($nome_fantasia);
        $this->setCnpj($cnpj);
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
}
?>