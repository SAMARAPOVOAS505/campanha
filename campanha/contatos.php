<?php
    // Conexão com o banco de dados
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $database = "campanha";

    $conexao = mysqli_connect($servidor, $usuario, $senha, $database);

    // Recebe os dados do formulário
    if (isset($_POST['nome'])) {
        if (isset($_POST['codigo'])) {       
            // **** ALTERACAO (salva dados) ****
            $codigo = $_POST["codigo"];
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $whatsapp = $_POST["whatsapp"];

            // Atualiza os dados na tabela 
            $sql = "UPDATE cadastro SET nome = '$nome', email='$email', whatsapp='$whatsapp' WHERE codigo = '$codigo'";
            if (mysqli_query($conexao, $sql)) {
                echo "Dados alterados com sucesso!";
            }
        } else {
            // **** INCLUSAO (inclui dados) ****
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $whatsapp = $_POST["whatsapp"];
    
            // Insere os dados na tabela "contatos"
            $sql = "INSERT INTO cadastro (nome, email, whatsapp) VALUES ('$nome','$email','$whatsapp')";
            if (mysqli_query($conexao, $sql)) {
                echo " Dados inseridos com sucesso!";
            } else {
                echo " Erro ao inserir dados: " . mysqli_error($conexao);
            }
        }
    }

    // Verifica se o código do contato foi passado via GET
    if (isset($_GET['op'])) {
        $op=$_GET['op'];
        echo $op . "<br>";

        // **** EXCLUSAO ****
        if ($op == 'exc'){
            $codigo = $_GET['codigo'];
            $sql = "DELETE FROM cadastro WHERE codigo='$codigo'";
            $resultado = mysqli_query($conexao, $sql);
        }

        // **** ALTERACAO ****
        if ($op == 'alt'){
            $codigo = $_GET['codigo'];
            $op = $_GET['op'];
            
            // Consulta na tabela de contatos
            $sql = "SELECT codigo,nome,email,whatsapp FROM cadastro WHERE codigo='$codigo'";
            $resultado = mysqli_query($conexao, $sql);
    
            // Verifica se o contato foi encontrado
            if (mysqli_num_rows($resultado) > 0) {
            $cadastro = mysqli_fetch_array($resultado);
            ?>
                <h2>Edita contato</h2>
                <form action="contatos.php" method="post">
                <input type="hidden" name="codigo" value="<?php echo $cadastro['codigo']; ?>">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?php echo $cadastro['nome']; ?>"><br>
                <label for="email">e-mail:</label>
                <input type="text" name="email" id="email" value="<?php echo $cadastro['email']; ?>"><br>
                <label for="whatsapp">WhatsApp:</label>
                <input type="text" name="whatsapp" id="whatsapp" value="<?php echo $cadastro['whatsapp']; ?>"><br>
                <input type="submit" value="Salvar">
                </form>
            <?php
            }
        } 

        // **** CADASTRO ****
        if ($op == 'cad'){
            ?>
            <form action="contatos.php" method="post">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome"><br>
                <label for="email">e-mail</label>
                <input type="email" id="email" name="email" placeholder="Digite seu melhor e-mail"><br>
                <label for="whatsapp">WhatsApp</label>
                <input type="text" id="whatsapp" name="whatsapp" placeholder="Digite o número do seu WhatsApp"><br>
                <button>Cadastrar</button>
            </form>
            <?php
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contatos</title>
</head>

<body>
  <!-- Título da página -->
  <a href="contatos.php?op=cad">Inclui novo contato</a>

  <h2>Lista de contatos</h2>
  <!-- Tabela de exibição dos contatos -->
  <table>
    <!-- Cabeçalho da tabela -->
    <thead>
      <tr>
        <th>Nome</th>
        <th>e-mail</th>
        <th>WhatsApp</th>
      </tr>
    </thead>
    <!-- Corpo da tabela -->
    <tbody>
      <?php
      // Consulta na tabela de contatos
      $sql = "SELECT codigo,nome,email,whatsapp FROM cadastro";
      $resultado = mysqli_query($conexao, $sql);

      // Loop para exibir os resultados
      while ($cadastro = mysqli_fetch_array($resultado)) {
        echo "<tr>";

        echo "<td>" . $cadastro['nome'] . "</td>";
        echo "<td>" . $cadastro['email'] . "</td>";
        echo "<td>" . $cadastro['whatsapp'] . "</td>";
        echo "<td> <a href='contatos.php?op=exc&codigo=" . $cadastro['codigo'] . "'>Excluir</td>";
        echo "<td> <a href='contatos.php?op=alt&codigo=" . $cadastro['codigo'] . "'>Alterar</td>";
        echo "</tr>";
      }

      // Fechar a conexão com o banco de dados
      mysqli_close($conexao);
      ?>
    </tbody>
  </table>
</body>

</html>