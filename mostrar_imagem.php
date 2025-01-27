<?php
session_start();

// Verificar se o parâmetro relatorio está definido e é um número inteiro
if (isset($_GET['relatorio']) && filter_var($_GET['relatorio'], FILTER_VALIDATE_INT)) {
    $relatorioIndex = $_GET['relatorio'];

    // Verificar se o índice do relatório existe na sessão
    if (isset($_SESSION['relatorios'][$relatorioIndex])) {
        $relatorio = json_decode($_SESSION['relatorios'][$relatorioIndex], true);

        // Verificar se a imagem está presente no relatório
        if (isset($relatorio['anexos'])) {
                        echo '<h3>Anexos:</h3>';
                        foreach ($relatorio['anexos'] as $anexo) {
                            echo '<p><a href="' . $anexo['path'] . '" target="_blank">' . $anexo['name'] . '</a></p>';
                        }
            
                    } else {
                        echo '<p>Nenhum anexo encontrado.</p>';
                    }
                } else {
                    echo '<p>Relatório não encontrado.</p>';
                }
            } else {
                echo '<p>Parâmetro de relatório inválido.</p>';
            }
            ?>
            
