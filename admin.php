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

    <hr style="width='75%'">

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

    <hr>

    <h1>Csapatok listája:</h1>

    <table>
        <tr>
            <td>Id</td>
            <td>Csapatnév</td>
            <td>Csapattagok</td>
            <td>Pontszám</td>
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
                    echo "<td>".$seged["csapat_nev"]."</td>";
                    echo "<td><ul>";
                    for ($i=0; $i < $szam; $i++) { 
                        echo "<li>".$tomb[$i]."</li>";
                    }
                    echo "</ul></td>";
                    echo "<td>".$seged["pontszam"]."</td>";
                    echo "<td><button onclick='csapatokSzerkesztesJS(".$seged["id"].",".json_encode($seged["csapat_nev"]).",".json_encode($seged["csapat_tagok"]).",".$seged["pontszam"].")'>Szerkesztés</button></td></tr>";
                }
            } else {
                echo "Nincsenek fent csapatok :(";
            }
        ?>
    </table>
    <form action="includes/admin.inc.php" method="post" id="csapatSzerkForm">
    </form>



    
</body>
</html>