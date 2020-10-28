<?php 
class Usuario {
    private $id_usuario, $email, $senha, $nivelAcesso, $nome, $cpf, $cnh, $telefone;

    public function Usuario($tipo = 'user') {
        $this->setNivelAcesso($tipo);
    }

    public function cadastrar() {
        require 'conectar.php';
        $sql = "
            INSERT INTO usuario
                (email, senha, nome, CPF, CNH, telefone, tipo_usuario) 
            VALUES (
                '".$this->getEmail()."',
                '".$this->gerarSenha(12)."',
                '".$this->getNome()."',
                '".$this->getCpf()."',
                '".$this->getCnh()."',
                '".$this->getTelefone()."',
                '".$this->getNivelAcesso()."'
                );
            ";
        if($conection->query($sql)) {
            $this->setId_usuario($conection->insert_id);
            $conection->close();
            return;
        }
        
        echo $conection->error;
        return false;
    }

    public function deletar() {
        require 'conectar.php';
        $result = $conection->query("
            DELETE FROM usuario
            WHERE id_usuario = '".$this->getId_usuario()."';
        ");
        $conection->close();
        return $result;
    }

    public function atualizar() {
        require 'conectar.php';
        $result = $conection->query("
            UPDATE usuario
            SET email = '".$this->getEmail()."',
                nome = '".$this->getNome()."',
                telefone = '".$this->getTelefone()."',
                cpf = '".$this->getCpf()."',
                cnh = '".$this->getCnh()."'
            WHERE id_usuario = '".$this->getId_usuario()."';
        ");
        $conection->close();
        return $result;
    }

    public function estaVazio() {
        if(!($this->getSenha() && $this->getEmail()))
            return false;
        else
            return true;
    }

    public function pegarDados() {
        require 'conectar.php';
        $result = $conection->query("
                SELECT  id_usuario as id, email, senha, tipo_usuario
                FROM usuario
                WHERE email = '".$this->getEmail()."' 
                LIMIT 1;
            ");
        return $result;
        
    }

    public function pegarDadosAtribuir() {
        require 'conectar.php';
        $result = $conection->query("
                SELECT  id_usuario as id, nome, telefone, tipo_usuario
                FROM usuario
                WHERE email = '".$this->getEmail()."' 
                LIMIT 1
            ");
        
        if($row = $result->fetch_assoc()) {
            $this->setId_usuario($row['id']);
            $this->setNome($row['nome']);
            $this->setTelefone($row['telefone']);
            $this->setNivelAcesso($row['tipo_usuario']);
            return true;
        }

        return false;        
        
    }

    public function validarSenha($row) {
        if(password_verify($this->getSenha(), $row['senha']))
            return true;
        else
            return false;
    }

    public function gerarSenha($custo) {
        $option = ['cost' => $custo];
        return password_hash($this->getSenha(), PASSWORD_BCRYPT, $option);
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        if(!(empty($email)))
            $this->email = $email;
        else
            return null;

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
    public function setSenha($senha)
    {
        if(!(empty($senha)))
            $this->senha = $senha;
        else
            return null;

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
     * Get the value of id_usuario
     */ 
    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id_usuario
     *
     * @return  self
     */ 
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }
}