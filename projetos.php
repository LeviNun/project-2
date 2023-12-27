<?php
session_start();

$projetosFile = 'projetos.txt';

// Função para obter a lista de projetos
function obterProjetos() {
    global $projetosFile;

    // Verifica se o arquivo existe
    if (file_exists($projetosFile)) {
        // Lê o conteúdo do arquivo e retorna um array
        $projetos = file($projetosFile, FILE_IGNORE_NEW_LINES);
    } else {
        $projetos = [];
    }

    // Filtra projetos que possuem diretório correspondente
    $projetos = array_filter($projetos, function ($projeto) {
        return is_dir('uploads/' . strtolower(str_replace(' ', '_', $projeto)));
    });

    return $projetos;
}

// Função para adicionar um novo projeto ao arquivo
function adicionarProjeto($novoProjeto) {
    global $projetosFile;

    // Adiciona o novo projeto ao arquivo
    file_put_contents($projetosFile, $novoProjeto . PHP_EOL, FILE_APPEND);
}

// Função para obter a lista de pastas em um projeto
function obterPastas($projeto) {
    $projeto_pasta = 'uploads/' . strtolower(str_replace(' ', '_', $projeto));

    // Obtém todas as pastas no diretório do projeto
    return is_dir($projeto_pasta) ? array_diff(scandir($projeto_pasta), ['.', '..']) : [];
}

// Verifica se um formulário de criação de projeto foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['novo_projeto'])) {
    $novo_projeto_nome = $_POST['novo_projeto'];

    adicionarProjeto($novo_projeto_nome);

    echo "Projeto '$novo_projeto_nome' criado com sucesso.";
}


// Obtém a lista de projetos
$projetos = obterProjetos();

// Itera sobre os projetos
foreach ($projetos as $projeto) {
    echo "<option value=\"$projeto\">$projeto</option>";
}
// Verifica se um formulário de criação de projeto foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['novo_projeto'])) {
    $novo_projeto_nome = $_POST['novo_projeto'];

    // Adiciona o novo projeto ao arquivo
    adicionarProjeto($novo_projeto_nome);

    // Cria o diretório do projeto se ele não existir
    $projeto_pasta = 'uploads/' . strtolower(str_replace(' ', '_', $novo_projeto_nome));
    if (!file_exists($projeto_pasta)) {
        mkdir($projeto_pasta, 0777, true);
    }

    echo "Projeto '$novo_projeto_nome' criado com sucesso.";
}
// Verifica se um formulário de criação de pasta foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nova_pasta']) && isset($_POST['projeto_selecionado'])) {
    $nova_pasta_nome = $_POST['nova_pasta'];
    $projeto_selecionado = $_POST['projeto_selecionado'];

    $projeto_pasta = 'uploads/' . strtolower(str_replace(' ', '_', $projeto_selecionado));

    // Cria a pasta no diretório do projeto se ela não existir
    if (!file_exists("$projeto_pasta/$nova_pasta_nome")) {
        mkdir("$projeto_pasta/$nova_pasta_nome", 0777, true);
        echo "Pasta '$nova_pasta_nome' criada com sucesso em '$projeto_selecionado'.";
    } else {
        echo "Erro: A pasta '$nova_pasta_nome' já existe em '$projeto_selecionado'.";
    }
}

// Verifica se um formulário de upload de relatório foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['arquivo']) && isset($_POST['projeto_nome']) && isset($_POST['pasta_selecionada'])) {
    $arquivo_nome = $_FILES['arquivo']['name'];
    $arquivo_temp = $_FILES['arquivo']['tmp_name'];
    $projeto_nome = $_POST['projeto_nome'];
    $pasta_selecionada = $_POST['pasta_selecionada'];
    $projeto_pasta = 'uploads/' . strtolower(str_replace(' ', '_', $projeto_nome)) . '/' . $pasta_selecionada;

    // Criar a pasta do projeto se não existir
    if (!file_exists($projeto_pasta)) {
        mkdir($projeto_pasta, 0777, true);
    }

    // Mover o arquivo para a pasta do projeto
    $destino = $projeto_pasta . '/' . $arquivo_nome;
    move_uploaded_file($arquivo_temp, $destino);

    echo "Upload bem-sucedido! O arquivo está em: $destino";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Pastas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #gerenciador {
            width: 300px;
            margin: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        #pastas {
            list-style-type: none;
            padding: 0;
        }

        .pasta {
            cursor: pointer;
            margin-bottom: 5px;
        }

        .pasta:hover {
            background-color: #f0f0f0;
        }

        #conteudo-pasta {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div id="criar-projeto">
    <h2>Criar Novo Projeto</h2>

    <form action= "projetos.php" method="post">
        <label for="novo_projeto">Nome do Novo Projeto:</label>
        <input type="text" name="novo_projeto" required>
        <br>
        <input type="submit" value="Criar Projeto">
    </form>
</div>

<div>
    <h2>Formulário de Upload de Relatórios</h2>

    <form action="projetos.php" method="post" enctype="multipart/form-data">
        <label for="projeto_nome">Nome do Projeto:</label>
        <select name="projeto_nome">
            <?php
            $projetos = obterProjetos();
            foreach ($projetos as $projeto) {
                echo "<option value=\"$projeto\">$projeto</option>";
            }
            ?>
        </select>

        <label for="pasta_selecionada">Selecione a Pasta:</label>
        <select name="pasta_selecionada">
            <?php
            $projeto_selecionado = isset($_POST['projeto_selecionado']) ? $_POST['projeto_selecionado'] : null;
            if ($projeto_selecionado) {
                $pastas = obterPastas($projeto_selecionado);
                foreach ($pastas as $pasta) {
                    echo "<option value=\"$pasta\">$pasta</option>";
                }
            }
            ?>
        </select>

        <br>
        <label for="arquivo">Selecione um arquivo PDF:</label>
        <input type="file" name="arquivo" accept=".pdf" required>
        <br>
        <input type="submit" value="Enviar Relatório">
    </form>

    <div id="gerenciador">
        <h2>Gerenciador de Pastas</h2>
        <form action="projetos.php" method="post">
            <label for="projeto_selecionado">Selecione o Projeto:</label>
            <select name="projeto_selecionado">
                <?php
                foreach (obterProjetos() as $projeto) {
                    echo "<option value=\"$projeto\">$projeto</option>";
                }
                ?>
            </select>
            <br>
            <label for="nova_pasta">Nova Pasta:</label>
            <input type="text" name="nova_pasta" required>
            <br>
            <input type="submit" value="Criar Pasta">
        </form>

        <h3>Pastas:</h3>
        <ul id="pastas">
            <?php
            $projeto_selecionado = isset($_POST['projeto_selecionado']) ? $_POST['projeto_selecionado'] : null;
            if ($projeto_selecionado) {
                $pastas = obterPastas($projeto_selecionado);
                foreach ($pastas as $pasta) {
                    echo "<li class=\"pasta\">$pasta</li>";
                }
            }
            ?>
        </ul>
    </div>
</div>

</body>
</html>
