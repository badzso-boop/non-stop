<?php 
    include_once 'parts/header.php';
?>


    <h1>Admin Felület</h1>

    <?php 
        if( empty(session_id()) && !headers_sent()){
            session_start();
        }

        if(!isset($_SESSION["uname"])) {
            echo '<form action="includes/admin.inc.php" method="post">
            <input type="text" name="uname" placeholder="Felhasználónév">
            <input type="password" name="pwd" placeholder="Jelszó">
            <button type="submit" name="submit">Belépés</button>
        </form>';
        } else {
            echo 'Üdvözlünk Admin!';
        }
    ?>

<hr style="width: 75%;">

    <h1>Csapatok feltöltése</h1>

    <div id="kezdes">
        <p>Hány csapat tag van?</p>
        <select id="szam">
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
        <button onclick="inputok()">Mentés</button>
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

    <table id = "csapatokTable">
        <tr>
            <td>Id</td>
            <td>Csapatnév</td>
            <td>Csapattagok</td>
            <td>Pontszám</td>
            <td></td>
            <td></td>
        </tr>
        <?php 
            require_once 'includes/dbh.inc.php';
            require_once 'includes/functions.inc.php';

            $csapatok = csapatokLekeres($conn);

            if ($csapatok->num_rows > 0) {
                while($seged = $csapatok->fetch_assoc()) {
                    $tomb = explode(";", $seged["csapat_tagok"]);
                    $szam = count($tomb) - 1;
                    
                    echo "<tr><td>".$seged["id"]."</td>";
                    echo "<td class='csapat_nev'>".$seged["csapat_nev"]."</td>";
                    echo "<td><ul>";
                    for ($i=0; $i < $szam; $i++) { 
                        echo "<li>".$tomb[$i]."</li>";
                    }
                    echo "</ul></td>";
                    echo "<td>".$seged["pontszam"]."</td>";
                    echo "<td><button onclick='csapatokSzerkesztesJS(".$seged["id"].",".json_encode($seged["csapat_nev"]).",".json_encode($seged["csapat_tagok"]).",".$seged["pontszam"].")'>Szerkesztés</button></td>";
                    echo "<td><button onclick='csapatokTorleseJS(".$seged["id"].",".json_encode($seged["csapat_nev"]).")'>Törlés</button></td></tr>";
                }
            } else {
                echo "Nincsenek fent csapatok :(";
            }
        ?>
    </table>
    <form action="includes/admin.inc.php" method="post" id="csapatSzerkForm"></form>
    <form action="includes/admin.inc.php" method="post" id="csapatTorleseForm"></form>

    <hr style="width: 75%;">

    <h1>Meccsek feltöltése</h1>
    <h4>Késés rögzítése</h4>
    <form action="includes/admin.inc.php" method="post">
        <label for="keses">Perc</label>
        <input type="number" name="keses">
        <button type="submit" name="submitKeses">Késés Rögzítése</button>
    </form>

    
    <br>
    <br>

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
        <tr>
            <th>Id</th>
            <th>Csapat A</th>
            <th>Csapat A gól</th>
            <th>Csapat B</th>
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

                    echo "<tr>
                    <td>".$seged['id']."</td>
                    <td>".$seged['csapat_a']."</td>
                    <td>".$seged['csapat_a_gol']."</td>
                    <td>".$seged['csapat_b']."</td>
                    <td>".$seged['csapat_b_gol']."</td>
                    <td>".$seged['datum']."</td>
                    <td id='".$k."idopont'>".$seged['idopont']."</td>
                    <td>".$eredmeny."</td>
                    <td>".$bunteto."</td>";

                    echo "<td><button onclick='meccsEredmenyRogzitese(".$seged['id'].", ".json_encode($seged['csapat_a']).", ".$seged['csapat_a_gol'].", ".json_encode($seged['csapat_b']).",".$seged['csapat_b_gol'].", ".json_encode($seged["datum"]).", ".json_encode($seged['idopont']).", ".$seged['eredmeny'].", ".$seged["bunteto"].")'>Eredmény rögzítése</button></td>";
                    echo "<td><button onclick='meccsSzerkesztese(".$seged['id'].", ".json_encode($seged['csapat_a']).", ".$seged['csapat_a_gol'].", ".json_encode($seged['csapat_b']).",".$seged['csapat_b_gol'].",".json_encode($seged["datum"]).", ".json_encode($seged['idopont']).", ".$seged['eredmeny'].")'>Meccs szerkesztése</button></td>";
                    echo "<td><button onclick='adottMeccsTorlese(".$seged['id'].", ".json_encode($seged["csapat_a"]).", ".json_encode($seged["csapat_b"]).")'>Meccs Törlése</button></td></tr>";
                    $k++;
                }
            }  else {
                echo "Nincsenek fent csapatok :(";
            }
        ?>
    </table>
    <form action="includes/admin.inc.php" method="post" id="meccsTorles"></form>
    <form action="includes/admin.inc.php" method="post" id="meccsEredmForm"></form>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    
    <form action="includes/admin.inc.php" method = "post">
        <button type="submit" name = "donto">Döntő számítás</button>
    </form>

</body>
</html>