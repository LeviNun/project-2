<?php

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
    <title>Gerenciamento de Projetos</title>
</head>
<body>

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
