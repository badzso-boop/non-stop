<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Házi foci bajnokság</title>
</head>
<body>
    <?php include_once 'parts/fejlec.php'; ?>

    <h1 class="text-center m-5">Főoldal</h1>

    <h2 class="focim">Döntők</h2>
    <p class="alcim"><span style="font-weight: bold;">Helyszín:</span> Belvárosi sportcsarnok</p>

    <div class="container-fluid" style="margin-bottom: 10rem">
        <div class="row">
            <div class="col text-center" style="border-right: 2px solid black;">
                <h2 class="cim">9. - 10. évfolyam</h2>
                    <br>
                    <p class="ido">15:00</p>
                    <br>
                    <p class="osztalyok">9.C</p>
                    <span class="span">-</span>
                    <p class="osztalyok">10.D</p>
            </div>
            <div class="col text-center">
                <h2 class="cim">11. - 12. 13. évfolyam</h2>
                    <br>
                    <p class="ido">15:30</p>
                    <br>
                    <p class="osztalyok">12.D</p>
                    <span class="span">-</span>
                    <p class="osztalyok">12.E</p>
            </div>
        </div>
    </div>

    <?php include_once 'parts/footer.php'; ?>
</body>
</html>