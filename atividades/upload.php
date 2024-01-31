<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload_relatorio"])) {
    // Verifica se o projeto foi fornecido
    $projeto = $_POST["projeto_upload"];

    if (empty($projeto)) {
        echo "Por favor, forneça o projeto.";
    } else {
        
        // Cria a pasta do projeto se não existir
<<<<<<< Updated upstream
        $caminho_projeto = '../projetos' . '/' . $projeto;
=======
        $caminho_projeto = '../arquivo' . '/' . $projeto;
>>>>>>> Stashed changes
        if (!file_exists($caminho_projeto)) {
            mkdir($caminho_projeto, 0777, true);
        }

        // Move o arquivo para a pasta do projeto
        $arquivo_temporario = $_FILES["arquivo"]["tmp_name"];
        $nome_arquivo = basename($_FILES["arquivo"]["name"]);
        $caminho_destino = $caminho_projeto . '/' . $nome_arquivo;

        if (move_uploaded_file($arquivo_temporario, $caminho_destino)) {

            // Inserir informações no banco de dados
            $conexao = new mysqli("localhost", "root", "", "sistemaacademico");

            if ($conexao->connect_error) {
                die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
            }

            // Verificar se o projeto existe e obter o ID
            $id_projeto = $projeto;

            // Continue com a inserção do relatório
            $nome_relatorio = $nome_arquivo;
            $caminho_pdf = $caminho_destino;
            $login_remetente = $_SESSION["login"];
            $sql = "INSERT INTO Relatorios (id_projeto, nome_relatorio, login_remetente, caminho_pdf)
             VALUES ('$id_projeto', '$nome_relatorio', '$login_remetente', '$caminho_pdf')";

            if ($conexao->query($sql) === TRUE) {
                echo "Relatório enviado com sucesso para o projeto $projeto e registrado no banco de dados.";
                
                // Adiciona um link para o arquivo enviado
                echo "<br><a href='$caminho_pdf' target='_blank'>Abrir Arquivo</a>";
            } else {
                echo "Erro ao enviar o relatório e registrar no banco de dados: " . $conexao->error;
            }

            $conexao->close();

        } else {
            echo "Erro ao enviar o relatório.";
        }
    }
}
?>
