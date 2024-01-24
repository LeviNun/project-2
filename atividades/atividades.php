<?php
include "bd_conectar.php";
session_start();
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pasta_de_estilos/atividades.css">
    <title>Document</title>
</head>
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
                //  echo '<li><a href="verprojetoscriados.php?id_projeto=' . $id_projeto . '&caminho_projeto=' . urlencode($caminho) . '">' . $dadosnome["nome_projeto"] . '</a></li>';
                //echo"<h4>$nome_projeto</h4>";
                //echo"<h5>$objetivo</h5>";
                
                echo '<body class="body">
                <form method="POST">
                    <div class="project-box">
                        <div class="project-title">'.$nome_projeto.'</div>
                        <div class="project-description">Objetivo: '.$objetivo.'</div>
                        <button class="project-button">Detalhes</button>
                    </div>  
                </form>
                </body>';
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
                //echo '<li><a href="verprojetoscriados.php?id_projeto=' . $id_projeto . '&caminho_projeto=' . urlencode($caminho) . '">' . $dadosnome["nome_projeto"] . '</a></li>';
                //echo"<h4>$nome_projeto</h4>";
                //echo"<h5>$objetivo</h5>";
                echo '<body class="body">
                <form method="POST">
                    <div class="project-box">
                        <div class="project-title">'.$nome_projeto.'</div>
                        <div class="project-description">Objetivo: '.$objetivo.'</div>
                        <button class="project-button">Detalhes</button>
                    </div>  
                </form>
                </body>';
            }
        }
        echo "</div>";
    }else{
        $text="<h4>No momento você não está em nenhum projeto!<h4>";
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