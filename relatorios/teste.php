<?php
require_once "insersoes.php";
require_once "pegar_informacoes_pdf.php";
date_default_timezone_set("America/Sao_Paulo");
$guardar = 1;
// $confirmar = $_POST['contador'];
$data = date("Y-m-d H:i:s");

// Exibe a data e hora atual

$pegarPrograma = isset ($_POST['pegarPrograma']) ? json_decode($_POST['pegarPrograma'], true) : array();
$programaValor = $pegarPrograma['valor'];
$programaId = $pegarPrograma['id'];
echo ("Valor do programa: $programaValor\n");
echo ("Id do programa: $programaId\n");

// echo ("$confirmar\n");
$pegarElementosMeta = isset ($_POST['pegarElementosMeta']) ? json_decode($_POST['pegarElementosMeta'], true) : array();
$metaid = $pegarElementosMeta['id'];
$finalmetaid = substr($metaid, -2, 1);
$metavalor = $pegarElementosMeta['valor'];
echo ("meta: $metaid\n");
echo ("meta: $metavalor\n");



$anoAtual = date("Y");
$doisUltimosDigitos = substr($anoAtual, -2);

$pegarElementosIndicador = isset ($_POST['pegarElementosIndicador']) ? json_decode($_POST['pegarElementosIndicador'], true) : array();


