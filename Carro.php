<?php
class Carro {
    private $placa, $estacionado, $horaCheckIn, $horaCheckOut;

    public function Carro() {
        $this->setEstacionado("false");
    }

    public function fazerCheckingIn($hora = null) {
        $this->setEstacionado(true);
        if($hora == null)
            $this->setHoraCheckIn(date('d/m/Y H:i'));
        else
            $this->setHoraCheckIn($hora);
    }

    public function fazerCheckingOut($hora = null) {
        $this->setEstacionado(false);
        if($hora == null)
            $this->setHoraCheckOut(date('d/m/Y H:i'));
        else
            $this->setHoraCheckOut($hora);
    }

    public function pegarDados($id) {
        require 'conectar.php';
        $result = $conection->query("
                SELECT  id, placa, estacionado, checkin, checkout
                FROM carro
                WHERE id_usuario = '".$id."' 
                LIMIT 1
            ");
        return $result;
        
    }

    public function deletar($id) {
        require 'conectar.php';
        $result = $conection->query("
            DELETE FROM carro
            WHERE id_usuario = '".$id."';
        ");
        $conection->close();
        return $result;
    }

    public function atualizar($id) {
        require 'conectar.php';
        $result = $conection->query("
            UPDATE carro
            SET placa = '".$this->getPlaca()."' ,
                estacionado = '".$this->getEstacionado()."' ,
                checkin = '".$this->getHoraCheckIn()."' ,
                checkout = '".$this->getHoraCheckOut()."'
            WHERE id_usuario = '".$id."'
        ");
        $conection->close();
        return $result;
    }

    public function pegarDadosAtribuir($id) {
        require 'conectar.php';
        $result = $conection->query("
                SELECT placa, estacionado, checkin, checkout
                FROM carro
                WHERE id_usuario = '".$id."' 
                LIMIT 1
            ");
 
        if($row = $result->fetch_assoc()) {
            $this->setPlaca($row['placa']);
            $this->setEstacionado($row['estacionado']);
            $this->setHoraCheckIn($row['checkin']);
            $this->setHoraCheckOut($row['checkout']);
            return true;
        }

        return false;        
        
    }

    public function cadastrar($id) {
        require 'conectar.php';
        $sql = "
            INSERT INTO carro
                (placa, estacionado, checkin, checkout, id_usuario) 
            VALUES (
                    '".$this->getPlaca()."',
                    '".$this->getEstacionado()."',
                    '".$this->getHoraCheckIn()."',
                    '".$this->getHoraCheckOut()."',
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

    /**
     * Get the value of estacionado
     */ 
    public function getEstacionado()
    {
        return $this->estacionado;
    }

    /**
     * Set the value of estacionado
     *
     * @return  self
     */ 
    public function setEstacionado($estacionado)
    {
        $this->estacionado = $estacionado;

        return $this;
    }

    /**
     * Get the value of horaCheckIn
     */ 
    public function getHoraCheckIn()
    {
        return $this->horaCheckIn;
    }

    /**
     * Set the value of horaCheckIn
     *
     * @return  self
     */ 
    public function setHoraCheckIn($horaCheckIn)
    {
        $this->horaCheckIn = $horaCheckIn;

        return $this;
    }

    /**
     * Get the value of horaCheckOut
     */ 
    public function getHoraCheckOut()
    {
        return $this->horaCheckOut;
    }

    /**
     * Set the value of horaCheckOut
     *
     * @return  self
     */ 
    public function setHoraCheckOut($horaCheckOut)
    {
        $this->horaCheckOut = $horaCheckOut;

        return $this;
    }
}
?>