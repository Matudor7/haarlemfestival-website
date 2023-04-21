<!DOCTYPE html>
<html lang="">
<head>
    <title>Invoice</title>

</head>
<body>
<img src="/media/invoiceLogo.png" id="logo" class="img-fluid" alt="Logo">
<div id="festival-info">
    <h3>Haarlem Festival</h3>
    <p>Grote Markt, Haarlem</p>
</div>
<br><br>

<div>
    <table  style="width:100%; border-collapse:collapse; border: none;">
        <tr>
            <td style="color:#ff6600;border-top: 1px dashed #ff6600; border-left: none; border-right: none; border-bottom: none; font-weight: bold; text-transform:uppercase;">BILL TO</td>
            <td style="color:#ff6600;border-top: 1px dashed #ff6600; border-left: none; border-right: none; border-bottom: none; font-weight: bold;  text-transform:uppercase;">CUSTOMER'S INF</td>
            <td style="color:#ff6600; border: none; font-weight: bold; text-transform:uppercase;">INVOICE#</td>
            <td style=" border-top: 1px dashed #ff6600; border-left: none; border-right: none; border-bottom: none; ">order->getInvoiceNumber()</td>
        </tr>
        <tr>
            <td style="border: none;" >$payment->getFullName();</td>
            <td style="border: none;">$payment->getEmail()</td>
            <td style="color: #ff6600; border: none; font-weight: bold; text-transform: uppercase;">INVOICE DATE</td>
            <td style="border: none;">order->getInvoiceDate()</td>
        </tr>
        <tr>
            <td style="border: none;" >$payment->getAddress();</td>
            <td style="border: none;">$payment->getPhoneNumber()</td>
            <td style="color: #ff6600; border: none; font-weight: bold; text-transform: uppercase;">PAYMENT DATE</td>
            <td style="border: none;">order-->getInvoiceDate()</td>
        </tr>
        <tr>
            <td style="border: none;" >$payment->getZip();</td>
        </tr>
    </table>
</div><br><br>

<table id="productTable">
    <thead>
    <tr>
        <th>Quantity</th>
        <th>Product</th>
        <th>Price</th>
        <th >Total</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Product 1</td>
        <td>2</td>
        <td>$10</td>
        <td>$20</td>
    </tr>
    <tr>
        <td>Product 2</td>
        <td>1</td>
        <td>$25</td>
        <td>$25</td>
    </tr>
    <tr>
        <td colspan='3'>Subtotal</td>
        <td>$45</td>
    </tr>
    <tr>
        <td colspan='3'>Tax</td>
        <td>$4.50</td>
    </tr>
    <tr>
        <td colspan='3' style="color:#ff6600;  font-weight: bold;">TOTAL</td>

        <td style="color:#ff6600;  font-weight: bold;"> &#8364;49.50</td>
    </tr>
    </tbody>
</table>
<p><span style="font-family: 'Vladimir Script', cursive; font-size: 28px; text-align: right; display: block;">Haarlem Festival</span></p>
<div id="ThankYou">
    <p style="border-top: 3px dashed #ff6600;"></p>
    <h1 style="color:#ff6600; text-align: center; font-weight: bold;">Thank You</h1>

</div>
</body>
</html>
<style>
    #ThankYou{
        margin-top: 7em;
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
</style>
