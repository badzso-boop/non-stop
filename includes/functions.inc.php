<?php

function emptyInputLogin($uname, $pwd) {
    $result;
    if(empty($uname) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function unameExists($conn, $uname) {
    $sql = "SELECT * FROM felhasznalok WHERE uname = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../admin.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $uname);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

function LoginUser($conn, $uname, $pwd) {
    $unameExists = unameExists($conn, $uname);

    if ($unameExists === false) {
		header("location: ../admin.php?error=wronglogin");
		exit();
	}


    //Majd hasheld a jelszot!!!!!!
    $pwdHashed = $unameExists["pwd"];
    $checkedPwd;

    if($pwdHashed == $pwd) {
        $checkedPwd = true;
    } else {
        $checkedPwd = false;
    }

    if($checkedPwd == false) {
        header("location: ../admin.php?error=wrongpwd");
		exit();
    } elseif($checkedPwd == true) {
        if( empty(session_id()) && !headers_sent()){
            session_start();
        }

        $_SESSION["id"] = $unameExists["id"];
        $_SESSION["uname"] = $unameExists["uname"];
        $_SESSION["pwd"] = $unameExists["pwd"];

        header("location: ../admin.php?error=none");
		exit();
    }
}

function emptyInputCsapatok($csapatNev, $csapatTagok) {
    $result;
    if(empty($csapatNev) || empty($csapatTagok)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function csapatFeltoltese($conn, $csapatNev, $csapatTagok, $pontszam) {
    $sql = "INSERT INTO csapatok (csapat_nev, csapat_tagok, pontszam) VALUES (?, ?, ?)";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../admin.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "sss", $csapatNev, $csapatTagok, $pontszam);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../admin.php?error=none");
	exit();
}