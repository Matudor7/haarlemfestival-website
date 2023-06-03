<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class smtpService
{
    public function sendEmail($destinationEmail, $receiverName, $message, $subject, $InvoicePdf=null, $ticketPDF=null){
        require_once __DIR__ . '/../vendor/autoload.php';
        require_once __DIR__ . '/../config/smtpconfig.php';
    try{
        $client = new PHPMailer();
        $client->isSMTP();
        $client->Mailer = "smtp";
        $client->SMTPDebug = SMTP::DEBUG_SERVER;
        $client->SMTPAuth = true;
        $client->SMTPSecure = "tls";
        $client->Port = 587;
        $client->Host = "smtp.gmail.com";
        $client->Username = $email;
        $client->Password = $password;

        $client->isHTML(true);
        $client->addAddress($destinationEmail, $receiverName);
        $client->setFrom($email, "Haarlem Festival");
        $client->Subject = $subject;
        $content = $message;
        $client->msgHTML($content);
         if($InvoicePdf != null && $ticketPDF != null){
            $client->AddAttachment($InvoicePdf);
            $client->AddAttachment($ticketPDF);
         }
        $client->send();

    }catch(Exception $e){
        echo $e;
    }


    }

}