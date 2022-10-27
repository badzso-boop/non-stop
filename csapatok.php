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

    <h1 class="text-center m-5">Csoportok</h1>

    <div class="container-sm">
        <div class="row">
            <div class="col-sm">
                <?php 
                    require_once 'includes/dbh.inc.php';
                    require_once 'includes/functions.inc.php';

                    $csapatok = csapatokLekeres($conn);
                    $csoportok = csoportokLekerese($conn);
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

                    echo '<hr style="width: 75%;">
                    <h1 class="text-center m-5">Csapatok</h1>';

                    if ($csapatok->num_rows > 0) {
                        while($seged = $csapatok->fetch_assoc()) {
                            $tomb = explode(";", $seged["csapat_tagok"]);
                            $szam = count($tomb) - 1;
                
                            echo '
                            <div class="card d-inline-block m-4" style="width: 18rem;">
                                <img src="img/sample-sm.jpg" class="card-img-top" alt="...">
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
                                    <a href="#" class="btn btn-primary" onclick="kedveles('.$k.')">Kedvelés küldése</a>
                                    <p>Kedvelések: <span id="kedveles'.$k.'">0</span></p>
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