if (count($pegarElementosIndicador) != 0 && $pegarElementosIndicador['id'] != null) {

    $indicadorid = $pegarElementosIndicador['id'];
    $indicadorValor = $pegarElementosIndicador['valor'];
    $indicadoridt = substr($indicadorid, -1, 1);

    echo ("Indicador: $indicadorid\n");
    echo ("Valor do indicador: $indicadorValor\n");

    // Adicione instruções de depuração


    $pegarElementoInicialFinal = isset ($_POST['pegarElementoInicialFinal']) ? json_decode($_POST['pegarElementoInicialFinal'], true) : array();
    $previsao_inicial = $pegarElementoInicialFinal['idinicial'];
    $previsao_final = $pegarElementoInicialFinal['idfinal'];

    $valorinicial = $pegarElementoInicialFinal['valorinicial'];
    $valorfinal = $pegarElementoInicialFinal['valorfinal'];

    echo ("Previsão inicial: $previsao_inicial \n");
    echo ("Previsão inicial: $valorinicial \n");
    echo ("Previsão final: $previsao_final\n");
    echo ("Previsão final: $valorfinal\n");

    $pegarElementosTotal = isset ($_POST['pegarElementosTotal']) ? json_decode($_POST['pegarElementosTotal'], true) : array();

    $elementos_total_por_ano = $pegarElementosTotal['dados_contratados'];
    $elementos_total_por_ano = explode(",", $elementos_total_por_ano);
    $elementos_executado_por_ano = $pegarElementosTotal['dados_executados'];
    $elementos_executado_por_ano = explode(",", $elementos_executado_por_ano);
    $anos_total = $pegarElementosTotal['dados_anos'];
    $anos_total = explode(",", $anos_total);
    echo (gettype($elementos_total_por_ano) . "\n");
    $id_tabela_total = $pegarElementosTotal['id'];
    $total_contratos = $pegarElementosTotal['total_contratos'];
    $total_executados = $pegarElementosTotal['total_executados'];


    echo ("$total_contratos teste mano \n");
    echo ("$total_executados teste mano \n");

    echo ("id tabela: $id_tabela_total\n");
    //echo ("Total por ano: $elementos_total_por_ano\n");
    // echo ("Total Executados por ano: $elementos_executado_por_ano\n");
    // echo ("Anos: $anos_total\n ");

    $pegarElementosPrevisoes = isset ($_POST['pegarElementosPrevisoes']) ? json_decode($_POST['pegarElementosPrevisoes'], true) : array();

    $acumulativo = $pegarElementosPrevisoes['acumulativo'];
    $elementos_previsto_trimestre = $pegarElementosPrevisoes['dados_previstos'];
    $elementos_previsto_trimestre = explode(",", $elementos_previsto_trimestre);

    $elementos_realizados_trimestre = $pegarElementosPrevisoes['dados_realizados'];
    $elementos_realizados_trimestre = explode(",", $elementos_realizados_trimestre);


    $id_tabela_previsoes = $pegarElementosPrevisoes['id'];
    $total_previstos = $pegarElementosPrevisoes['soma_previstos'];
    $total_realizados = $pegarElementosPrevisoes['soma_realizados'];

    // echo ("Elementos previstos: $elementos_previsto_trimestre \n ");
    echo ("Elementos id: $id_tabela_previsoes \n ");
    echo ("total previstos: $total_previstos \n ");
    echo ("total realizados: $total_realizados \n ");
    // echo ("Elementos realizados: $elementos_realizados_trimestre \n ");



    $pegarElementosTextoAvaliativo = isset ($_POST['pegarElementosTextoAvaliativo']) ? json_decode($_POST['pegarElementosTextoAvaliativo'], true) : array();

    // $primeiraAvaliacao = $pegarElementosTextoAvaliativo["1°Bimestre$doisUltimosDigitos"];
    // $segundaAvaliacao = $pegarElementosTextoAvaliativo["2°Trimestre$doisUltimosDigitos"];
    // $terceiraAvaliacao = $pegarElementosTextoAvaliativo["3°Trimestre$doisUltimosDigitos"];
    $id = $pegarElementosTextoAvaliativo['id'];
    $valorr = $pegarElementosTextoAvaliativo['valor'];

    // Verificando se os arrays têm o mesmo tamanho
  
    // $textos = array($primeiraAvaliacao, $segundaAvaliacao, $terceiraAvaliacao);

    // echo (" $id id mano 1°Bimestre: $primeiraAvaliacao \n 2°Trimestre: $segundaAvaliacao \n 3°Trimestre: $terceiraAvaliacao\n \n");
}
if ($pegarPrograma != null) {
    //verifica se o programa já existe
    $resultado_verifica_programa = verificaPrograma($programaId);
    if ($resultado_verifica_programa == 0) {
        $verifica_inserido_programa = inserirPrograma($programaId, $programaValor, $data);

        if ($verifica_inserido_programa == 0) {
            echo "Erro ao inserir programa.";
            exit; // Sai do script se houver erro
        }
    }

    $resultado_verifica_meta = verificarMeta($metaid);
    if ($resultado_verifica_meta == 0 && $indicadorid != 0) {
        $verifica_inserido_meta = inserirMeta($programaId, $metaid, $metavalor,1, $data);
        echo($indicadorid);
        if ($verifica_inserido_meta == 0) {
            echo "Erro ao inserir meta.";
            exit; // Sai do script se houver erro
        }
    }else{
        $verifica_inserido_meta = inserirMeta($programaId, $metaid, $metavalor,0, $data);
        echo($indicadorid);
    }

    $resultado_verifica_indicador = verificarIndicador($indicadorid);
    if ($resultado_verifica_indicador == 0) {
        $verifica_inserido_indicador = inserirIndicador($metaid, $indicadorid, $indicadorValor, $data);
        if ($verifica_inserido_indicador == 0) {
            echo "Erro ao inserir indicador.";
            exit; // Sai do script se houver erro
        }
    }

    $resultado_verifica_previsoes = verificarPrevisoes($previsao_inicial, $previsao_final);
    if ($resultado_verifica_previsoes == 0) {
        $verifica_inserido_previsoes = inserirPrevisoes($indicadorid, $previsao_inicial, $previsao_final, $valorinicial, $valorfinal, $data);
        if ($verifica_inserido_previsoes == 0) {
            echo "Erro ao inserir previsões.";
            exit; // Sai do script se houver erro
        }
    }

    $resultado_tb = verificarTableaContratos($id_tabela_total);
    if ($resultado_tb == 0) {
        $verifica_inserida_tabela_contratos = inserirTableaContratos($indicadorid, $id_tabela_total, $total_contratos, $total_executados, $data);
        if ($verifica_inserida_tabela_contratos == 0) {
            echo "Erro ao inserir tabela de contratos   .";
            exit; // Sai do script se houver erro
        }

        for ($i = 0; $i < count($anos_total); $i++) {
            inserirDadosContratos($id_tabela_total, $elementos_total_por_ano[$i], $anos_total[$i]);
            inserirDadosExecutados($id_tabela_total, $elementos_executado_por_ano[$i], $anos_total[$i]);
        }
    } else {
        echo "Já existe um valor com esse id.";
    }
    $resultado_verifica_previsoes = verificaTabelaPrevisoes($id_tabela_previsoes);
    if ($resultado_verifica_previsoes == 0) {
        $verifica_inserida_tabela_previsoes = inserirTableaPrevistos($indicadorid, $id_tabela_previsoes, $total_previstos, $total_realizados,$acumulativo, $data);
        if ($verifica_inserida_tabela_previsoes == 0) {
            exit;
        }
        $array_timestre = [];
        $b_out_t = '°Trim';
        for ($i = 0; $i <= 4; $i++) {
            $b_out_t = '°Trim';
            $valor = $i + 1;
            if ($i == 0) {
                $b_out_t = '°Bim';
            }
            $array_timestre[$i] = "$valor $b_out_t";
        }
        for ($i = 0; $i < count($elementos_realizados_trimestre) - 1; $i++) {
            echo ($array_timestre[$i] . "-" . $elementos_realizados_trimestre[$i] . "-" . $elementos_previsto_trimestre[$i] . "\n");
            inserirDadosPrevistos($id_tabela_previsoes, $elementos_previsto_trimestre[$i], $array_timestre[$i]);
            inserirDadosRealizados($id_tabela_previsoes, $elementos_realizados_trimestre[$i], $array_timestre[$i]);
        }


    }
    // $tamanho = min(count($id), count($valor));
    for ($i = 0; $i < count($valorr); $i++) {
        $verificar = verificaTextoAvaliativo($id[$i]);
        echo("não tem nenhum texto com ess $valorr[$i]");
        if($verificar == 0){
            $resultado = inserirTextoAvaliativo($indicadorid,$id[$i],$valorr[$i],$data);
            if($resultado == 0){
                echo "FWFWFWFWFW há dados de programa\n";
        
            }
        }
    }



} else {
    echo "Não há dados de programa\n";
}

?>