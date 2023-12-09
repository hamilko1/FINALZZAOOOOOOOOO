<?php
    /*inicia uma sessão para armazenar os dados do usuário  */

$servername ="localhost";
$username ="root";
$password ="";      /*declarando as variáveias */
$dbname ="produtosdb";

$conn = new mysqli($servername, $username, $password, $dbname);  /*criando a conexão com o BD */ 

 if ($conn->connect_error) {  /*verificando a conexão com o BD */
    die("Falha na conexão: ". $conn->connect_error); /*caso dê erro, exibe a msng */
 }

 ?>