<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "CRUD";

    $conection = new mysqli($servername,$username,$password,$dbname);

    if($conection->connect_error) {
        die("Conexao falhou: ".$conection->connect_error);
    }
?>