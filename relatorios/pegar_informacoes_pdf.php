<?php
require_once "..\bancodedados/bd_conectar.php";
$con = new Conexao();
$mysqli = $con->connect();
function verificaPrograma11()
{
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_sql_verificar = "SELECT * FROM programa AS prog INNER JOIN metas AS met ON prog.id_programa = met.id_programa";
    $stmt = $mysqli->prepare($chave_sql_verificar);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Iterando sobre os resultados e exibindo-os
    foreach ($resultados as $resultado) {
        if($resultado['tem_indicador'] == 1){
             // Exemplo: mostrando o valor de algumas colunas
        echo "ID do Programa: " . $resultado['id_programa'];
        echo "\nNome do Programa: " . $resultado['nome_programa'] ;
        echo "\nDescrição da Meta: " . $resultado['nome_meta'];
        // Adicione mais linhas de código conforme necessário para exibir outros dados
        }else{
            echo("\nNão tem indicador\n");
        }
       
    }
    $rgt = $stmt->rowCount();
    return ($rgt);
}
?>