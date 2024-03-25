<?php
require_once "..\bancodedados/bd_conectar.php";
$con = new Conexao();
$mysqli = $con->connect();

function verificaPrograma($programaId){
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_sql_verificar = "SELECT id_programa FROM programa WHERE id_programa=:id_programa";
    $stmt = $mysqli->prepare($chave_sql_verificar);
    
    $stmt->bindParam(":id_programa", $programaId);
    $stmt->execute();
    
    $rgt = $stmt->rowCount();
    return($rgt);
}
function verificarMeta($metaid){
    $con = new Conexao();
    $mysqli = $con->connect();
    
    $chave_sql_verificar = "SELECT id_meta FROM metas WHERE id_meta=:id_meta";
    $stmt = $mysqli->prepare($chave_sql_verificar);
    
    $stmt->bindParam(":id_meta", $metaid);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return($rgt);
}
function verificarIndicador($indicadorid){
    $con = new Conexao();
    $mysqli = $con->connect();
    
    $chave_sql_verificar_indicador = "SELECT id_indicador FROM indicadores WHERE id_indicador=:id_indicador";
    $stmt = $mysqli->prepare($chave_sql_verificar_indicador);
    
    $stmt->bindParam(":id_indicador", $indicadorid);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return($rgt);
}
function verificarPrevisoes($previsao_inicial,$previsao_final){
    $con = new Conexao();
    $mysqli = $con->connect();
    
    $chave_sql_verificar_previsoes = "SELECT * FROM previsoes WHERE id_previsao_inicial=:id_previsao_inicial AND id_previsao_final=:id_previsao_final ";
    $stmt = $mysqli->prepare($chave_sql_verificar_previsoes);
    
    $stmt->bindParam(":id_previsao_inicial", $previsao_inicial);
    $stmt->bindParam(":id_previsao_final", $previsao_final);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return($rgt);
}
function verificarTableaContratos($id_tabela_total){
    $con = new Conexao();
    $mysqli = $con->connect();
    
    $chave_verificar_tb_contratos = "SELECT * FROM tb_contratos WHERE id_tabela=:id_tabela";
    $stmt = $mysqli->prepare($chave_verificar_tb_contratos);
    
    $stmt->bindParam(":id_tabela", $id_tabela_total);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return($rgt);
}
function verificaTabelaPrevisoes($id_tabela_previsoes){
    $con = new Conexao();
    $mysqli = $con->connect();
    
    $chave_verificar_tb_previsoes = "SELECT * FROM tb_previsoes WHERE id_tabela=:id_tabela";
    $stmt = $mysqli->prepare($chave_verificar_tb_previsoes);
    
    $stmt->bindParam(":id_tabela", $id_tabela_previsoes);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return($rgt);
}
function verificaTextoAvaliativo($id_texto_avaliativo){
    $con = new Conexao();
    $mysqli = $con->connect();
    
    $chave_verificar_texto_avaliativo = "SELECT * FROM texto_avaliativo WHERE id_texto_avaliativo=:id_texto_avaliativo";
    $stmt = $mysqli->prepare($chave_verificar_texto_avaliativo);
    
    $stmt->bindParam(":id_texto_avaliativo", $id_texto_avaliativo);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return($rgt);
}

