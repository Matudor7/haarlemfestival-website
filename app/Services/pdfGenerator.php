<?php
// Include autoloader
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Services/shoppingCartService.php';
require_once __DIR__ . '/../Services/productService.php';
require_once __DIR__ . './../Services/QrService.php';
// Reference the Dompdf namespace
use Dompdf\Dompdf;
class PDFGenerator
{
    private $shoppingCartService;

    public function __construct()
    {
        $this->shoppingCartService = new ShoppingCartService();
    }

    public function createPDF($order_id, $user_id, $html)
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
        $file_name = "tickets_" . $order_id . ".pdf";
        file_put_contents($file_name, $pdf_content);

        return $file_name;
    }

    public function generateInvoicePDF($paymentObject, $order)
    {
        $subtotal = "";
        $invoiceNumber = $order->invoice_number;
        $invoiceDate = $order->invoice_date;

        $pdf = "<!DOCTYPE html>
        <head>
            <title>Invoice</title>
        </head>
        <body>
        <img src='/media/invoiceLogo.png' id='logo' class='img-fluid' alt='Logo'>
        <div id='festival-info'>
            <h3>Haarlem Festival</h3>
            <p>Grote Markt, Haarlem</p>
        </div>
        <br><br>
        
        <div>
            <table  style='width:100%; border-collapse:collapse; border: none;'>
                <tr>
                    <td style='color:#ff6600;border-top: 1px dashed #ff6600; border-left: none; border-right: none; border-bottom: none; font-weight: bold; text-transform:uppercase;'>BILL TO</td>
                    <td style='color:#ff6600;border-top: 1px dashed #ff6600; border-left: none; border-right: none; border-bottom: none; font-weight: bold;  text-transform:uppercase;'>CUSTOMER'S INF</td>
                    <td style='color:#ff6600; border: none; font-weight: bold; text-transform:uppercase;'>INVOICE#</td>
                    <td style= 'border-top: 1px dashed #ff6600; border-left: none; border-right: none; border-bottom: none;'>" . $order->invoice_number . "</td>
                </tr>
                <tr>
                 <td style='border: none;'>" . $paymentObject->first_name . '  ' . $paymentObject->last_name . " </td>
                    <td style='border: none;'>" . $paymentObject->email . "</td>
                    <td style='color: #ff6600; border: none; font-weight: bold; text-transform: uppercase;'>INVOICE DATE</td>
                    <td style='border: none;'>" . $order->invoice_date . "</td>
                </tr>
                <tr>
                    <td style='border: none;' >" . $paymentObject->address . "</td>
                    <td style='border: none;'>" . $paymentObject->phone_number . "</td>
                    <td style='color: #ff6600; border: none; font-weight: bold; text-transform: uppercase;'>PAYMENT DATE</td>
                    <td style='border: none;'>" . $order->invoice_date . "</td>
                </tr>
                <tr>
                    <td style='border: none;' >" . $paymentObject->zip . "</td>
                </tr>
            </table>
        </div><br><br>
        
        <table id='productTable'>
            <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th >Total</th>
            </tr>
            </thead>
            <tbody> ";
        $subtotal = 0;
        $shoppingCart = $this->shoppingCartService->getCartOfUser($_SESSION['user_id']);
        $productService = new ProductService();
        foreach ($shoppingCart->product_id as $item) {
            $product = $productService->getById($item);
            $subtotal += intval($shoppingCart->amount[0]) * $product->price;
            $totalPricePerProduct = $product->calculateTotalPriceForProduct($shoppingCart->amount[0], $product->price);
            $amount = $shoppingCart->amount[0];
            $pdf .= "
            <tr>
                <td>" . $product->name . "</td>
                <td>" . $amount . "</td>
                <td>&#8364;" . $product->price . "</td>
                <td>" . $totalPricePerProduct . "</td>
            </tr> ";
        }
        $pdf .= "
            <tr>
                <td colspan='3'>Subtotal</td>
                <td>&#8364;" . $subtotal . "</td>
            </tr>
            <tr>
                <td colspan='3'>Tax</td>
                <td>&#8364;" . $subtotal * 0.21 . "</td>
            </tr>
            <tr>
                <td colspan='3' style='color:#ff6600;  font-weight: bold;'>TOTAL</td>
        
                <td style='color:#ff6600;  font-weight: bold;'> &#8364;" . $subtotal * 0.21 + $subtotal . "</td>
            </tr>
            </tbody>
        </table>
        <p><span style='font-family: 'Vladimir Script', cursive; font-size: 28px; text-align: right; display: block;'>Haarlem Festival</span></p>
        <div id='ThankYou'>
            <p style='border-top: 3px dashed #ff6600;'></p>
            <h1 style='color:#ff6600; text-align: center; font-weight: bold;'>Thank You</h1>
        
        </div>
        </body>
        </html>
        <style>
    #ThankYou{
    margin-top: 3em;
            }
    #productTable  {
