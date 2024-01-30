<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload_relatorio"])) {
    // Constantes de configuração
    define("DIRETORIO_PROJETOS", '../projetos/projetos');
    define("EXTENSOES_PERMITIDAS", ["pdf", "doc", "docx"]);

    // Verifica se o projeto foi fornecido
    $projeto = $_POST["projeto_upload"];

    if (empty($projeto)) {
        echo "Por favor, forneça o projeto.";
    } else {
        // Cria a pasta do projeto se não existir
        $caminho_projeto = DIRETORIO_PROJETOS . '/' . $projeto;

        if (!file_exists($caminho_projeto)) {
            if (!mkdir($caminho_projeto, 0777, true)) {
                throw new Exception("Erro ao criar a pasta do projeto.");
            }
        }

        // Move o arquivo para a pasta do projeto
        $arquivo_temporario = $_FILES["arquivo"]["tmp_name"];
        $nome_arquivo = basename($_FILES["arquivo"]["name"]);
        $caminho_destino = $caminho_projeto . '/' . $nome_arquivo;

        // Verifica o tipo de arquivo usando mime_content_type
        $tipo_mime = mime_content_type($arquivo_temporario);
        if (!in_array($tipo_mime, ["application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"])) {
            throw new Exception("Erro: Apenas arquivos PDF, DOC e DOCX são permitidos.");
        }

        if (move_uploaded_file($arquivo_temporario, $caminho_destino)) {
            // Inserir informações no banco de dados
            $conexao = new mysqli("localhost", "root", "", "sistemaacademico");

            if ($conexao->connect_error) {
                throw new Exception("Falha na conexão com o banco de dados: " . $conexao->connect_error);
            }

            // Utilizar declaração preparada para evitar injeção de SQL
            $stmt = $conexao->prepare("INSERT INTO relatorios (id_projeto, nome_relatorio, login_remetente, caminho_pdf) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $id_projeto, $nome_relatorio, $login_remetente, $caminho_pdf);

            $id_projeto = $projeto;
            $nome_relatorio = $nome_arquivo;
            $login_remetente = $_SESSION["login"];
            $caminho_pdf = $caminho_destino;

            if ($stmt->execute()) {
                echo "Relatório enviado com sucesso para o projeto $projeto e registrado no banco de dados.";

                // Adiciona um link para o arquivo enviado
                echo "<br><a href='$caminho_pdf' target='_blank'>Abrir Arquivo</a>";
            } else {
                throw new Exception("Erro ao enviar o relatório e registrar no banco de dados: " . $stmt->error);
            }

            $stmt->close();
            $conexao->close();
        } else {
            throw new Exception("Erro ao enviar o relatório.");
        }
    }
}
?>
