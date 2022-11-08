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
    
    <h1 class="text-center m-5">Meccsek</h1>
    

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                    <?php 
                        require_once 'includes/dbh.inc.php';
                        require_once 'includes/functions.inc.php';
                        
                        $csoportok = csoportokLekerese($conn);
                        $meccsek = meccsekLekerese($conn);

                        $k = 0;
                        if ($csoportok->num_rows > 0) {
                            foreach ($csoportok as $key => $csoport) {
                                echo '<div id="'.$csoport["csoport_nev"].'">
                                    <h1 class="text-center">'.$csoport["csoport_nev"].'</h1>
                                    <h1 class="text-center"><button class="btn btn-success btn-lg text-center m-auto" onclick="window.location.reload()">Frissítés</button></h1>';


                                if ($meccsek->num_rows > 0) {
                                    foreach ($meccsek as $key => $meccs) {
                                        $eredmeny;
                                        if ($meccs["eredmeny"] == -1){
                                            $eredmeny = "Nincs rögzítve";
                                        } elseif ($meccs["eredmeny"] == 1) {
                                            $eredmeny = $meccs["csapat_a"];
                                        } elseif ($meccs["eredmeny"] == 2) {
                                            $eredmeny = $meccs["csapat_b"];
                                        } elseif ($meccs["eredmeny"] == 0) {
                                            $eredmeny = "Döntetlen";
                                        }
        
                                        $bunteto;
                                        if ($meccs["bunteto"] == 1) {
                                            $bunteto = "Igen";
                                        } else {
                                            $bunteto = "Nem";
                                        }

                                        $tomb = explode(";", $csoport["csapatok"]);

                                        for ($i=0; $i < count($tomb); $i++) { 
                                            if ($meccs["csapat_a"] == $tomb[$i]) {
                                                if ($meccs["eredmeny"] == -1) {
                                                    echo '<div class="card m-4 d-inline-block">
                                                                <div class="card-header">
                                                                    <p class="h3 text-center">'.$meccs["csapat_a"].' - '.$meccs["csapat_b"].'</p>
                                                                    <p class="text-center h5">'.$meccs["datum"].' - '.$meccs["idopont"].'</p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <h5 class="text-center">Meccs eredménye</h5>
                                                                            <h3 class="text-center"> - </h3>
                                                                        </div>
                                                                        <div class="col">
                                                                            <h5 class="text-center">Büntető eredménye</h5>
                                                                            <h3 class="text-center"> - </h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                
                                                                <h5 class="text-center m-3" id="eredmeny" style="border-radius: 15px; padding: 2px; background-color: rgba(47, 222, 93, 0.5);">Meccs nyertese: '.$eredmeny.'</h5>
                                                            </div>';
                                                }else {
                                                    if ($bunteto == "Igen") {
                                                        echo '<div class="card m-4 d-inline-block">
                                                                    <div class="card-header">
                                                                        <p class="h3 text-center">'.$meccs["csapat_a"].' - '.$meccs["csapat_b"].'</p>
                                                                        <p class="text-center h5">'.$meccs["datum"].' - '.$meccs["idopont"].'</p>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <h5 class="text-center">Meccs eredménye</h5>
                                                                                <h3 class="text-center">'.$meccs["csapat_a_gol"].' - '.$meccs["csapat_b_gol"].'</h3>
                                                                            </div>
                                                                            <div class="col">
                                                                                <h5 class="text-center">Büntető eredménye</h5>
                                                                                <h3 class="text-center">'.$meccs["bunteto_a_gol"].' - '.$meccs["bunteto_b_gol"].'</h3>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                        
                                                                    <h5 class="text-center m-3" id="eredmeny" style="border-radius: 15px; padding: 2px; background-color: rgba(47, 222, 93, 0.5);">Meccs nyertese: '.$eredmeny.'</h5>
                                                                </div>';
                                                    } else {
                                                        echo '<div class="card m-4 d-inline-block">
                                                                    <div class="card-header">
                                                                        <p class="h3 text-center">'.$meccs["csapat_a"].' - '.$meccs["csapat_b"].'</p>
                                                                        <p class="text-center h5">'.$meccs["datum"].' - '.$meccs["idopont"].'</p>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <h5 class="text-center">Meccs eredménye</h5>
                                                                                <h3 class="text-center">'.$meccs["csapat_a_gol"].' - '.$meccs["csapat_b_gol"].'</h3>
                                                                            </div>
                                                                            <div class="col">
                                                                                <h5 class="text-center">Büntető eredménye</h5>
                                                                                <h3 class="text-center"> - </h3>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                    <h5 class="text-center m-3" id="eredmeny" style="border-radius: 15px; padding: 2px; background-color: rgba(47, 222, 93, 0.5);">Meccs nyertese: '.$eredmeny.'</h5>
                                                                </div>';
                                                    }
                                                }
                                            }
                                        }
                                        
        
                                        
                                        $k++;
                                    }
                                }  else {
                                    echo "Nincsenek fent csapatok";
                                }

                                echo '</div>';
                            }
                        } else {
                            echo 'Nincsenek fent meccsek!';
                        }


                    ?>
            </div>
        </div>
    </div>
    
    <?php include_once 'parts/footer.php'; ?>
</body>
</html>