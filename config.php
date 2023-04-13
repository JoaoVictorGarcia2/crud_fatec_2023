<?php

$host = "localhost"; // nome do servidor MySQL
$user = "id20421067_joaovictor"; // usuário do MySQL
$pass = "]lHN#ivf0DjFu_EE"; // senha do MySQL
$dbname = "id20421067_cebulo"; // nome do banco de dados

// Conexão com o banco de dados MySQL
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Verifica se houve erro na conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
