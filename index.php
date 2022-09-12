<?php 
    include_once 'parts/header.php';
?>
    <h1>Fooldal</h1>

    <h3>Csapatok</h3>
    <table>
        <tr>
            <td>Csapatnév</td>
            <td>Csapattagok</td>
            <td>Pontszám</td>
        </tr>
        <?php 
            require_once 'includes/dbh.inc.php';
            require_once 'includes/functions.inc.php';

            $csapatok = csapatokLekeres($conn);

            if ($csapatok->num_rows > 0) {
                while($seged = $csapatok->fetch_assoc()) {
                    $tomb = explode(";", $seged["csapat_tagok"]);
                    $szam = count($tomb) - 1;
                    
                    
                    echo "<td>".$seged["csapat_nev"]."</td>";
                    echo "<td><ul>";
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

    <h3>Meccsek</h3>
    <table>
        <tr>
            <th>időpont</th>
            <th>Csapat A</th>
            <th>Csapat A gól</th>
            <th>Csapat B</th>
            <th>Csapat B Gól</th>
            <th>Eredmény</th>
        </tr>
        <?php 
            require_once 'includes/dbh.inc.php';
            require_once 'includes/functions.inc.php';

            $meccsek = meccsekLekerese($conn);

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

                    echo "<tr>
                    <td>".$seged['idopont']."</td>
                    <td>".$seged['csapat_a']."</td>
                    <td>".$seged['csapat_a_gol']."</td>
                    <td>".$seged['csapat_b']."</td>
                    <td>".$seged['csapat_b_gol']."</td>
                    <td>".$eredmeny."</td></tr>";
                }
            }  else {
                echo "Nincsenek fent csapatok :(";
            }
        ?>
    </table>
</body>
</html>