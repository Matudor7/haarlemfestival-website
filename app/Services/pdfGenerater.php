<?php
// Include autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Reference the Dompdf namespace
use Dompdf\Dompdf;
class PDFGenerator
{
    public function createPDF($order_id, $user_id)
    {
        $dompdf = new Dompdf();
        $html = ""; //goes the content of the pdf so u can use css, make irt general to reuse it
        $qr = "";

// Load HTML content
        $dompdf->loadHtml($html);


// (Optional) Set up the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
        $dompdf->render();
        $pdf_content = $dompdf->output();
        $file_name = "tickets_" . $order_id . ".pdf";
        file_put_contents($file_name, $pdf_content);

        return $file_name;
    }
}