function inserirPrograma($programaId,$programaValor,$data){
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_inserir_programa = "INSERT INTO programa(id_programa, nome_programa, data_criada) VALUES(:id_programa,:nome,:data_criada)";
    $stmt = $mysqli->prepare($chave_inserir_programa);
    $stmt->bindParam(":id_programa", $programaId);
    $stmt->bindParam(":nome", $programaValor);
    $stmt->bindParam(":data_criada", $data);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return($rgt);
}
function inserirMeta($programaId,$metaid,$metavalor,$tem_indicador,$data){
    $con = new Conexao();
    $mysqli = $con->connect();
    $result = verificarMeta($metaid);
    if($result==0){
        $chave_inserir_meta = "INSERT INTO metas(id_programa, id_meta, nome_meta,tem_indicador,dt_criada) VALUES(:id_programa,:id_meta,:nome,:tem_indicador,:data_criada)";
        $stmt = $mysqli->prepare($chave_inserir_meta);
        $stmt->bindParam(":id_programa", $programaId);
        $stmt->bindParam(":id_meta", $metaid);
        $stmt->bindParam(":nome", $metavalor);
        $stmt->bindParam(":tem_indicador", $tem_indicador);
        $stmt->bindParam(":data_criada", $data);
        $stmt->execute();
        $rgt = $stmt->rowCount();
        return($rgt);
    }else{
        return(0);
    }
}
function inserirIndicador($metaid,$indicadorid,$indicadorValor,$data){
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_inserir_indicador = "INSERT INTO indicadores(id_meta, id_indicador, nome,dt_criada) VALUES(:id_meta,:id_indicador,:nome,:data_criada)";
    $stmt = $mysqli->prepare($chave_inserir_indicador);
    $stmt->bindParam(":id_meta", $metaid);
    $stmt->bindParam(":id_indicador", $indicadorid);
    $stmt->bindParam(":nome", $indicadorValor);
    $stmt->bindParam(":data_criada", $data);
    $stmt->execute();

    $rgt = $stmt->rowCount();
    return($rgt);
}
function inserirPrevisoes($indicadorid,$previsao_inicial,$previsao_final,$valorinicial,$valorfinal,$data){
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_inserir_previsoes = "INSERT INTO previsoes(id_indicador,id_previsao_inicial,id_previsao_final,nome_previsao_inicial,nome_previsao_final,dt_criada)
    VALUES(:id_indicador,:id_previsao_inicial,:id_previsao_final,:nome_previsao_inicial,:nome_previsao_final,:data_criada)";
    $stmt = $mysqli->prepare($chave_inserir_previsoes);
    $stmt->bindParam(":id_indicador", $indicadorid);
    $stmt->bindParam(":id_previsao_inicial", $previsao_inicial);
    $stmt->bindParam(":id_previsao_final", $previsao_final);
    $stmt->bindParam(":nome_previsao_inicial", $valorinicial);
    $stmt->bindParam(":nome_previsao_final", $valorfinal);
    $stmt->bindParam(":data_criada", $data);
    $stmt->execute();

    $rgt = $stmt->rowCount();
    return($rgt);
}
function inserirTableaContratos($indicadorid,$id_tabela_total,$total_contratos, $total_executados,$data){
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_inserir_tabela_contratos = "INSERT INTO tb_contratos(id_indicador,id_tabela,total_contratos,total_executados,dt_criada)
    VALUES(:id_indicador,:id_tabela,:total_contratos,:total_executados,:data_criada)";
    $stmt = $mysqli->prepare($chave_inserir_tabela_contratos);
    $stmt->bindParam(":id_indicador", $indicadorid);
    $stmt->bindParam(":id_tabela", $id_tabela_total);
    $stmt->bindParam(":total_contratos", $total_contratos);
    $stmt->bindParam(":total_executados", $total_executados);
    $stmt->bindParam(":data_criada", $data);
    $stmt->execute();

    $rgt = $stmt->rowCount();
    return($rgt);
}
function inserirDadosContratos($id_tabela_total,$elementos_total_por_ano,$ano){
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_inserir_total_por_ano = "INSERT INTO total_por_ano(id_tabela,valor,ano) VALUES(:id_tabela,:valor,:ano)";
    $stmt = $mysqli->prepare($chave_inserir_total_por_ano);
    $stmt->bindParam(":id_tabela", $id_tabela_total);
    $stmt->bindParam(":valor", $elementos_total_por_ano);
    $stmt->bindParam(":ano", $ano);
    $stmt->execute();

    $rgt = $stmt->rowCount();
    return($rgt);
}
function inserirDadosExecutados($id_tabela_total,$elementos_executado_por_ano,$ano){
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_inserir_total_por_ano = "INSERT INTO total_executados(id_tabela,valor,ano) VALUES(:id_tabela,:valor,:ano)";
    $stmt = $mysqli->prepare($chave_inserir_total_por_ano);
    $stmt->bindParam(":id_tabela", $id_tabela_total);
    $stmt->bindParam(":valor", $elementos_executado_por_ano);
    $stmt->bindParam(":ano", $ano);
    $stmt->execute();

    $rgt = $stmt->rowCount();
    return($rgt);
}
function inserirTableaPrevistos($indicadorid,$id_tabela_previsoes,$total_previstos,$total_realizados,$acumulativo,$data){
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_inserir_tabela_previsoes = "INSERT INTO tb_previsoes(id_indicador,id_tabela,total_previstos,total_realizados,acumulativo,dt_criada)
    VALUES(:id_indicador,:id_tabela,:total_previstos,:total_realizados,:acumulativo,:data_criada)";
    $stmt = $mysqli->prepare($chave_inserir_tabela_previsoes);
    $stmt->bindParam(":id_indicador", $indicadorid);
    $stmt->bindParam(":id_tabela", $id_tabela_previsoes);
    $stmt->bindParam(":total_previstos", $total_previstos);
    $stmt->bindParam(":total_realizados", $total_realizados);
    $stmt->bindParam(":acumulativo", $acumulativo);
    $stmt->bindParam(":data_criada", $data);
    $stmt->execute();

    $rgt = $stmt->rowCount();
    return($rgt);
}
function inserirDadosPrevistos($id_tabela_previsoes,$elementos_previsto_trimestre,$array_timestre){
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_inserir_previsto_trimestre = "INSERT INTO previstos_no_trimestre(id_tabela,valor,bimestre_trimestre) VALUES(:id_tabela,:valor,:bimestre_trimestre)";
    $stmt = $mysqli->prepare($chave_inserir_previsto_trimestre);
    $stmt->bindParam(":id_tabela", $id_tabela_previsoes);
    $stmt->bindParam(":valor", $elementos_previsto_trimestre);
    $stmt->bindParam(":bimestre_trimestre", $array_timestre);
    $stmt->execute();

    $rgt = $stmt->rowCount();
    return($rgt);
}   
function inserirDadosRealizados($id_tabela_previsoes,$elementos_realizados_trimestre,$array_timestre){
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_inserir_realizados_trimestre = "INSERT INTO realizados_no_trimestre(id_tabela,valor,bimestre_trimestre) VALUES(:id_tabela,:valor,:bimestre_trimestre)";
    $stmt = $mysqli->prepare($chave_inserir_realizados_trimestre);
    $stmt->bindParam(":id_tabela", $id_tabela_previsoes);
    $stmt->bindParam(":valor", $elementos_realizados_trimestre);
    $stmt->bindParam(":bimestre_trimestre", $array_timestre);
    $stmt->execute();

    $rgt = $stmt->rowCount();
    return($rgt);
}
function inserirTextoAvaliativo($indicadorid,$id_texto_avaliativo,$valor,$data){
    $con = new Conexao();
    $mysqli = $con->connect();
    $chave_inserir_texto_avaliativo = "INSERT INTO texto_avaliativo(id_indicador,id_texto_avaliativo,valor,dt_criada) VALUES(:id_indicador,:id_texto_avaliativo,:valor,:data_criada)";
    $stmt = $mysqli->prepare($chave_inserir_texto_avaliativo);
    $stmt->bindParam(":id_indicador", $indicadorid);
    $stmt->bindParam(":id_texto_avaliativo", $id_texto_avaliativo);
    $stmt->bindParam(":valor", $valor);
    $stmt->bindParam(":data_criada", $data);
    $stmt->execute();
    $rgt = $stmt->rowCount();
    return($rgt);
}
?>