<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <style>
        body {
            height: 100%;
            width: 100%;
            padding: 0;
            margin: 0;
        }

        .parent {
            position: absolute;
            height: 100%;
            width: 100%;
        }

    </style>
</head>

<body>
    <div class="parent">
        <iframe src="http://{{ $ip_address }}" frameborder="0" height="100%" width="100%"
            id="iFrame1"></iframe>
    </div>
</body>

</html>
