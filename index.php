<!DOCTYPE html>
<html lang="en">
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
    <title>Non-Stop</title>
</head>
<body>
    <h1 class="text-center m-5">Fooldal</h1>

    <div class="container-sm">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center m-5">Csapatok</h3>
                <table class = "table table-hover">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>Csapatnév</th>
                            <th>Csapattagok</th>
                            <th>Pontszám</th>
                        </tr>
                    </thead>
                    <?php 
                        require_once 'includes/dbh.inc.php';
                        require_once 'includes/functions.inc.php';

                        $csapatok = csapatokLekeres($conn);

                        if ($csapatok->num_rows > 0) {
                            while($seged = $csapatok->fetch_assoc()) {
                                $tomb = explode(";", $seged["csapat_tagok"]);
                                $szam = count($tomb) - 1;
                                
                                
                                echo "<tr class='text-center'><td>".$seged["csapat_nev"]."</td>";
                                echo "<td><ul style='list-style: none;'>";
                                for ($i=0; $i < $szam; $i++) { 
                                    echo "<li>".$tomb[$i]."</li>";
                                }
                                echo "</ul></td>";
                                echo "<td>".$seged["pontszam"]."</td></tr>";
                            }
                        } else {
                            echo "Nincsenek fent csapatok :(";
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <div class="container-sm">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center m-5">Csoportok</h3>
                <table class="table table-hover">
                    <thead class="thead-light">
                        <th  style="border-right: 2px solid lightgrey;" class="text-center" colspan="2">9. - 10.</th=>
                        <th class="text-center" colspan="3">11. - 12. - 13.</th>
                    </thead>
                    <tr class="text-center">
                        <td>A Csoport</td>
                        <td style="border-right: 2px solid lightgrey;">B Csoport</td>
                        <td>A Csoport</td>
                        <td>B Csoport</td>
                        <td>C Csoport</td>
                    </tr>
                    <tr class="text-center">
                        <td>9/C</td>
                        <td style="border-right: 2px solid lightgrey;">9/E</td>
                        <td>11/B</td>
                        <td>11/D</td>
                        <td>11/E</td>
                    </tr>
                    <tr class="text-center">
                        <td>9/D</td>
                        <td style="border-right: 2px solid lightgrey;">10/B</td>
                        <td>12/D</td>
                        <td>12/E</td>
                        <td>12/C</td>
                    </tr>
                    <tr class="text-center">
                        <td>10/A</td>
                        <td style="border-right: 2px solid lightgrey;">10/C</td>
                        <td>13/C</td>
                        <td>13/E</td>
                        <td>13/D</td>
                    </tr>
                    <tr class="text-center">
                        <td>10/D</td>
                        <td style="border-right: 2px solid lightgrey;">10/E</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="text-center m-5">Meccsek</h3>

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

                                echo "<tr class='text-center'>
                                <td id='".$k."idopont'>".$seged['idopont']."</td>
                                <td>".$seged["datum"]."</td>
                                <td>".$seged['csapat_a']."</td>
                                <td>".$seged['csapat_b']."</td>
                                <td>".$seged['csapat_a_gol']."</td>
                                <td>".$seged['csapat_b_gol']."</td>
                                <td>".$eredmeny."</td>
                                <td>".$bunteto."</td></tr>";
                                $k++;
                            }
                        }  else {
                            echo "Nincsenek fent csapatok :(";
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>