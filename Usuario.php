<?php 
require_once 'Pessoa.php';
class Usuario extends Pessoa{
    private $email, $senha, $nivelAcesso;

    public function Usuario($email, $senha, $nome = null, $cpf, $cnh, $placa, $telefone) {
        if(!($email && $senha)) {
            $this->setEmail($email);
            $this->setSenha($senha);
            Parent::($nome, $cpf, $cnh, $placa, $telefone);
            $this->setNivelAcesso('user');
            return true;
        } else
            return false;
    }

    public function cadastrar($nome, $cpf, $cnh, $placa, $telefone) {

    }

    public function estaVazio() {
        if(!($this->getSenha() && $this->getEmail()))
            return false;
        else
            return true;
    }

    public function pegarDados($valores) {
        $colunas = $this->formatarString($valores);
        $email = $this->getEmail();

        include_once 'conectar.php';
        $result = $conection->query("
                SELECT $colunas
                FROM user_data 
                WHERE email = '$email'
                LIMIT 1
            ");

        return $result;
    }

    public function validarSenha($row) {
        if(password_verify($this->getSenha(), $row['senha'])) {
            return true;
        } else
            return false;
    }

    public function gerarSenha($custo) {
        $option = ['cost' => $custo];
        return password_hash($this->getSenha(), PASSWORD_BCRYPT, $option);
    }

    public function formatarString($valores) {
        $frase = "";
        foreach($valores as $texto) {
            $frase += $texto.',';
        }
        return rtrim($frase,',');
    }

    /**
     * Get the value of email
     */ 
    private function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    private function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of senha
     */ 
    private function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */ 
    private function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of nivelAcesso
     */ 
    public function getNivelAcesso()
    {
        return $this->nivelAcesso;
    }

    /**
     * Set the value of nivelAcesso
     *
     * @return  self
     */ 
    public function setNivelAcesso($nivelAcesso)
    {
        $this->nivelAcesso = $nivelAcesso;

        return $this;
    }
}