<?php
    $html_card = get_stats_card();
    $html_card_table = get_stats_card_download();
    require_once "../lib/dompdf/autoload.inc.php";

    // reference the Dompdf namespace
    use Dompdf\Dompdf;
    use Dompdf\Options;

    // instantiate and use the dompdf class
    $options = new Options();
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html_card_table);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Enable Image
    $dompdf->set_option('isRemoteEnabled', true);
    $dompdf->set_option('defaultFont', 'Open Sans');

    // Render the HTML as PDF
    $dompdf->render();

    if (isset($_POST['generate_pdf'])) {
        header("Content-Type: application/pdf");
        header("Content-Length: ".filesize($filename));
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        ob_end_clean();
        $strname = array(' ', '(', ')', '.', ',', ':', '/', '|', '-');
        $dompdf->stream(str_replace($strname, '_', get_promo('title') . '-Statistics') . '.pdf', array('Attachment' => true));
    }
?>
<div class="container-fluid">
    <div class="row sendpageRow">
        <div class="col-md-12">
            <h1>
                <?php echo get_promo('title') . ' | <span class="stats">' . get_translate('Statistic', 'Статистика') . '</span>'; ?>
            </h1>
        </div>
        <div class="col-md-9">
            <div class="card">
                <?php echo $html_card; ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <h4>Export To PDF</h4>
                <form action="" method="post" class="generate_pdf_form">
                    <button type="submit" class="button" name="generate_pdf">
                        <?php echo get_translate('Generate And Download', 'Сгенерировать И Скачать'); ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
