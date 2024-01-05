<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload_relatorio"])) {
    // Verifica se o projeto e o setor foram fornecidos
    $projeto = $_POST["projeto"];
    $setor = $_POST["setor"];

    if (empty($projeto) || empty($setor)) {
        echo "Por favor, forneça o projeto e o setor.";
    } else {

        // Cria a pasta do projeto se não existir
        $caminho_projeto = 'projetos/' . DIRECTORY_SEPARATOR . $projeto .DIRECTORY_SEPARATOR. $setor;
        if (!file_exists($caminho_projeto)) {
            mkdir($caminho_projeto, 0777, true);
        }

        // Move o arquivo para a pasta do projeto
        $arquivo_temporario = $_FILES["arquivo"]["tmp_name"];
        $nome_arquivo = basename($_FILES["arquivo"]["name"]);
        $caminho_destino = $caminho_projeto . DIRECTORY_SEPARATOR . $nome_arquivo;

        if (move_uploaded_file($arquivo_temporario, $caminho_destino)) {
            echo "Relatório enviado com sucesso para o projeto $projeto, setor $setor.";
        } else {
            echo "Erro ao enviar o relatório.";
        }
    }
}
?>
