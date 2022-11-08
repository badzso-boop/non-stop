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

    <div id="carouselExampleIndicators" class="carousel slide m-auto w-50" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
        </ol>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" id="kep" src="img/DSC_0025_3.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" id="kep" src="img/DSC_0326_3.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" id="kep" src="img/DSC_1800_3.jpg" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" id="kep" src="img/DSC_2223_3.jpg" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" id="kep" src="img/DSC_3211_3.jpg" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" id="kep" src="img/DSC_3292_3.jpg" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" id="kep" src="img/DSC_3403_3.jpg" alt="Third slide">
            </div>
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
    
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container-fluid" style="margin-bottom: 10rem">
        <div class="row">
            <div class="col m-auto text-center">
                <h3>Csoportok</h3>
                <?php
                    require_once 'includes/dbh.inc.php';
                    require_once 'includes/functions.inc.php';

                    $sql = "SELECT * FROM csoportok ORDER BY csoport_nev ASC LIMIT 4";
                    $result = $conn->query($sql);

                    $csoportok = $result;
                    $k = 0;

                    if ($csoportok->num_rows > 0) {
                        while($seged = $csoportok->fetch_assoc()) {
                            $tomb = explode(";", $seged["csapatok"]);
                            $szam = count($tomb);

                            echo '
                                <div class="card m-4 d-inline-block" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">'.$seged["csoport_nev"].'</h5>
                                        <div class="card-text">
                                            <ul>';
                                            for ($i=0; $i < $szam; $i++) { 
                                                echo "<li>".$tomb[$i]."</li>";
                                            }
                                            echo '</ul>
                                        </div>
                                    </div>
                                </div>';
                        }
                    }
                    else {
                        echo 'Nincsenek csoportok';
                    }
                ?>
            </div>
            <div class="col m-auto text-center">
                <h3>Csapatok</h3>
                <?php
                    $sql = "SELECT * FROM csapatok ORDER BY csapat_nev ASC LIMIT 4";
                    $result = $conn->query($sql);

                    $csapatok = $result;

                    if ($csapatok->num_rows > 0) {
                        while($seged = $csapatok->fetch_assoc()) {
                            $tomb = explode(";", $seged["csapat_tagok"]);
                            $szam = count($tomb) - 1;
                
                            echo '
                            <div class="card d-inline-block m-4" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">'.$seged["csapat_nev"].'</h5>
                                    <div class="card-text">
                                        <p>Pontszám: '.$seged["pontszam"].'</p>
                                        <p>Csapattagok: </p>
                                        <ul>';
                                        for ($i=0; $i < $szam; $i++) { 
                                            echo "<li>".$tomb[$i]."</li>";
                                        }
                                        echo '</ul>
                                    </div>
                                </div>
                            </div>';
                            $k++;
                        }
                    } else {
                        echo "Nincsenek fent csapatok :(";
                    }
                ?>
            </div>
        </div>
    </div>

    <?php include_once 'parts/footer.php'; ?>
</body>
</html>