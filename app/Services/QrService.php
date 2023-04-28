<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class QrService
{
    public function generateQrCode($ticket){

        $writer = new PngWriter();

        //make a call to the api and passes the id of the current ticket u have
        $url = "http://localhost/api/tickets/scan?id=" . $ticket->id;

        // Create QR code
        $qrCode = QrCode::create($url)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

// Create generic logo
// $logo = Logo::create(__DIR__. '/../public/doge.jpg')
// ->setResizeToWidth(50);
        $logo = NULL;

// Create generic label
        $label = Label::create('Scan me')
            ->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode, $logo, $label);

// Validate the result
//$writer->validateResult($result, 'Life is too short to be generating QR codes');
        return $result->getDataUri();
//return $result;
    }
}