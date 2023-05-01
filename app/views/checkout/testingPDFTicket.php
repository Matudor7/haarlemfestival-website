<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Haarlem Festival Ticket</title>
    <style>
        body {
            background-image: url('path/to/background/image.jpg');
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
        <!--border-color: #3366CFFF;--> /* green border color for green event type */
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
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Haarlem Festival Ticket</h1>
        <h2><?php echo $event_type; ?></h2>
    </div>
    <div class="qr-code">
        <img src="<?php echo $qr_code_url; ?>" alt="QR code">
    </div>
    <div class="info">
        <p><span class="label">Name:</span> <?php echo $client_name; ?></p>
        <p><span class="label">Event:</span> <?php echo $event_name; ?></p>
        <p><span class="label">Date:</span> <?php echo $event_date; ?></p>
        <p><span class="label">Time:</span> <?php echo $event_time; ?></p>
    </div>
</div>
</body>
</html>
