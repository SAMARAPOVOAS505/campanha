<?php
// Dados de conexão com o banco de dados
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "campanha";

// Conexão com o banco de dados
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

// Verifica se houve erro na conexão
if (!$conexao) {
    die("Erro de conexão: " . mysqli_connect_error());
}

// Recebe os dados do formulário
$nome = $_POST["nome"];
$email = $_POST["email"];
$whatsapp = $_POST["whatsapp"];

// Insere os dados na tabela "contato"
$sql = "INSERT INTO cadastro (nome, email, whatsapp) VALUES ('$nome', '$email', '$whatsapp')";
echo $sql;
echo $sql;

if (mysqli_query($conexao, $sql)) {
    echo " Dados inseridos com sucesso!";
} else {
    echo " Erro ao inserir dados: " . mysqli_error($conexao);
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>