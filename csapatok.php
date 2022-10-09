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

    <h1 class="text-center m-5">Csapatok</h1>

    <div class="container-sm">
        <div class="row">
            <div class="col-sm">
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
    
    <?php include_once 'parts/footer.php'; ?>
</body>
</html>