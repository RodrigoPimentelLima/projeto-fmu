<?php

/* Iiciando conexão com o banco de dados MYSQL e servidor xampp */
// Colocando o servidos e banco de dados nas variaveis 
$hostname = "localhost";
$bancodedados = "invest";
$usuario  = "root";
$senha = "";

// Nova conexão com o banco de dados MYSQL
$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

// Condicional caso não conecte no banco de dados 
if ($mysqli->connect_errno) {
  echo "falha ao conectar :(" . $mysqli->connect_errno . ")" . $mysqli->connect_errno;
} else
  echo "Conectado ao banco de dados <br>";

/* Fim da estrutura de conexão com banco de dados */

/* Iniciando a estrutura de envio de formulario para o banco de dados */
// isset puxa os dados da variavel global ($_post) quando for submitado  
if (isset($_POST["submit"])) {

  // Obten os dados de entrada (input) no formulario, colocando nas variaveis 
  $nome = ($_POST["nome"]);
  $email = ($_POST["Email"]);
  $password = ($_POST["password"]);

  // Esta variavel tem o valor de uma query de inserir dados em uma tabela do banco de dados
  $sql_pessoa = "INSERT INTO pessoa(nome) VALUES ('$nome')";

  // Etrutura de condição para verificar se os dados da variavel ($sql_pessoa) foi enviada para o banco 
  if (mysqli_query($mysqli, $sql_pessoa)) {
    echo "usuario cadastrado ";

    $id_pessoa = mysqli_insert_id($mysqli); // Esta variavel puxa o id da tabela pessoa no mysql

    // Variavel para inserir dados na tabela cadastro, junto com o id da tabela pessoa   
    $sql_cadastro = "INSERT INTO cadastro(id_pessoa,cad_email,nmu_senha) VALUES ('$id_pessoa','$email','$password')";

    // Verificar se foi enviado na tabela cadastro 
    if (mysqli_query($mysqli, $sql_cadastro)) {
      print_r('<br>');
      echo "Email e senha cadastrada ";
      header('Location: index.html');
    } else echo "Erro de cadastramento " . mysqli_error($myslqi); // Caso os dados não seja enviado para tabela cadastro
  } else echo "Erro no cadastramento do usuario  " . mysqli_error($mysqli); // Caso os dados não seja enviado para tabela pessoa
}
/* Fim da estrutura de envio de dados do formulario para o banco de dados */

// Mostar os erros  
error_reporting(E_ALL);
ini_set('display_errors', 1);
