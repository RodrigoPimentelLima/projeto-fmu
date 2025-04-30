<?php

include("conexao.php"); // incluir a conexão do arquvi (conexao.php) 

if (isset($_POST['email']) || isset($_POST['password'])) {

    if (strlen($_POST['email']) == 0) {
        echo "Digite seu email"; // Caso não digite nada no campo email
    } else if (strlen($_POST['password']) == 0) {
        echo "Digite sua senha"; // Caso não digite nadea no campo senha 
    } else {

        $email = $mysqli->real_escape_string($_POST['email']); // Armazenar o email em uma variavel 
        $password = $mysqli->real_escape_string($_POST['password']); // Armazenar a senha em uma variavel 

        $sql_pesquisa = "SELECT * FROM cadastro WHERE cad_email = '$email'  AND nmu_senha = '$password'"; // Armazenar query (mysql) para pesquisar o email e senha na tabela 
        $sql_query = $mysqli->query($sql_pesquisa) or die("Erro de pesquisa query" . $mysqli->error); // Executar a variavel (query) no banco de dados 

        $quantidade = $sql_query->num_rows; // Armazenar o numeor de linhas da pesquisa em uma variavel 

        // Condição para verificar a quantidade de linhas e criar sessão 
        if ($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc();

            if (!isset($_SESSION)) {
                session_start(); // iniciar uma nova sessão
            }
            
            $_SESSION['email'] = $usuario['id_cadastro']; // Armazenar o ID do usuario na sessão

            header('Location: leadingpage.html'); // Direcionar para o arquivo leadingpage.hmtl
        } else {
            echo "erro no login";
        }
    }
}
