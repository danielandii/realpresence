<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QRCode</title>
</head>
<body>
    <img height="120" width="120" src="data:image/png;base64,{{ DNS2D::getBarcodePNG($qrcode->token_qr,'QRCODE') }}" alt="QRCode" />
</body>
</html>