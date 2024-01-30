<?php
session_start();
include 'bd_conectar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pasta_de_estilos/antes_projetos.css">
    <title>Document</title>
</head>
<body class="body">
    <form action="projetos.php" >
        <button class ="buttonsuperior" type="submit" id="butaosuperiordireito">Criar Projetos</button>
    </form>
</body>
<?php
    $sql = "SELECT id_projeto, nome_projeto, caminho_projeto, login_criador FROM projetos";
    $result = $mysqli->query($sql);

    // Verifica se há resultados
    if($result->num_rows > 1){
        echo('<h3> Seus projetos:</h3>');
        if ($result->num_rows > 0) {
            echo '<ul>';
            // Loop para percorrer os resultados e criar a lista
            while ($row = $result->fetch_assoc()) {
                if($row['login_criador'] == $_SESSION['login']){
                    $id_proj = $row["id_projeto"];
                    $caminho = $row["caminho_projeto"];
                    echo '<li><a href="verprojetoscriados.php?id_projeto=' . $id_proj . '&caminho_projeto=' . urlencode($caminho) . '">' . $row["nome_projeto"] . '</a></li>';
                }
            }
            echo '</ul>';    
            
        } else {
                echo '<p>Nenhum item encontrado no banco de dados.</p>';
        }
    }else{
        echo('<h3> Você ainda não criou nenhum projeto!</h3>');
    }
    
?>
</html>