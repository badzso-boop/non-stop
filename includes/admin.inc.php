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
            header("location: ../admin.php?error=emptyinput");
                exit();
        }

        //Felhasznalo beleptetese
        LoginUser($conn, $uname, $pwd);
    }