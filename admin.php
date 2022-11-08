<?php 
    include_once 'parts/header.php';
?>
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
            echo '<h1 class="m-4 text-center">Üdvözlünk '.$_SESSION["uname"].'!</h1>';
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
        <div id="csapatok">
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
                    <div class="col-8" id="lista">
                            <?php 
                                require_once 'includes/dbh.inc.php';
                                require_once 'includes/functions.inc.php';

                                $csapatok = csapatokLekeres($conn);

                                if ($csapatok->num_rows > 0) {
                                    while($seged = $csapatok->fetch_assoc()) {
                                        $tomb = explode(";", $seged["csapat_tagok"]);
                                        $szam = count($tomb) - 1;

                                        echo "
                                        <div class='card d-inline-block m-4' style='width: 18rem;'>
                                            <div class='card-body'>
                                                <h5 class='card-title csapat_nev'>".$seged['csapat_nev']."</h5>
                                                <div class='card-text'>
                                                    <p>Pontszám: <span class='font-weight-bold'>".$seged['pontszam']."</span></p>
                                                    <ul>";
                                                    for ($i=0; $i < $szam; $i++) { 
                                                        echo "<li>".$tomb[$i]."</li>";
                                                    }
                                                    echo "</ul>
                                                </div>
                                                <button class='btn btn-secondary' onclick='csapatokTorleseJS(".$seged['id'].",".json_encode($seged['csapat_nev']).")'>Törlés</button>
                                                <button class='btn btn-secondary' onclick='csapatokSzerkesztesJS(".$seged["id"].",".json_encode($seged["csapat_nev"]).",".json_encode($seged["csapat_tagok"]).",".$seged["pontszam"].")'>Szerkesztés</button>
                                            </div>
                                        </div>";
                                    }
                                } else {
                                    echo "Nincsenek fent csapatok :(";
                                }
                            ?>
                    </div>
                    <div class="col-4" id="szerk">
                        <form class="m-4" action="includes/admin.inc.php" method="post" id="csapatSzerkForm"></form>
                        <form class="m-4" action="includes/admin.inc.php" method="post" id="csapatTorleseForm"></form>
                    </div>
                </div>
            </div>
        </div>

        <hr style="width: 75%;">

        <div id="csoportok">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card d-inline-block m-4" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Csoport feltöltése</h5>
                                <div class="card-text">
                                    <form action="includes/admin.inc.php" method="post">
                                        <label for="csoport_nev">Csoport név</label>
                                        <input type="text" name="csoport_nev">

                                        <br>
                                        <br>

                                        <label for="csapat_a">Csapatok</label>
                                        <div id="csapatnevek">
                                            <?php
                                                require_once 'includes/dbh.inc.php';
                                                require_once 'includes/functions.inc.php';

                                                $csapatok = csapatokLekeres($conn);
                                                $k = 0;

                                                if ($csapatok->num_rows > 0) {
                                                    while($seged = $csapatok->fetch_assoc()) {
                                                        if ($seged["csoport"] == NULL) {
                                                            echo '<div class="d-inline-block m-2"><label for="csapatnev">'.$seged["csapat_nev"].'</label>
                                                            <input type="checkbox" name="csapatnev[]" id="'.$seged["csapat_nev"].'-'.$k.'" value="'.$seged["csapat_nev"].'"> </div>';
                                                        }
                                                        $k++;
                                                    }
                                                }
                                            ?>
                                        </div>
                                        <button type="submit" class="m-auto btn btn-secondary" name="submitCsoport">Feltöltés</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card d-inline-block m-4 latszik" id="csTorlesCard" style="width: 40% !important">
                            <div class="card-body">
                                <h5 class="card-title" id="csth5"></h5>
                                <div class="card-text">
                                    <form action="includes/admin.inc.php" method="post" id="csoportTorlese"></form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <?php 
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
                                                </div>';
                                                echo "
                                                <button type='submit' class='m-auto btn btn-secondary' onclick='adottCsoportTorlese(".$seged["id"].", ".json_encode($seged["csoport_nev"]).")'>Törlés</button>
                                            </div>
                                        </div>";
                                }
                            }
                            else {
                                echo 'Nincsenek csoportok';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <hr style="width: 75%;">

        <div id="meccsek">
            <div id="szerk" class="container">
                <div class="row">
                    <div class="card d-inline-block m-4" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Meccsek feltöltése</h5>
                            <div class="card-text">
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

                                    <button type="submit" class="m-auto btn btn-secondary" name="submitMeccs">Mentés</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card d-inline-block m-4" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Késés rögzítése</h5>
                            <div class="card-text">
                                <div class="varazslat">
                                    <form action="includes/admin.inc.php" method="post">
                                        <label for="keses">Perc</label>
                                        <input type="number" name="keses">
                                        <button type="submit" name="submitKeses">Késés Rögzítése</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <br>
            <br>

            <div class="container" id="mlista">
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
                                echo '
                                <div class="card d-inline-block m-4" style="width: 18rem; background-color: rgba(247, 16, 0, 0.5);">
                                    <div class="card-body">
                                        <h5 class="card-title">'.$seged["csapat_a"].' - '.$seged['csapat_b'].' <br>  '.$seged['csapat_a_gol'].' - '.$seged['csapat_b_gol'].'</h5>
                                        <div class="card-text">
                                            <p>Dátum: <span class="font-weight-bold">'.$seged['datum'].'</span></p>
                                            <p>Időpont: <span class="font-weight-bold" id="'.$k.'idopont">'.$seged['idopont'].'</span></p>
                                            <p>Eredmény: <span class="font-weight-bold">'.$eredmeny.'</span></p>
                                            <p>Büntető <span class="font-weight-bold">'.$bunteto.'</span></p>
                                        </div>';
                                        echo "
                                        <button href='#' class='btn btn-secondary m-2' onclick='meccsEredmenyRogzitese(".$seged['id'].", ".json_encode($seged['csapat_a']).", ".$seged['csapat_a_gol'].", ".json_encode($seged['csapat_b']).",".$seged['csapat_b_gol'].", ".json_encode($seged["datum"]).", ".json_encode($seged['idopont']).", ".$seged['eredmeny'].", ".$seged["bunteto"].")'>Eredmény rögzítése</button>
                                        <button href='#' class='btn btn-secondary m-2' onclick='meccsSzerkesztese(".$seged['id'].", ".json_encode($seged['csapat_a']).", ".$seged['csapat_a_gol'].", ".json_encode($seged['csapat_b']).",".$seged['csapat_b_gol'].",".json_encode($seged["datum"]).", ".json_encode($seged['idopont']).", ".$seged['eredmeny'].")'>Szerkesztés</button>
                                        <button href='#' class='btn btn-secondary m-2' onclick='adottMeccsTorlese(".$seged['id'].", ".json_encode($seged["csapat_a"]).", ".json_encode($seged["csapat_b"]).")'>Törlés</button>
                                    </div>
                                </div>";
                            } else {
                                echo '
                                <div class="card d-inline-block m-4" style="width: 18rem; background-color: rgba(55, 237, 9, 0.5);">
                                    <div class="card-body">
                                        <h5 class="card-title">'.$seged["csapat_a"].' - '.$seged['csapat_b'].' <br>  '.$seged['csapat_a_gol'].' - '.$seged['csapat_b_gol'].'</h5>
                                        <div class="card-text">
                                            <p>Dátum: <span class="font-weight-bold">'.$seged['datum'].'</span></p>
                                            <p>Időpont: <span class="font-weight-bold" id="'.$k.'idopont">'.$seged['idopont'].'</span></p>
                                            <p>Eredmény: <span class="font-weight-bold">'.$eredmeny.'</span></p>
                                            <p>Büntető <span class="font-weight-bold">'.$bunteto.'</span></p>
                                        </div>';
                                        echo "
                                        <button href='#' class='btn btn-secondary m-2' onclick='adottMeccsTorlese(".$seged['id'].", ".json_encode($seged["csapat_a"]).", ".json_encode($seged["csapat_b"]).")'>Törlés</button>
                                    </div>
                                </div>";
                            }
                            $k++;
                        }
                    }  else {
                        echo "Nincsenek fent csapatok :(";
                    }
                ?>
            </div>

            <div id="form">
                <div class="card m-auto latszik" style="width: 18rem;" id="torlesCard">
                    <div class="card-body">
                        <h5 class="card-title">Meccs törlése</h5>
                        <div class="card-text">
                            <form action="includes/admin.inc.php" method="post" id="meccsTorles"></form>      
                        </div>
                    </div>
                </div>

                <div class="card m-auto latszik" style="width: 18rem;" id="eredmenyCard">
                    <div class="card-body">
                        <h5 class="card-title">Meccs Eredmény</h5>
                        <div class="card-text">
                            <form action="includes/admin.inc.php" method="post" id="meccsEredmForm"></form>
                        </div>
                    </div>
                </div>
            </div>

            <hr style="width: 75%;">

            <h1 class="text-center">Továbbjutás kiszámítása</h1>

            <ul>
                <li>Minden csoportbol a tobb ponttal rendelkezo csapatot osszeszedi egy listaba (CSOPORT A -> 9/C)</li>
                <li>Csapatok manualis osszeparositasa</li>
            </ul>

            <br>

            <ul>
                <li>Gombnyomasra mindent kiexportal, majd a tablakat kitorli es ismet mindent manualisan kell felvinni</li>
                <li>Nyilvan csak a csoportokat es a meccseket torli ki a csapatok maradnak</li>
            </ul>

            <h1>Csoport elsők</h1>

            <?php 
                $elsok = csoportElsok($conn);

                foreach ($elsok as $key => $item) {
                    $tomb = explode(";", $item);
                    echo $key . " -> " . $tomb[0] . ", " . $tomb[1] . " pont";
                    echo '<br>';
                }
            ?>

            <form action="includes/admin.inc.php" method="post">
                <button class="btn btn-secondary" type="submit" name="submitBiztonsagi">Mentés</button>
            </form>

            <br>
            
            <h3>Új meccs feltöltése</h3>
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

                <label for="csoport">Csoport név</label>
                <input type="text" name="csoport" placeholder="Csoport név">

                <br>

                <label for="datum">Meccs dátuma:</label>
                <input type="date" name="datum">

                <label for="idopont">Meccs időpontja:</label>
                <input type="time" name="idopont">


                <input type="number" name="eredmeny" value="-1" style="display:none">

                <button type="submit" class="m-auto btn btn-secondary" name="submitMeccsTovabbjutas">Mentés</button>
            </form>

            <br>
            <br>
            <br>
            <br>
        </div>
    </div>
</body>
</html>