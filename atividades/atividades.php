<?php
<<<<<<< Updated upstream
<<<<<<< Updated upstream
include "bd_conectar.php"
=======
=======
>>>>>>> Stashed changes
require_once "..\banodedados/bd_conectar.php";
session_start();

$login = $_SESSION['login'];
$chave_sql = "SELECT col_projeto.*, projetos.* FROM col_projeto
              INNER JOIN projetos ON projetos.id_projeto = col_projeto.id_projeto
              WHERE col_projeto.login_colaborador = ?";
$stmt = $mysqli->prepare($chave_sql);
$stmt->bind_param("s", $login);
$stmt->execute();
$resultado = $stmt->get_result();
// Após inserir os dados do novo projeto no banco de dados
$id_projeto = $mysqli->insert_id;  // Obtém o ID do projeto recém-inserido

// Criação do diretório para o projeto
$caminho_projeto_fisico = '..\projetos/projetos/' . $id_projeto;

if (!is_dir($caminho_projeto_fisico)) {
    mkdir($caminho_projeto_fisico, 0777, true);  // Certifique-se de ter as permissões adequadas
}
if ($resultado->num_rows >= 1) {
    echo "<h4>Você está em projeto(s):</h4>";
} else {
    echo "<h4>No momento você não está em nenhum projeto!<h4>";
}
$idsEncontrados = array(); 
while ($dados = $resultado->fetch_assoc()) {
    if (!in_array($dados['id_projeto'], $idsEncontrados)) {
        $idsEncontrados[] = $dados['id_projeto'];
        $id_projeto = $dados['id_projeto'];
        $nome_projeto = $dados['nome_projeto'];
        $objetivo = $dados['objetivo'];
        $viw = $dados['viw'];

        echo '<div class="project-box">';
        if ($viw == 0) {
            echo '<div class="notification-badge"></div>';
        } 
        echo '<form method="POST">';
        echo '<div class="project-title">' . $nome_projeto . '</div>';
        echo '<div class="project-description">Objetivo: ' . $objetivo . '</div>';
        echo '<input type="hidden" name="data-id" value="' . $id_projeto . '">';
        echo '<button type="submit" name="botao_submit" class="project-button">Ver mais</button>';
        echo '</form>';
        echo '</div>';

        if (isset($_POST['botao_submit']) && $_POST['data-id'] == $id_projeto) {
            $viw = 1;
            $_SESSION['id_projeto'] = $id_projeto;
            $_SESSION['nome_projeto'] = $nome_projeto;
            $_SESSION['objetivo'] = $objetivo;

            $chave_atualizar = "UPDATE col_projeto SET viw = ? WHERE id_projeto = ?";
            $stmt_atualizar = $mysqli->prepare($chave_atualizar);
            $stmt_atualizar->bind_param("ii", $viw, $id_projeto);

            if ($stmt_atualizar->execute()) {
                header("Location: versetores.php");
                exit();
            } else {
                // Lidar com erro na execução da atualização
            }
        }
    }
}
echo "</div>";
>>>>>>> Stashed changes
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method = "POST">
    <label for="LabelBuscar">Adicionar funcionarios </label>
    <input type="text" name = "busca" placeholder = "adicione funcionarios">
    <label for="mostrar"> </label>
</form>
<?php

if (!isset($_POST['busca'])) {
    session_start();
    $cpf=$_SESSION['login'];
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
?>
</body>
</html>