border-collapse: collapse;
width: 100%;
}
#productTable th, td {
border: 1px solid black;
                padding: 8px;
                text-align: left;
            }
            #productTable th {
                background-color: #ff6600;
                color: #fff;
            }
            #logo {
                margin-top: 1em;
                max-width: 210mm; /* set the maximum width to the width of an A4 paper */
                width: 100%;
                height: auto;
            }
            body {
    max-width: 210mm;
                margin: 0 auto;
            }
            #festival-info {
                text-align: center;
                font-size: 14px;
                color: #ff6600;
                text-transform: uppercase;
            }
        
            #festival-info h3 {
                margin-bottom: 5px;
                font-size: 20px;
            }
            #clients-inf table {
                border-collapse: collapse;
                border: none;
            }
        
            #festival-info p {
                margin: 0;
            }
        </style>";


        return $pdf;
    }

    public function generateTicketPdf($tickets)
    {
        $qrService = new QrService();
        //get the list of ticket and for each ticket generate a qr code and diplay the rest of the pdf as well with info related to that tickets
        // $qrService->generateQrCode($ticket);
        $pdf = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>Haarlem Festival Ticket</title>
    </head>
    <body>
    <div class='container'>
        <div class='header'>
            <h1>Haarlem Festival Ticket</h1> ";
        foreach ($tickets as $ticket) {
            $qr_code_ur = $qrService->generateQrCode($ticket);
            $client_name = $ticket->client_name;
            $event_name = $ticket->event_name;
            $event_date = $ticket->event_date;
            $event_time = $ticket->event_time;
            $event_type = $ticket->event_type;
            $pdf .= "
            <h2>" . $event_type . "</h2>
            <div class='qr-code'>
                <img src='" . $qr_code_ur . "' alt='QR code'>
            </div>
            <div class='info'>
                <p><span class='label'>Name:</span>" . $client_name . "</p>
                <p><span class='label'>Event:</span>" . $event_name . "</p>
                <p><span class='label'>Date:</span>" . $event_date . "</p>
                <p><span class='label'>Time:</span> " . $event_time . "</p>
            </div>
    </body>
    </html>
<style>
    body {
        <!--background-image: url('path/to/background/image.jpg');-->
        background-size: cover;
        background-position: center;
        font-family: Arial, sans-serif;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 100%;
        max-width: 397px; /* Half of A4 width in pixels */
        margin: 0 auto;
        padding: 20px;
        box-sizing: border-box;
        background-color: #fff;
        opacity: 0.9;
        border: 10px solid #FF6600FF; /* default border color */
    }

    .container.purple {
        border-color: #8564CC; /* blue border color for blue event type */
    }

    .container.blue {
        border-color: #0d47a1;
        /*border-color: #3366CFFF;*/ /* green border color for green event type */
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    h1 {
        font-size: 36px;
        margin: 0;
        padding: 0;
    }

    h2 {
        font-size: 24px;
        margin: 0;
        padding: 0;
    }

    .qr-code {
        float: right;
        margin-left: 30px;
        width: 75px;
        height: 75px;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #333;
        border-radius: 3px;
        text-align: center;
    }

    .qr-code img {
        max-width: 100%;
        height: auto;
    }

    .info {
        margin-top: 25px;
        font-size: 14px;
    }

    .label {
        font-weight: bold;
        display: inline-block;
        min-width: 70px;
    }
</style>";


        }
        return $pdf;

    }
}