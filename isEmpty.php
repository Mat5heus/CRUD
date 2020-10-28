<?php

$valores = [        
    'empresa' => $_POST['empresa'],
    'nome_fantasia' => $_POST['nome_fantasia'],
    'cnpj' => $_POST['cnpj'],
    'nome' => $_POST['nome'],
    'cpf' => $_POST['cpf'],
    'cnh' => $_POST['cnh'],
    'placa' => $_POST['placa'],
    'telefone' => $_POST['telefone'],
    'email' => $_POST['email'],
    'senha' => $_POST['senha'],
    'pais' => $_POST['pais'],
    'estado' => $_POST['estado'],
    'cidade' => $_POST['cidade'],
    'bairro' => $_POST['bairro'],
    'rua' => $_POST['rua'],
    'numero' => $_POST['numero']
    ];

$isValid = true;
foreach($valores as $texto) {
    if(empty($texto)) {
        $isValid = false;
        break;
    }       
}


?>