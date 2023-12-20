<?php
require 'dompdf/autoload.inc.php'; // Ajuste o caminho conforme necessário

use Dompdf\Dompdf;
use Dompdf\Options;

session_start();

// Verifica se o parâmetro relatorio está definido e é um número inteiro
if (isset($_GET['relatorio']) && filter_var($_GET['relatorio'], FILTER_VALIDATE_INT)) {
    $relatorioIndex = $_GET['relatorio'];

    // Verifica se o índice do relatório existe na sessão
    if (isset($_SESSION['relatorios'][$relatorioIndex])) {
        $relatorio = json_decode($_SESSION['relatorios'][$relatorioIndex], true);

        // Gera o PDF e realiza o download automático
        gerarEDownloadPDF($relatorio);
    } else {
        echo '<p>Relatório não encontrado.</p>';
    }
} else {
    echo '<p>Parâmetro de relatório inválido.</p>';
}

function gerarEDownloadPDF($relatorio) {
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml(obterConteudoPDF($relatorio));

    // (Opcional) Configurar opções do PDF
    $dompdf->setPaper('A4', 'portrait');

    // Renderizar o PDF (saída)
    $dompdf->render();

    // Nome do arquivo PDF a ser gerado
    $nomeArquivo = 'relatorio.pdf';

    // Definir cabeçalhos para realizar o download automático
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $nomeArquivo . '"');
    header('Content-Length: ' . $dompdf->output(null, true));

    // Imprimir o conteúdo do PDF
    echo $dompdf->output();

    // Finalizar o script
    exit();
}

function obterConteudoPDF($relatorio) {
    ob_start();
    ?>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Relatório</title>
        <style>
            img {
                max-width: 100%;
                max-height: 100%;
            }
        </style>
    </head>
    <body>
        <h1>SergipeTec</h1>
        <h2>Relatório</h2>
        <?php if (isset($relatorio['titulo'])): ?>
            <h2><?php echo $relatorio['titulo']; ?></h2>
        <?php endif; ?>

        <?php if (isset($relatorio['observacao'])): ?>
            <p><strong>Observação:</strong> <?php echo $relatorio['observacao']; ?></p>
        <?php endif; ?>

        <?php if (isset($relatorio['metas'])): ?>
            <p><strong>Metas:</strong> <?php echo $relatorio['metas']; ?></p>
        <?php endif; ?>

        <?php if (isset($relatorio['comentarios'])): ?>
            <p><strong>Comentários:</strong> <?php echo $relatorio['comentarios']; ?></p>
        <?php endif; ?>

        <?php if (isset($relatorio['anexos']) && is_array($relatorio['anexos'])): ?>
            <h3>Anexos:</h3>
            <?php foreach ($relatorio['anexos'] as $index => $anexo): ?>
                <?php if (pathinfo($anexo, PATHINFO_EXTENSION) === 'jpg' || pathinfo($anexo, PATHINFO_EXTENSION) === 'png'): ?>
                    <?php $base64 = 'data:image/' . pathinfo($anexo, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($anexo)); ?>
                    <p><a href="<?php echo $anexo; ?>" target="_blank">Anexo <?php echo ($index + 1); ?></a></p>
                <?php elseif (pathinfo($anexo, PATHINFO_EXTENSION) === 'mp4' || pathinfo($anexo, PATHINFO_EXTENSION) === 'webm' || pathinfo($anexo, PATHINFO_EXTENSION) === 'ogg'): ?>
                    <p><a href="<?php echo $anexo; ?>" target="_blank">Anexo <?php echo ($index + 1); ?></a></p>
                <?php else: ?>
                    <p>Anexo <?php echo ($index + 1); ?>: <?php echo $anexo; ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </body>
    </html>

    <?php
    return ob_get_clean();
}
?>
