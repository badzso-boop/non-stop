<?php
    if( empty(session_id()) && !headers_sent()){
        session_start();
    }

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

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

    if(isset($_POST["submitCS"])) {
        $csapatNev = $_POST["csapatnev"];
        $csapatTSzam = $_POST["szam"];
        $pontszam = $_POST["pontszam"];

        $csapatTagok = "".$_POST["nev1"]."-".$_POST["osztaly1"].";";
        for ($i=2; $i <= $csapatTSzam; $i++) { 
            $csapatTagok .= "".$_POST['nev'.$i]."-".$_POST['osztaly'.$i].";";
        }

        //echo 'Csapatnev: '.$csapatNev.', Csapattagok: '.$csapatTagok.'';

        if(emptyInputCsapatok($csapatNev, $csapatTagok)) {
            header("location: ../admin.php?error=emptyinputcsapatok");
            exit();
        }

        csapatFeltoltese($conn, $csapatNev, $csapatTagok, $pontszam);
    }