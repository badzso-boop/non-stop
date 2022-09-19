<?php 
    include_once 'parts/header.php';
?>


    <h1 class="text-center">Admin Felület</h1>

    <?php 
        if( empty(session_id()) && !headers_sent()){
            session_start();
        }

        if(!isset($_SESSION["uname"])) {
            echo '<div class="adminlogin">
                    <form action="includes/admin.inc.php" method="post">
                    <input type="text" name="uname" placeholder="Felhasználónév">
                    <input type="password" name="pwd" placeholder="Jelszó">
                    <button type="submit" name="submit">Belépés</button>
                    </form>
                </div>';
        } else {
            echo '<h3 class="text-center">Üdvözlünk '.$_SESSION["uname"].'!</h3>';
            echo '<style type="text/css">
                .fooldal {
                    display: block !important;
                }
                .adminlogin {
                    display: none !important;
                }
                </style>';
        }
    ?>

    <hr style="width: 75%;">
    <?php 
        require_once 'includes/admin.inc.php';
    ?>

    <div class="fooldal">
        <h1 class="text-center">Csapatok feltöltése</h1>

        <div id="kezdes">
            <div class="container">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Hány csapat tag van?</label>
                    </div>
                    <select id ="szam" class="custom-select" id="inputGroupSelect01">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                    </select>
                </div>
                <button class="btn btn-secondary" onclick="inputok()">Mentés</button>
            </div>
        </div>

        <form id="csapatForm" action="includes/admin.inc.php" method="post">
            <?php
            /*
                - csapatnev
                - csapat_tagok (nev - osztaly)
                - pontszam
                - hany csapat tag van
            */
            ?>
        </form>

        <hr style="width: 75%;">

        <h1>Csapatok listája:</h1>

        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <table id = "csapatokTable">
                        <thead class='text-center'>
                            <tr>
                                <th>Id</th>
                                <th>Csapatnév</th>
                                <th>Csapattagok</th>
                                <th>Pontszám</th>
                                <th></th>
                                <th></th>
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
                                    
                                    echo "<tr style='text-align: center;'>
                                    <td style='padding: 15px;border: 1px solid black;'>".$seged["id"]."</td>";
                                    echo "<td style='padding: 15px; border: 1px solid black;' class='csapat_nev'>".$seged["csapat_nev"]."</td>";
                                    echo "<td style='padding: 15px; border: 1px solid black;'><ul style='list-style: none;'>";
                                    for ($i=0; $i < $szam; $i++) { 
                                        echo "<li>".$tomb[$i]."</li>";
                                    }
                                    echo "</ul></td>";
                                    echo "<td style='padding: 15px; border: 1px solid black;'>".$seged["pontszam"]."</td>";
                                    echo "<td style='padding: 15px;'><button class='btn btn-secondary' onclick='csapatokSzerkesztesJS(".$seged["id"].",".json_encode($seged["csapat_nev"]).",".json_encode($seged["csapat_tagok"]).",".$seged["pontszam"].")'>Szerkesztés</button></td>";
                                    echo "<td style='padding: 15px;'><button class='btn btn-secondary' onclick='csapatokTorleseJS(".$seged["id"].",".json_encode($seged["csapat_nev"]).")'>Törlés</button></td></tr>";
                                }
                            } else {
                                echo "Nincsenek fent csapatok :(";
                            }
                        ?>
                    </table>
                </div>
                <div class="col-sm">
                    <form class="m-4" action="includes/admin.inc.php" method="post" id="csapatSzerkForm"></form>
                    <form class="m-4" action="includes/admin.inc.php" method="post" id="csapatTorleseForm"></form>
                </div>
            </div>
        </div>

        <hr style="width: 75%;">

        <h1>Meccsek feltöltése</h1>
        <div class="varazslat" style="display: none">
            <h4>Késés rögzítése</h4>
            <form action="includes/admin.inc.php" method="post">
                <label for="keses">Perc</label>
                <input type="number" name="keses">
                <button type="submit" name="submitKeses">Késés Rögzítése</button>
            </form>
        </div>

        <form action="includes/admin.inc.php" method="post">
            <label for="csapat_a">Csapat A</label>
            <select name="csapat_a">
                <?php
                    require_once 'includes/dbh.inc.php';
                    require_once 'includes/functions.inc.php';

                    $csapatok = csapatokLekeres($conn);

                    if ($csapatok->num_rows > 0) {
                        while($seged = $csapatok->fetch_assoc()) {
                            echo '<option value="'.$seged["csapat_nev"].'">'.$seged["csapat_nev"].'</option>';
                        }
                    }
                ?>
            </select>

            <input type="number" name="csapat_a_gol" value="0" style="display:none;">

            <br>

            <label for="csapat_b">Csapat B</label>
            <select name="csapat_b">
                <?php
                    require_once 'includes/dbh.inc.php';
                    require_once 'includes/functions.inc.php';

                    $csapatok = csapatokLekeres($conn);

                    if ($csapatok->num_rows > 0) {
                        while($seged = $csapatok->fetch_assoc()) {
                            echo '<option value="'.$seged["csapat_nev"].'">'.$seged["csapat_nev"].'</option>';
                        }
                    }
                ?>
            </select>
            <input type="number" name="csapat_b_gol" value="0" style="display:none;">

            <br>

            <label for="datum">Meccs dátuma:</label>
            <input type="date" name="datum">
            <label for="idopont">Meccs időpontja:</label>
            <input type="time" name="idopont">
            <input type="number" name="eredmeny" value="-1" style="display:none">

            <button type="submit" name="submitMeccs">Mentés</button>
        </form>

        <br>
        <br>

        <table id="meccsTable">
            <tr class="text-center">
                <th>Id</th>
                <th>Csapat A</th>
                <th>Csapat B</th>
                <th>Csapat A gól</th>
                <th>Csapat B Gól</th>
                <th>Dátum</th>
                <th>időpont</th>
                <th>Eredmény</th>
                <th>Büntető</th>
                <th></th>
                <th></th>
            </tr>
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

                        if ($eredmeny == "Nincs rögzítve") {
                            echo "<tr style = 'background-color: rgba(235, 190, 190, 0.5);'>
                            <td style='padding: 20px;border: 1px solid black;'>".$seged['id']."</td>
                            <td style='padding: 20px;border: 1px solid black;'>".$seged['csapat_a']."</td>
                            <td style='padding: 20px;border: 1px solid black;'>".$seged['csapat_b']."</td>
                            <td style='padding: 20px;border: 1px solid black;'>".$seged['csapat_a_gol']."</td>
                            <td style='padding: 20px;border: 1px solid black;'>".$seged['csapat_b_gol']."</td>
                            <td style='padding: 20px;border: 1px solid black;'>".$seged['datum']."</td>
                            <td style='padding: 20px;border: 1px solid black;' id='".$k."idopont'>".$seged['idopont']."</td>
                            <td style='padding: 20px;border: 1px solid black;'>".$eredmeny."</td>
                            <td style='padding: 20px;border: 1px solid black;'>".$bunteto."</td>";

                            echo "<td style='padding: 5px;border: 1px solid black;'><button class='btn btn-secondary' onclick='meccsEredmenyRogzitese(".$seged['id'].", ".json_encode($seged['csapat_a']).", ".$seged['csapat_a_gol'].", ".json_encode($seged['csapat_b']).",".$seged['csapat_b_gol'].", ".json_encode($seged["datum"]).", ".json_encode($seged['idopont']).", ".$seged['eredmeny'].", ".$seged["bunteto"].")'>Eredmény rögzítése</button></td>";
                            echo "<td style='padding: 5px;border: 1px solid black;'><button class='btn btn-secondary' onclick='meccsSzerkesztese(".$seged['id'].", ".json_encode($seged['csapat_a']).", ".$seged['csapat_a_gol'].", ".json_encode($seged['csapat_b']).",".$seged['csapat_b_gol'].",".json_encode($seged["datum"]).", ".json_encode($seged['idopont']).", ".$seged['eredmeny'].")'>Meccs szerkesztése</button></td>";
                            echo "<td style='padding: 5px;border: 1px solid black;'><button class='btn btn-secondary' onclick='adottMeccsTorlese(".$seged['id'].", ".json_encode($seged["csapat_a"]).", ".json_encode($seged["csapat_b"]).")'>Meccs Törlése</button></td></tr>";
                        } else {
                            echo "<tr style = 'background-color: rgba(190, 235, 190, 0.5);'>
                            <td style='padding: 20px;border: 1px solid black;'>".$seged['id']."</td>
                            <td style='padding: 20px;border: 1px solid black;'>".$seged['csapat_a']."</td>
                            <td style='padding: 20px;border: 1px solid black;'>".$seged['csapat_b']."</td>
                            <td style='padding: 20px;border: 1px solid black;'>".$seged['csapat_a_gol']."</td>
                            <td style='padding: 20px;border: 1px solid black;'>".$seged['csapat_b_gol']."</td>
                            <td style='padding: 20px;border: 1px solid black;'>".$seged['datum']."</td>
                            <td style='padding: 20px;border: 1px solid black;' id='".$k."idopont'>".$seged['idopont']."</td>
                            <td style='padding: 20px;border: 1px solid black;'>".$eredmeny."</td>
                            <td style='padding: 20px;border: 1px solid black;'>".$bunteto."</td>";

                            echo "<td style='padding: 5px;border: 1px solid black;'><button class='btn btn-secondary' onclick='meccsEredmenyRogzitese(".$seged['id'].", ".json_encode($seged['csapat_a']).", ".$seged['csapat_a_gol'].", ".json_encode($seged['csapat_b']).",".$seged['csapat_b_gol'].", ".json_encode($seged["datum"]).", ".json_encode($seged['idopont']).", ".$seged['eredmeny'].", ".$seged["bunteto"].")'>Eredmény rögzítése</button></td>";
                            echo "<td style='padding: 5px;border: 1px solid black;'><button class='btn btn-secondary' onclick='meccsSzerkesztese(".$seged['id'].", ".json_encode($seged['csapat_a']).", ".$seged['csapat_a_gol'].", ".json_encode($seged['csapat_b']).",".$seged['csapat_b_gol'].",".json_encode($seged["datum"]).", ".json_encode($seged['idopont']).", ".$seged['eredmeny'].")'>Meccs szerkesztése</button></td>";
                            echo "<td style='padding: 5px;border: 1px solid black;'><button class='btn btn-secondary' onclick='adottMeccsTorlese(".$seged['id'].", ".json_encode($seged["csapat_a"]).", ".json_encode($seged["csapat_b"]).")'>Meccs Törlése</button></td></tr>";
                        }
                        $k++;
                    }
                }  else {
                    echo "Nincsenek fent csapatok :(";
                }
            ?>
        </table>
        <br>
        <br>
        <form action="includes/admin.inc.php" method="post" id="meccsTorles"></form>
        <form action="includes/admin.inc.php" method="post" id="meccsEredmForm"></form>

        <br>
        <br>
        <br>
        <br>
    </div>
</body>
</html>