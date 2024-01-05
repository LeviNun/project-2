<?php include 'projj.php';?>

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
    <label for="projeto">Escolha um projeto:</label>
    <select name="projeto" id="projeto">
        <?php
        // Caminho para o diretório local
        $caminho = 'projetos/';

        // Verifica se o diretório existe
        if (is_dir($caminho)) {
            // Lê os diretórios dentro do caminho especificado
            $pastas = scandir($caminho);

            // Remove os diretórios "." e ".."
            $pastas = array_diff($pastas, array('..', '.'));

            // Exibe cada pasta como uma opção no combo box
            foreach ($pastas as $pasta) {
                echo "<option value=\"$pasta\">$pasta</option>";
            }
        } else {
            echo "<option value=\"\">Diretório não encontrado</option>";
        }
        ?>
    </select>
    <label for="nome_setor">Nome do Setor:</label>
    <input type="text" name="nome_setor" id="nome_setor" required>
    <button type="submit" name="adicionar_setor">Adicionar Setor</button>
</form>

<!-- Formulário para fazer upload de relatório -->
<form method="post" action="upload.php" enctype="multipart/form-data">
    <label for="projeto_upload">Escolha um projeto:</label>
    <select name="projeto_upload" id="projeto_upload">
        <?php
        // Caminho para o diretório local
        $caminho = 'projetos/';

        // Verifica se o diretório existe
        if (is_dir($caminho)) {
            // Lê os diretórios dentro do caminho especificado
            $pastas = scandir($caminho);

            // Remove os diretórios "." e ".."
            $pastas = array_diff($pastas, array('..', '.'));

            // Exibe cada pasta como uma opção no combo box
            foreach ($pastas as $pasta) {
                echo "<option value=\"$pasta\">$pasta</option>";
            }
        } else {
            echo "<option value=\"\">Diretório não encontrado</option>";
        }
        ?>
    </select>
    <label for="setor_upload">Setor:</label>
    <select name="setor_upload" id="setor_upload"></select>
    <label for="arquivo">Selecione o arquivo:</label>
    <input type="file" name="arquivo" id="arquivo" required> 
    <button type="submit" name="upload_relatorio">Enviar Relatório</button>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var projetoSelect = document.getElementById('projeto_upload');
    var setorSelect = document.getElementById('setor_upload');

    projetoSelect.addEventListener('change', function() {
        var projetoSelecionado = projetoSelect.value;
        if (projetoSelecionado) {
            // Enviar requisição para obter setores correspondentes ao projeto
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var setores = this.responseText.split(',');
                    // Limpar e preencher o campo de setores
                    setorSelect.innerHTML = "";
                    for (var i = 0; i < setores.length; i++) {
                        var option = document.createElement("option");
                        option.text = setores[i];
                        setorSelect.add(option);
                    }
                }
            };

            xhr.open("POST", "projj.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("projeto=" + projetoSelecionado);
        } else {
            // Limpar o campo de setores se nenhum projeto for selecionado
            setorSelect.innerHTML = "";
        }
    });
});
</script>

</body>
</html>
