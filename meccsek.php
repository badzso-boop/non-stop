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

                        $meccsek = meccsekLekerese($conn);

                        $k = 0;
                        if ($meccsek->num_rows > 0) {
                            while($seged = $meccsek->fetch_assoc()) {
                                $eredmeny;
                                if ($seged["eredmeny"] == -1){
                                    $eredmeny = "Nincs rögzítve";
                                } elseif ($seged["eredmeny"] == 1) {
                                    $eredmeny = $seged["csapat_a"];
                                } elseif ($seged["eredmeny"] == 2) {
                                    $eredmeny = $seged["csapat_b"];
                                } elseif ($seged["eredmeny"] == 0) {
                                    $eredmeny = "Döntetlen";
                                }

                                $bunteto;
                                if ($seged["bunteto"] == 1) {
                                    $bunteto = "Igen";
                                } else {
                                    $bunteto = "Nem";
                                }

                                if ($seged["eredmeny"] == -1) {
                                    echo '<div class="card m-4 d-inline-block">
                                                <div class="card-header">
                                                    <p class="h3 text-center">'.$seged["csapat_a"].' - '.$seged["csapat_b"].'</p>
                                                    <p class="text-center h5">'.$seged["datum"].' - '.$seged["idopont"].'</p>
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
                                                        <p class="h3 text-center">'.$seged["csapat_a"].' - '.$seged["csapat_b"].'</p>
                                                        <p class="text-center h5">'.$seged["datum"].' - '.$seged["idopont"].'</p>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5 class="text-center">Meccs eredménye</h5>
                                                                <h3 class="text-center">'.$seged["csapat_a_gol"].' - '.$seged["csapat_b_gol"].'</h3>
                                                            </div>
                                                            <div class="col">
                                                                <h5 class="text-center">Büntető eredménye</h5>
                                                                <h3 class="text-center">'.$seged["bunteto_a_gol"].' - '.$seged["bunteto_b_gol"].'</h3>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <h5 class="text-center m-3" id="eredmeny" style="border-radius: 15px; padding: 2px; background-color: rgba(47, 222, 93, 0.5);">Meccs nyertese: '.$eredmeny.'</h5>
                                                </div>';
                                    } else {
                                        echo '<div class="card m-4 d-inline-block">
                                                    <div class="card-header">
                                                        <p class="h3 text-center">'.$seged["csapat_a"].' - '.$seged["csapat_b"].'</p>
                                                        <p class="text-center h5">'.$seged["datum"].' - '.$seged["idopont"].'</p>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5 class="text-center">Meccs eredménye</h5>
                                                                <h3 class="text-center">'.$seged["csapat_a_gol"].' - '.$seged["csapat_b_gol"].'</h3>
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
                                $k++;
                            }
                        }  else {
                            echo "Nincsenek fent csapatok :(";
                        }
                    ?>
            </div>
        </div>

                <!--
                <table id="meccsTable" class="table table-hover">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>időpont</th>
                            <th>Dátum</th>
                            <th>Csapat A</th>
                            <th>Csapat B</th>
                            <th>Csapat A gól</th>
                            <th>Csapat B Gól</th>
                            <th>Eredmény</th>
                            <th>Büntetővel</th>
                        </tr>
                    </thead>
                    <?php 
                        require_once 'includes/dbh.inc.php';
                        require_once 'includes/functions.inc.php';

                        $meccsek = meccsekLekerese($conn);

                        $k = 0;
                        if ($meccsek->num_rows > 0) {
                            while($seged = $meccsek->fetch_assoc()) {
                                $eredmeny;
                                if ($seged["eredmeny"] == -1){
                                    $eredmeny = "Nincs rögzítve";
                                } elseif ($seged["eredmeny"] == 1) {
                                    $eredmeny = $seged["csapat_a"];
                                } elseif ($seged["eredmeny"] == 2) {
                                    $eredmeny = $seged["csapat_b"];
                                } elseif ($seged["eredmeny"] == 0) {
                                    $eredmeny = "Döntetlen";
                                }

                                $bunteto;
                                if ($seged["bunteto"] == 1) {
                                    $bunteto = "Igen";
                                } else {
                                    $bunteto = "Nem";
                                }

                                $csoport_a_9 = ["9/C", "9/D", "10/A", "10/D"];
                                $csoport_b_9 = ["9/E", "10/B", "10/C", "10/E"];
                                $csoport_a_11 = ["11/B", "12/D", "13/C"];
                                $csoport_b_11 = ["11/D", "12/E", "13/E"];
                                $csoport_c_11 = ["11/E", "12/C", "13/D"];


                                if (in_array($seged["csapat_a"], $csoport_a_9)) {
                                    echo "<tr class='text-center'>
                                        <td style='background-color: rgba(255, 235, 179, 0.5)' id='".$k."idopont'>".$seged['idopont']."</td>
                                        <td style='background-color: rgba(255, 235, 179, 0.5)'>".$seged["datum"]."</td>
                                        <td style='background-color: rgba(255, 235, 179, 0.5)'>".$seged['csapat_a']."</td>
                                        <td style='background-color: rgba(255, 235, 179, 0.5)'>".$seged['csapat_b']."</td>
                                        <td style='background-color: rgba(255, 235, 179, 0.5)'>".$seged['csapat_a_gol']."</td>
                                        <td style='background-color: rgba(255, 235, 179, 0.5)'>".$seged['csapat_b_gol']."</td>
                                        <td style='background-color: rgba(255, 235, 179, 0.5)'>".$eredmeny."</td>
                                        <td style='background-color: rgba(255, 235, 179, 0.5)'>".$bunteto."</td></tr>";
                                } elseif (in_array($seged["csapat_a"], $csoport_b_9)) {
                                    echo "<tr class='text-center'>
                                        <td style='background-color: rgba(192, 255, 179, 0.5)' id='".$k."idopont'>".$seged['idopont']."</td>
                                        <td style='background-color: rgba(192, 255, 179, 0.5)'>".$seged["datum"]."</td>
                                        <td style='background-color: rgba(192, 255, 179, 0.5)'>".$seged['csapat_a']."</td>
                                        <td style='background-color: rgba(192, 255, 179, 0.5)'>".$seged['csapat_b']."</td>
                                        <td style='background-color: rgba(192, 255, 179, 0.5)'>".$seged['csapat_a_gol']."</td>
                                        <td style='background-color: rgba(192, 255, 179, 0.5)'>".$seged['csapat_b_gol']."</td>
                                        <td style='background-color: rgba(192, 255, 179, 0.5)'>".$eredmeny."</td>
                                        <td style='background-color: rgba(192, 255, 179, 0.5)'>".$bunteto."</td></tr>";
                                } elseif (in_array($seged["csapat_a"], $csoport_a_11)) {
                                    echo "<tr class='text-center'>
                                        <td style='background-color: rgba(179, 251, 255, 0.5)' id='".$k."idopont'>".$seged['idopont']."</td>
                                        <td style='background-color: rgba(179, 251, 255, 0.5)'>".$seged["datum"]."</td>
                                        <td style='background-color: rgba(179, 251, 255, 0.5)'>".$seged['csapat_a']."</td>
                                        <td style='background-color: rgba(179, 251, 255, 0.5)'>".$seged['csapat_b']."</td>
                                        <td style='background-color: rgba(179, 251, 255, 0.5)'>".$seged['csapat_a_gol']."</td>
                                        <td style='background-color: rgba(179, 251, 255, 0.5)'>".$seged['csapat_b_gol']."</td>
                                        <td style='background-color: rgba(179, 251, 255, 0.5)'>".$eredmeny."</td>
                                        <td style='background-color: rgba(179, 251, 255, 0.5)'>".$bunteto."</td></tr>";
                                } elseif (in_array($seged["csapat_a"], $csoport_b_11)) {
                                    echo "<tr class='text-center'>
                                        <td style='background-color: rgba(194, 179, 255, 0.5)' id='".$k."idopont'>".$seged['idopont']."</td>
                                        <td style='background-color: rgba(194, 179, 255, 0.5)'>".$seged["datum"]."</td>
                                        <td style='background-color: rgba(194, 179, 255, 0.5)'>".$seged['csapat_a']."</td>
                                        <td style='background-color: rgba(194, 179, 255, 0.5)'>".$seged['csapat_b']."</td>
                                        <td style='background-color: rgba(194, 179, 255, 0.5)'>".$seged['csapat_a_gol']."</td>
                                        <td style='background-color: rgba(194, 179, 255, 0.5)'>".$seged['csapat_b_gol']."</td>
                                        <td style='background-color: rgba(194, 179, 255, 0.5)'>".$eredmeny."</td>
                                        <td style='background-color: rgba(194, 179, 255, 0.5)'>".$bunteto."</td></tr>";
                                } elseif (in_array($seged["csapat_a"], $csoport_c_11)) {
                                    echo "<tr class='text-center'>
                                        <td style='background-color: rgba(251, 179, 255, 0.5)' id='".$k."idopont'>".$seged['idopont']."</td>
                                        <td style='background-color: rgba(251, 179, 255, 0.5)'>".$seged["datum"]."</td>
                                        <td style='background-color: rgba(251, 179, 255, 0.5)'>".$seged['csapat_a']."</td>
                                        <td style='background-color: rgba(251, 179, 255, 0.5)'>".$seged['csapat_b']."</td>
                                        <td style='background-color: rgba(251, 179, 255, 0.5)'>".$seged['csapat_a_gol']."</td>
                                        <td style='background-color: rgba(251, 179, 255, 0.5)'>".$seged['csapat_b_gol']."</td>
                                        <td style='background-color: rgba(251, 179, 255, 0.5)'>".$eredmeny."</td>
                                        <td style='background-color: rgba(251, 179, 255, 0.5)'>".$bunteto."</td></tr>";
                                }
                                
                                $k++;
                            }
                        }  else {
                            echo "Nincsenek fent csapatok :(";
                        }
                    ?>
                </table>
                -->
    </div>
    
    <?php include_once 'parts/footer.php'; ?>
</body>
</html>