<?php
include "bd_conectar.php";
// Certifique-se de validar e filtrar o valor do ID para evitar injeção de SQL ou outros ataques
$id_projeto = isset($_GET['id_projeto']) ? intval($_GET['id_projeto']) : 0;
$caminho_projeto = isset($_GET['caminho_projeto']) ? urldecode($_GET['caminho_projeto']) : '';

// Agora você pode usar $id_projeto e $caminho_projeto na sua página
echo "ID do Projeto: $id_projeto<br>";
echo "Caminho do Projeto: <a href='$caminho_projeto'> $caminho_projeto</a> ";
$chave_sql ="SELECT * FROM relatorios WHERE id_projeto='$id_projeto'";
$resultado_relatorios = $mysqli->query($chave_sql);

        if ($resultado_relatorios->num_rows > 0) {
            echo "<h2>Relatórios para o Projeto selecionado</h2>";
            echo "<ul>";

            while ($row = $resultado_relatorios->fetch_assoc()) {
                $nome_relatorio = $row["nome_relatorio"];
                $caminho_pdf = $row["caminho_pdf"];
                $login = $row["login_remetente"];
                
                $login_remetente = $row["login_remetente"];

                // Consulta para outra tabela usando o login
                $outra_tabela_sql = "SELECT * FROM login WHERE login='$login_remetente'";
                $resultado_outra_tabela = $mysqli->query($outra_tabela_sql);
                while ($outra_row = $resultado_outra_tabela->fetch_assoc()) {
                    $nome = $outra_row["nome"];
                    echo"funcionario: $nome";
                    echo "<li><a href='$caminho_pdf' target='_blank'>$nome_relatorio $login </a></li>";
                }
        
            }

            echo "</ul>";
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>