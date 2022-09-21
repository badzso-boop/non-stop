<?php
    if( empty(session_id()) && !headers_sent()){
        session_start();
    }

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //felhasznalo beleptetese
    if(isset($_POST["submit"])) {
        $uname = $_POST["uname"];
        $pwd = $_POST["pwd"];

        //Üres input mezok ellenorzese
        if(emptyInputLogin($uname, $pwd) === true) {
            header("location: ../admin.php?error=emptyinputLogin");
                exit();
        }

        //Felhasznalo beleptetese
        LoginUser($conn, $uname, $pwd);
    }

    if(isset($_SESSION["uname"])) {
        if ($_SESSION["uname"] == "admin") {

            //Csapat feltoltese
            if(isset($_POST["submitCS"])) {
                $csapatNev = $_POST["csapatnev"];
                $csapatTSzam = $_POST["szam"];
                $pontszam = $_POST["pontszam"];

                $csapatTagok = "".$_POST["nev1"]." - ".$_POST["osztaly1"].";";
                for ($i=2; $i <= $csapatTSzam; $i++) { 
                    $csapatTagok .= "".$_POST['nev'.$i]." - ".$_POST['osztaly'.$i].";";
                }

                //echo 'Csapatnev: '.$csapatNev.', Csapattagok: '.$csapatTagok.'';

                if(emptyInputCsapatok($csapatNev, $csapatTagok)) {
                    header("location: ../admin.php?error=emptyinputcsapatok");
                    exit();
                }

                csapatFeltoltese($conn, $csapatNev, $csapatTagok, $pontszam);
            }

            //Csapat Szerkesztese
            if(isset($_POST["submitCsSzerk"])) {
                $id = $_POST["id"];
                $csapatNev = $_POST["csapat_nev"];
                $pontszam = $_POST["pontszam"];
                $csapatTSzam = $_POST["szam"];

                $csapatTagok = "".$_POST["nev1"]." - ".$_POST["osztaly1"].";";
                for ($i=2; $i <= $csapatTSzam; $i++) { 
                    $csapatTagok .= "".$_POST['nev'.$i]." - ".$_POST['osztaly'.$i].";";
                }

                if(emptyInputCsapatok($csapatNev, $csapatTagok)) {
                    header("location: ../admin.php?error=emptyinputcsapatok");
                    exit();
                }

                csapatSzerkesztese($conn, $id, $csapatNev, $csapatTagok, $pontszam);
            }

            if(isset($_POST["submitCsTorles"])) {
                $id = $_POST["id"];

                csapatTorlese($conn, $id);
            }

            //Meccs feltöltése
            if(isset($_POST["submitMeccs"])) {
                $csapat_a = $_POST["csapat_a"];
                $csapat_a_gol = $_POST["csapat_a_gol"];

                $csapat_b = $_POST["csapat_b"];
                $csapat_b_gol = $_POST["csapat_b_gol"];

                $datum = $_POST["datum"];
                $idopont = $_POST["idopont"];
                $eredmeny = $_POST["eredmeny"];

                if(!emptyInputMeccsek($csapat_a, $csapat_a_gol, $csapat_b, $csapat_b_gol, $idopont, $eredmeny)) {
                    header("location: ../admin.php?error=emptyinputmeccsek");
                    exit();
                }

                meccsFeltoltese($conn, $csapat_a, $csapat_a_gol, $csapat_b, $csapat_b_gol,$datum,  $idopont, $eredmeny);
            }

            //Meccs Eredmény rögzítése
            if(isset($_POST["submitMeccsEredm"])) {
                $id = $_POST['id'];
                $csapat_a = $_POST['csapat_a'];
                $csapat_a_gol = $_POST['csapat_a_gol'];
                $csapat_b = $_POST['csapat_b'];
                $csapat_b_gol = $_POST['csapat_b_gol'];

                $datum = $_POST["datum"];
                $idopont = $_POST['idopont'];
                $eredmeny = $_POST['eredmeny'];
                $bunteto = $_POST['bunteto'];

                if ($bunteto == true) {
                    $buntetoEredm = 1;
                } else {
                    $buntetoEredm = 0;
                }

                meccsEredmenyRogzitese($conn, $id, $csapat_a, $csapat_a_gol, $csapat_b, $csapat_b_gol, $idopont, $eredmeny, $buntetoEredm);

                pontozas($mysqli, $conn, $csapat_a, $csapat_a_gol, $csapat_b, $csapat_b_gol, $eredmeny, $buntetoEredm);

                header("location: ../admin.php?error=none");
                exit();
            }

            //Késés rögzítése
            if(isset($_POST["submitKeses"])) {
                $keses = $_POST["keses"];
                
                kesesRogzitese($conn, $mysqli, $keses);
            }

            //Meccs törlése
            if (isset($_POST["adottMeccsTorlese"])) {
                $id = $_POST["id"];

                meccsTorlese($conn, $id);
            }

            //Meccs Sszerkesztése
            if (isset($_POST["SubmitMeccsSzerk"])) {
                $id = $_POST['id'];
                $csapat_a = $_POST['csapat_a'];
                $csapat_a_gol = $_POST['csapat_a_gol'];
                $csapat_b = $_POST['csapat_b'];
                $csapat_b_gol = $_POST['csapat_b_gol'];

                $datum = $_POST["datum"];
                $idopont = $_POST['idopont'];

                if(!emptyInputMeccsek($csapat_a, $csapat_a_gol, $csapat_b, $csapat_b_gol, $idopont, $eredmeny)) {
                    header("location: ../admin.php?error=emptyinputmeccsek");
                    exit();
                }

                MeccsSzerkesztese($conn, $id, $csapat_a, $csapat_a_gol, $csapat_b, $csapat_b_gol,$datum, $idopont, $eredmeny);
            }
        } else {
            header("location: ../index.php?error=notadmin");
        }
    }