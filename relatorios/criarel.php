<?php
session_start();

// Inicializar a variável de sessão 'relatorios' se não estiver definida
if (!isset($_SESSION['relatorios'])) {
    $_SESSION['relatorios'] = array();
}

// Adicionar condição para criar relatório
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['criar_relatorio_form'])) {
    // Obter dados do formulário
    $nome_projeto = $_POST['nome_projeto'];
    $data_projeto = $_POST['data_projeto'];
    $percentual_conclusao = $_POST['conclusao_projeto'];
    $titulo = $_POST['titulo'];
    $observacao = $_POST['observacao'];
    $metas = $_POST['metas'];
    $prazos = $_POST['prazos'];
    $andamentos = $_POST['andamentos'];
    $objetivos = $_POST['objetivos'];
    $comentarios = $_POST['comentarios'];

    // Array para armazenar os caminhos dos arquivos anexados
    $anexos = array();

    // Diretório onde os anexos serão armazenados
    $anexos_dir = 'uploads/';

    // Limitar o número máximo de arquivos para 10
    $max_files = 10;

    // Tratar o upload dos arquivos
    for ($i = 0; $i < $max_files; $i++) {
        // Verificar se o arquivo foi enviado
        if (!empty($_FILES['anexos']['name'][$i])) {
            $filename = $_FILES['anexos']['name'][$i];
            $anexo_path = $anexos_dir . basename($filename);

            if (move_uploaded_file($_FILES['anexos']['tmp_name'][$i], $anexo_path)) {
                $anexos[] = $anexo_path;
            } else {
                echo "Erro ao realizar upload do arquivo {$filename}.";
            }
        }
    }

    // Gerar identificador único para o relatório
    $relatorioId = $titulo;

    // Relatório com informações e caminhos dos anexos
    $relatorio = array(
        'id' => $relatorioId,
        'nome_projeto' => $nome_projeto,
        'data_projeto' => $data_projeto,
        'conclusao_projeto' => $percentual_conclusao,
        'titulo' => $titulo,
        'observacao' => $observacao,
        'metas' => $metas,
        'prazos' => $prazos,
        'andamentos' => $andamentos,
        'objetivos' => $objetivos,
        'comentarios' => $comentarios,
        'anexos' => $anexos  // Armazenar os caminhos dos anexos
    );

    // Armazenar o array do relatório na variável de sessão
    $_SESSION['relatorios'][$relatorioId] = json_encode($relatorio);

    // Redirecionar de volta para a página de relatórios após criar o relatório
    header("Location: relatorios.php");
    exit();
}
?>