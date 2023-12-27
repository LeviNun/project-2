<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o botão de criação de projeto foi pressionado
    if (isset($_POST['criar_projeto'])) {
        $nome_projeto = $_POST['nome_projeto'];
        
        // Cria uma pasta para o projeto
        if (!file_exists($nome_projeto)) {
            mkdir('projetos/' . $nome_projeto);
            echo "Projeto '$nome_projeto' criado com sucesso.";
        } else {
            echo "O projeto '$nome_projeto' já existe.";
        }
    }

    // Verifica se o botão de adição de setor foi pressionado
    if (isset($_POST['adicionar_setor'])) {
        $nome_projeto = $_POST['projeto'];
        $nome_setor = $_POST['nome_setor'];
        
        // Cria uma pasta para o setor dentro do projeto
        $caminho_setor = 'projetos/' . $nome_projeto . '/' . $nome_setor;
        if (!file_exists($caminho_setor)) {
            mkdir($caminho_setor);
            echo "Setor '$nome_setor' adicionado ao projeto '$nome_projeto' com sucesso.";
        } else {
            echo "O setor '$nome_setor' já existe no projeto '$nome_projeto'.";
        }
    }

    // Verifica se o botão de upload de relatório foi pressionado
    if (isset($_POST['upload_relatorio'])) {
        $nome_projeto = $_POST['projeto'];
        $nome_setor = $_POST['setor'];

        // Define o caminho para a pasta do setor
        $caminho_setor = 'projetos/' . $nome_projeto . '/' . $nome_setor . '/';

        // Verifica se o diretório do setor existe
        if (file_exists($caminho_setor)) {
            // Define o caminho completo para o arquivo de relatório
            $caminho_relatorio = $caminho_setor . $_FILES['relatorio']['name'];

            // Move o arquivo de relatório para o diretório do setor
            move_uploaded_file($_FILES['relatorio']['tmp_name'], $caminho_relatorio);
            echo "Relatório enviado com sucesso para o setor '$nome_setor' do projeto '$nome_projeto'.";
        } else {
            echo "O setor '$nome_setor' não existe no projeto '$nome_projeto'.";
        }
    }
}
      // Função para obter a lista de projetos e setores
function obterProjetosSetores() {
    $projetosSetores = array();

    // Obtém todos os projetos no diretório atual
    $projetos = glob('*', GLOB_ONLYDIR);

    foreach ($projetos as $projeto) {
        // Para cada projeto, obtém os setores no diretório do projeto
        $setores = glob($projeto . '/*', GLOB_ONLYDIR);
        $projetosSetores[$projeto] = $setores;
    }

    return $projetosSetores;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lógica de gerenciamento adicional pode ser adicionada aqui conforme necessário
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Projetos</title>
</head>
<body>

<h1>Sistema de Projetos</h1>

<!-- Formulário para criar projeto -->
<form method="post" action="">
    <label for="nome_projeto">Nome do Projeto:</label>
    <input type="text" name="nome_projeto" required>
    <button type="submit" name="criar_projeto">Criar Projeto</button>
</form>

<!-- Formulário para adicionar setor -->
<form method="post" action="">
    <label for="projeto">Projeto:</label>
    <input type="text" name="projeto" required>
    <label for="nome_setor">Nome do Setor:</label>
    <input type="text" name="nome_setor" required>
    <button type="submit" name="adicionar_setor">Adicionar Setor</button>
</form>

<!-- Formulário para fazer upload de relatório -->
<form method="post" action="" enctype="multipart/form-data">
    <label for="projeto_relatorio">Projeto:</label>
    <input type="text" name="projeto" required>
    <label for="setor_relatorio">Setor:</label>
    <input type="text" name="setor" required>
    <label for="relatorio">Relatório:</label>
    <input type="file" name="relatorio" required>
    <button type="submit" name="upload_relatorio">Enviar Relatório</button>
</form>
<h1>Gerenciamento de Projetos</h1>

<!-- Lista de Projetos e Setores -->
<?php
$projetosSetores = obterProjetosSetores();

foreach ($projetosSetores as $projeto => $setores) {
    echo "<h2>Projeto: $projeto</h2>";

    if (empty($setores)) {
        echo "<p>Nenhum setor encontrado para este projeto.</p>";
    } else {
        echo "<ul>";
        foreach ($setores as $setor) {
            echo "<li>Setor: $setor</li>";
        }
        echo "</ul>";
    }
}
?>

</body>
</html>
