<?php
// Include autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Reference the Dompdf namespace
use Dompdf\Dompdf;
class PDFGenerator
{
    public function createPDF($order_id, $user_id, $html, $type)
    {
        $dompdf = new Dompdf();

        $qr = "";

// Load HTML content
        $dompdf->loadHtml($html);


// (Optional) Set up the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
        $dompdf->render();
        $pdf_content = $dompdf->output();
        $file_name = $type . "_" . $order_id . ".pdf";
        file_put_contents($file_name, $pdf_content);

        return $file_name;
    }
}