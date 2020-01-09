<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/recface.css">
    <title>Reconocimiento Facial</title>

</head>

<body>
    <div>
        <center>
            <h1>Reconocimiento facial</h1>
        </center>
        <video autoplay id="video" width="640" height="480"></video>
        <!--<canvas autoplay id="canvas" width="640" height="480"></video>-->
        <div id="ListaImagenes" style="visibility: hidden"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

    <script defer src="js/face-api.js"></script>
    <script defer src="js/recFacial.js"></script>
</body>

</html>