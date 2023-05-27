<?php
// Include autoloader
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Services/shoppingCartService.php';
require_once __DIR__ . '/../Services/productService.php';
// Reference the Dompdf namespace
use Dompdf\Dompdf;
class PDFGenerator
{
    private $shoppingCartService;

    public function __construct(){
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
                    <td style= 'border-top: 1px dashed #ff6600; border-left: none; border-right: none; border-bottom: none;'>". $order->invoice_number."</td>
                </tr>
                <tr>
                 <td style='border: none;'>". $paymentObject->first_name . '  '. $paymentObject->last_name." </td>
                    <td style='border: none;'>".$paymentObject->email."</td>
                    <td style='color: #ff6600; border: none; font-weight: bold; text-transform: uppercase;'>INVOICE DATE</td>
                    <td style='border: none;'>".$order->invoice_date."</td>
                </tr>
                <tr>
                    <td style='border: none;' >".$paymentObject->address."</td>
                    <td style='border: none;'>".$paymentObject->phone_number."</td>
                    <td style='color: #ff6600; border: none; font-weight: bold; text-transform: uppercase;'>PAYMENT DATE</td>
                    <td style='border: none;'>".$order->invoice_date."</td>
                </tr>
                <tr>
                    <td style='border: none;' >".$paymentObject->zip."</td>
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
                <td>".$product->name."</td>
                <td>".$amount."</td>
                <td>&#8364;".$product->price."</td>
                <td>".$totalPricePerProduct."</td>
            </tr> ";
            }
        $pdf .= "
            <tr>
                <td colspan='3'>Subtotal</td>
                <td>&#8364;".$subtotal."</td>
            </tr>
            <tr>
                <td colspan='3'>Tax</td>
                <td>&#8364;".$subtotal * 0.21."</td>
            </tr>
            <tr>
                <td colspan='3' style='color:#ff6600;  font-weight: bold;'>TOTAL</td>
        
                <td style='color:#ff6600;  font-weight: bold;'> &#8364;".$subtotal * 0.21 + $subtotal."</td>
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
}