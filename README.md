# AnonCHAT

<br><br>

Um pagina web feita para funcionar na rede TOR, sem javascript, funcionando apenas com PHP, MySQL e HTML.

<br><br>
-----------


<br>

## Dependencias
- SQLDatabase (MySQL, Maria DB, etc..)
- PHP
- WebServer (Apache, Nginx, etc..)

-----------


## Instalação

>git clone https://github.com/them3x/AnonChat

#### MySQL

Criando e configurando ususaro MySQL

>CREATE USER 'USER'@'localhost' IDENTIFIED BY 'PASS';

>CREATE DATABASE anonchat;

>GRANT ALL PRIVILEGES ON anonchat.* TO 'USER'@'localhost';

Criando tabela para os chats

>USE anonchat;
>CREATE TABLE thechat (chat LONGTEXT);

-----------

#### Configurando

- Edite o arquivo: database.php. (Siga as variaveis adicionando o usuario e senha do MySQL)
- Edite o arquivo: encrypt.php. (Altere aS variaveis [ $key ] definindo uma chave para criação de cookies)
