<?php
require_once '../conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br" class="no-js">

<head>
    <meta charset="utf-8" />
    <title>Cadastro de Cliente e Caso</title>
</head>

<body>

    <div class="form-container">
        <form>

            <?php
            // Verifica a conexão
            if ($conexao->connect_errno) {
                echo "erro";
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["cliente_nome"]) && isset($_POST["caso_nome"])) {
                    $cliente_nome = $_POST["cliente_nome"];
                    $caso_nome = $_POST["caso_nome"];

                    // Agora você pode prosseguir com o processamento dos dados
                } else {
                    header('Location: ../index_pri/?mensagem=Campos obrigatórios não foram preenchidos.');
                }
            } else {
                header('Location: ../index_pri/?mensagem=O cadastro não foi efetuado.');
            }

            // Recebe os dados do formulário
            $cliente_nome = $_POST["cliente_nome"];
            $caso_nome = $_POST["caso_nome"];

            // Verifica se o cliente já existe no banco de dados
            $sqlVerificarCliente = "SELECT ID FROM cliente WHERE Nome = '$cliente_nome'";
            $resultado = $conexao->query($sqlVerificarCliente);

            if ($resultado->num_rows > 0) {
                // O cliente já existe, recupera o ID do cliente existente
                $row = $resultado->fetch_assoc();
                $clienteID = $row["ID"];

                // Verifica se o caso já existe para o cliente
                $sqlVerificarCaso = "SELECT ID FROM casos WHERE ClienteID = $clienteID AND NomeCaso = '$caso_nome'";
                $resultadoCaso = $conexao->query($sqlVerificarCaso);

                if ($resultadoCaso->num_rows > 0) {
                    // O caso já existe, apenas mostre a mensagem
                    header('Location: ../index_pri/?mensagem=O caso já está cadastrado.');
                } else {
                    // O caso não existe, insere um novo caso
                    $sqlInserirCaso = "INSERT INTO casos (ClienteID, NomeCaso) VALUES ($clienteID, '$caso_nome')";
                    if ($conexao->query($sqlInserirCaso) === TRUE) {
                        // Redireciona para a página anterior com mensagem
                        header('Location: ../index_sec/?mensagem=Caso inseridos com sucesso!');
                        exit;
                    } else {
                        echo "Erro ao inserir o caso: " . $conexao->error;
                    }
                }
            } else {
                // O cliente não existe, insira um novo cliente e o caso
                $sqlInserirCliente = "INSERT INTO cliente (Nome) VALUES ('$cliente_nome')";
                if ($conexao->query($sqlInserirCliente) === TRUE) {
                    $clienteID = $conexao->insert_id;

                    $sqlInserirCaso = "INSERT INTO casos (ClienteID, NomeCaso) VALUES ($clienteID, '$caso_nome')";
                    if ($conexao->query($sqlInserirCaso) === TRUE) {
                        // Redireciona para o index secundário
                        header('Location: ../index_sec/?mensagem=Cliente e caso inseridos com sucesso!');
                        exit;
                    } else {
                        echo "Erro ao inserir o caso: " . $conexao->error;
                    }
                } else {
                    echo "Erro ao inserir o cliente: " . $conexao->error;
                }
            }

            // Fecha a conexão com o banco de dados
            $conexao->close();
            ?>
        </form>

    </div>
</body>
</html>