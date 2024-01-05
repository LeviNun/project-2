<?php

include('conexao.php');

if(isset($_GET['cidade'])) {

    echo "Você selecionou a cidade com o id " . $_GET['cidade'];
    die("<a href=\"index.php\">Voltar ao início</a>");

}

$sql_code_states = "SELECT * FROM estados ORDER BY nome ASC";
$sql_query_states = $conn->query($sql_code_states) or die($conn->error);

?>
<form method="GET" action="">
    <select <?php if(isset($_GET['estado'])) echo "disabled"; ?> required name="estado">
        <option value="">Selecione um estado</option>
        <?php while($estado = $sql_query_states->fetch_assoc()) { ?> 
        <option <?php if(isset($_GET['estado']) && $_GET['estado'] == $estado['id']) echo "selected"; ?> value="<?php echo $estado['id']; ?>"><?php echo $estado['nome']; ?></option>
        <?php } ?>
    </select>
    <?php if(isset($_GET['estado'])) { ?>
    <select required name="cidade">
        <option value="">Selecione uma cidade</option>
        <?php 
        $selected_state = $conn->real_escape_string($_GET['estado']);
        $sql_code_cities = "SELECT * FROM cidades WHERE id_estado = '$selected_state' ORDER BY nome";
        $sql_query_cities = $conn->query($sql_code_cities) or die($conn->error);

        while($cidade = $sql_query_cities->fetch_assoc()) { ?>
        <option value="<?php echo $cidade['id']; ?>"><?php echo $cidade['nome']; ?></option>
        <?php } ?>
    </select>
    <?php } ?>
    <button type="submit">Avançar</button>
</form>