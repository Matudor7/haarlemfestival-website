<!DOCTYPE html>
<html>
<head>
  <title>QR Code Scanner</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    #videoElement {
      width: 100%;
      height: auto;
    }
    #qrCode {
      margin-top: 20px;
    }
  </style>
    <!-- include the library -->
    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
</head>
<body>
<button class="btn btn-primary" type="button" onclick="window.location.href = '/' "><- Homepage</button>
    <center><div id="qr-reader" style="width: 600px"></div></center>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
        console.log(`Code scanned = ${decodedText}`, decodedResult);
        window.open(decodedText, "_blank");
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>
</html>
