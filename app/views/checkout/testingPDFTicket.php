<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ticket Example</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .ticket {
            border: 2px solid black;
            padding: 20px;
            width: 500px;
            margin: 0 auto;
            text-align: center;
        }
        .ticket h1 {
            font-size: 32px;
            margin-top: 0;
        }
        .ticket p {
            font-size: 18px;
            margin-bottom: 5px;
        }
        .ticket .qr-code {
            margin: 20px auto;
            width: 200px;
            height: 200px;
            background-color: white;
            border: 1px solid black;
            padding: 10px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<div class="ticket">
    <h1>Event Name</h1>
    <p>Date: May 1st, 2023</p>
    <p>Time: 7:00 PM</p>
    <p>Location: Example Venue</p>
    <p>Ticket ID: 123456789</p>
    <div class="qr-code">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=123456789" alt="Ticket QR Code">
    </div>
    <p>Present this ticket at the door for admission</p>
</div>
</body>
</html>
