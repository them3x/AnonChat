<?php
// CREATE USER 'USER'@'localhost' IDENTIFIED BY 'PASS';
// CREATE DATABASE anonchat;
// GRANT ALL PRIVILEGES ON anonchat.* TO 'USER'@'localhost';
// CREATE TABLE thechat (chat LONGTEXT);

//DELETE FROM tabela WHERE coluna = valor;

$server = 'localhost';
$dbname = 'anonchat';
$user = 'francesco';
$pass = 'some_pass';

try {
        $pdo = new PDO("mysql:host=$server;dbname=$dbname",$user,$pass, array(
        PDO::ATTR_PERSISTENT => false
        ));
} catch (PDOException $e) {
//    echo $e;
    print "Erro de conexao.<br/>Por favor tente mais tarde.";
    die();
}

?>
