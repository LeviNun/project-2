<?php
include "bd_conectar.php";
session_start();
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .body{
        margin: 20;
        font-family: 'Arial', sans-serif;
        background-color: #f0f0f0;
        display: flex;
        flex-direction: column;
        height: 100vh;
        margin-left: 20px;
    }
    /* Estilo para a caixa de projeto */
    .project-box {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 15px;  /* Reduzi o padding */
        margin: 10px;  /* Reduzi a margem */
        max-width: 300px;  /* Reduzi o tamanho máximo */
        width: 100%;
    }

    .project-title {
        font-size: 20px;  /* Reduzi o tamanho da fonte do título */
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;  /* Reduzi a margem inferior do título */
    }

    .project-description {
        font-size: 14px;  /* Reduzi o tamanho da fonte da descrição */
        color: #666;
        margin-bottom: 15px;  /* Reduzi a margem inferior da descrição */
    }

    .project-button {
        background-color: #4caf50;
        color: #fff;
        padding: 8px 12px;  /* Reduzi o padding do botão */
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;  /* Reduzi o tamanho da fonte do botão */
    }

    .project-button:hover {
        background-color: #45a049;
    }

</style>
<body class ="body">
<form method = "POST">
    <div class="project-box">
        <div class="project-title">Título do Projeto</div>
        <div class="project-description">Descrição do Projeto vai aqui...</div>
        <button class="project-button">Detalhes</button>
    </div>  
    <label for="LabelBuscar">Adicionar funcionarios </label>
    <input type="text" name = "busca" placeholder = "adicione funcionarios">
    <label for="mostrar"> </label>
</form>

<?php
    $login=$_SESSION['login'];
    $chave_sql="SELECT * FROM col_projeto WHERE login_colaborador='$login'";
    $resultado = $mysqli->query($chave_sql);
    if($resultado->num_rows > 1){
        echo"<h4>você está em alguns projetos:</h4>";
        while($dados = $resultado->fetch_assoc()){
            $id_projeto=$dados['id_projeto'];
            $chave_nome_proj="SELECT * FROM projetos WHERE id_projeto='$id_projeto'";
            $resultados = $mysqli->query($chave_nome_proj);
           
            while($dadosnome = $resultados->fetch_assoc()){
                $nome_projeto =$dadosnome['nome_projeto'];
                $objetivo=$dadosnome['objetivo'];
                $caminho=$dadosnome['caminho_projeto'];
                echo '<li><a href="verprojetoscriados.php?id_projeto=' . $id_projeto . '&caminho_projeto=' . urlencode($caminho) . '">' . $dadosnome["nome_projeto"] . '</a></li>';
                //echo"<h4>$nome_projeto</h4>";
                //echo"<h5>$objetivo</h5>";
            }
        }
        
        echo "</div>";
    }else if($resultado->num_rows == 1){
        echo"<h4>você está em um projetos</h4>";
        while($dados = $resultado->fetch_assoc()){
            $id_projeto=$dados['id_projeto'];
            $chave_nome_proj="SELECT * FROM projetos WHERE id_projeto='$id_projeto'";
            $resultados = $mysqli->query($chave_nome_proj);
           
            while($dadosnome = $resultados->fetch_assoc()){
                $nome_projeto =$dadosnome['nome_projeto'];
                $objetivo=$dadosnome['objetivo'];
                $caminho=$dadosnome['caminho_projeto'];
                echo '<li><a href="verprojetoscriados.php?id_projeto=' . $id_projeto . '&caminho_projeto=' . urlencode($caminho) . '">' . $dadosnome["nome_projeto"] . '</a></li>';
                //echo"<h4>$nome_projeto</h4>";
                //echo"<h5>$objetivo</h5>";
            }
        }
        echo "</div>";
    }else{
        $text="No momento você não está em nenhum projeto!";
        echo"<h5>$text<h5>";
    }
/*
if (!isset($_POST['busca'])) {
    session_start();
    $cpf=$_SESSION['cpf'];
    $sqlii = "SELECT * FROM login WHERE cpf='$cpf'";
    $sql_queryy = $mysqli->query($sqlii) or die("ERRO ao consultar! " . $mysqli->error); 
    $dadosde = $sql_queryy->fetch_assoc();
    $nomede = $dadosde['cpf'];
    $chavesql = "SELECT * FROM notatividades WHERE para='$nomede'";
    $sql_query = $mysqli->query($chavesql) or die("ERRO ao consultar! " . $mysqli->error); 
    
    if($sql_query->num_rows != 0){
        while($dadosde = $sql_query->fetch_assoc()){
            ?>
            <h5> <?php echo $dadosde['projeto']?></h5>
            <?php
        }
    }
}
*/
?>
</body>
</html>