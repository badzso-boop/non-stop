<?php 
    include_once 'parts/header.php';
?>
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
    

    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="text-center m-5">Meccsek</h3>

                <table id="meccsTable" class="table table-hover">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>időpont</th>
                            <th>Dátum</th>
                            <th>Késés</th>
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
                                <td></td>
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