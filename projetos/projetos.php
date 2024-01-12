<?php 
include 'projj.php';
include 'bd_conectar.php'
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Projetos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
    <button type="submit" name="upload_relatorio">Enviar Relatório</button> <br> <br>
    
</form>
<form method = "POST">
    <label for="LabelBuscar">Adicionar funcionarios </label>

    <input id = "busca" type="text" name = "busca" placeholder = "adicione funcionarios" onkeyup ="carregar_colaboradores(this.value)">
    <span id = "resultado_pesquisa"></span>
    <input type="text" name = "msg" placeholder = "mensagem">
    <button type="submit" name="buttonBuscar" > Buscar funcionario </button> <br>
</form>
 

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST['busca'])) {
    

    <input type="text" name = "busca" placeholder = "adicione funcionarios">
    <input type="text" name = "msg" placeholder = "mensagem">
    <button type="submit" name="buttonBuscar" > Buscar funcionario </button> <br>
</form>
        
<table border= "1">
    <tr>
        <th>Nome</th> <br>
    </tr>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST['busca'])) {
            ?>
        <tr>
            <td colspan="3">Digite algo para pesquisar...</td>
        </tr>
        <?php

        } else {
             session_start();
        $cpf=$_SESSION['login'];
        $sqlii = "SELECT * FROM login WHERE cpf='$cpf'";
        $pesquisa = $mysqli->real_escape_string($_POST['busca']);
        $mensagenss =$_POST['msg'];
        $sql_queryy = $mysqli->query($sqlii) or die("ERRO ao consultar! " . $mysqli->error); 

        $sql_code = "SELECT * 
            FROM login 
            WHERE nome ='$pesquisa'";
        $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error); 

        if ($sql_query->num_rows == 0) {

             

                ?>
            <tr>
                <td colspan="1">Nenhum resultado encontrado...</td> <br> <br>
            </tr>
            <?php

            } else {
                $dadospara = $sql_query->fetch_assoc();
                $dadosde = $sql_queryy->fetch_assoc();
                $dataAtual = new DateTime();

                $nomede = $dadosde['cpf'];
                $nomepara =$dadospara['cpf'];

                $nomede = $dadosde['nome'];
                $nomepara =$dadospara['nome'];

                $mensagem = $mensagenss;
                $data = $dataAtual->format('d/m/Y');
                $sql_menss = " INSERT INTO notatividades(de, para, projeto, datanot) VALUES ('$nomede','$nomepara','$mensagem','$data')";
                $sql_mens = $mysqli->query($sql_menss) or die("ERRO ao consultar! " . $mysqli->error); 

                while($dadospara = $sql_query->fetch_assoc()) {
                   
        
                }

                while($dadosde = $sql_queryy->fetch_assoc()) {
                   
                    ?>
                    <tr>
                        <td><?php echo $dadosde['nome']; ?></td> 
                    </tr>
                    <?php
                }
                    
            }
        }
       
        }else{
            
        }
         
        //} ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="projeto.js";>
    
</script>

<!-- testando notificação -->
<form method = "POST">
    <label for="LabelBuscar">Adicionar funcionarios </label>
    <input type="text" name = "buscar" placeholder = "mandar para ?">
    <input type="text" name = "buscar1" placeholder = "mensagem">
    <button type="submit" name="buttonBuscar" > Buscar funcionario </button> <br>
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
