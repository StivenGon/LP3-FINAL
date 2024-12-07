<?php
/**
 * Html2Pdf Library - Prestamos (Loans)
 * HTML => PDF converter
 **/

include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
require_once(ROOT_PATH . 'vendor/autoload.php');

// Include and initialize PrestamosController
require_once(CONTROLLER_PATH . 'prestamosController.php');
$object = new PrestamosController();
$prestamos = $object->listar();  // Get the list of prestamos

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    ob_start();
    // Include the view template (HTML structure) for prestamos
    include dirname(__FILE__) . '/doc/prestamos_html.php';
    $content = ob_get_clean();

    // Initialize Html2Pdf
    $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', 3);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->output('prestamos.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    // Format and display the error message
    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
?>
