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

function csapatokLekeres($conn) {
    $sql = "SELECT * FROM csapatok ORDER BY csapat_nev DESC";
	$result = $conn->query($sql);

	return $result;
}

function csapatSzerkesztese($conn, $id, $csapatNev, $csapatTagok, $pontszam) {
    $sql = "UPDATE csapatok SET csapat_nev = ?, csapat_tagok = ?, pontszam = ? WHERE id = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../admin.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ssss", $csapatNev, $csapatTagok, $pontszam, $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../admin.php?error=none");
	exit();
}

function csapatTorlese($conn, $id) {
	$sql = "DELETE FROM csapatok WHERE id = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../admin.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../admin.php?error=none");
	exit();
}

function emptyInputMeccsek($csapat_a, $csapat_a_gol, $csapat_b, $csapat_b_gol, $idopont, $eredmeny) {
	$result;
	if(empty($csapat_a) || empty($csapat_a_gol) || empty($csapat_b) || empty($csapat_b_gol) || empty($idopont) || empty($eredmeny)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function meccsFeltoltese($conn, $csapat_a, $csapat_a_gol, $csapat_b, $csapat_b_gol, $datum, $idopont, $eredmeny) {
	$sql = "INSERT INTO meccsek (csapat_a, csapat_a_gol, csapat_b, csapat_b_gol, datum, idopont, eredmeny, bunteto, bunteto_a_gol, bunteto_b_gol) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, 0)";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../admin.php?error=stmtfailed");
		exit();
	}

	$bunteto = 0;
	mysqli_stmt_bind_param($stmt, "ssssssss", $csapat_a, $csapat_a_gol, $csapat_b, $csapat_b_gol, $datum, $idopont, $eredmeny, $bunteto);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../admin.php?error=none");
	exit();
}

function meccsekLekerese($conn) {
	$sql = "SELECT * FROM meccsek ORDER BY datum ASC";
	$result = $conn->query($sql);

	return $result;
}

function meccsEredmenyRogzitese($conn, $id, $csapat_a, $csapat_a_gol, $csapat_b, $csapat_b_gol, $idopont, $eredmeny, $buntetoEredm, $bunteto_a_gol, $bunteto_b_gol) {
	$sql = "UPDATE meccsek SET  csapat_a = ?, csapat_a_gol = ?, csapat_b = ?, csapat_b_gol = ?, idopont = ?, eredmeny = ?, bunteto = ?, bunteto_a_gol = ?, bunteto_b_gol = ? WHERE id = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../admin.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ssssssssss", $csapat_a, $csapat_a_gol, $csapat_b, $csapat_b_gol, $idopont, $eredmeny, $buntetoEredm, $bunteto_a_gol, $bunteto_b_gol, $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}

function pontozas($mysqli, $conn, $csapat_a, $csapat_a_gol, $csapat_b, $csapat_b_gol, $eredmeny, $buntetoEredm) {
	//NYERÉS csapatok kozt kikeresni a nyertes csapatot es megadni neki a pontot (3)
	//DÖNTETLEN csapatok közt megkeresni mind2 csapatot és 1-1 pontot adni nekik

	//hazi foci bajnoksag

	//nyer -> 3 pont
	//dontetlen -> buntetovel 2 pont vesztes 1 pont

	$sql = "SELECT * FROM csapatok";
	$csapatok = $mysqli->query($sql);
	
	$pontszamA = 0;
	$pontszamB = 0;

	if ($csapatok->num_rows > 0) {
		while($seged = $csapatok->fetch_assoc()) {
			if ($seged["csapat_nev"] == $csapat_a) {
				$pontszamA = $seged["pontszam"];
			}
			if ($seged["csapat_nev"] == $csapat_b) {
				$pontszamB = $seged["pontszam"];
			}
		}
	}

	$sql = "";
	//[0 -> döntetlen; 1 -> a; 2 -> b]
	if ($eredmeny == 1 && $buntetoEredm == 1) {
		//Nyert az A csapat! A: 2pont B: 1pont
		$pontszamA += 2;
		$pontszamB += 1;
		$sql .= "UPDATE csapatok SET pontszam = ".$pontszamA." WHERE csapat_nev = '".$csapat_a."';";
		$sql .= "UPDATE csapatok SET pontszam = ".$pontszamB." WHERE csapat_nev = '".$csapat_b."';";
	} else if ($eredmeny == 1 && $buntetoEredm == 0) {
		//Nyert az A csapat!
		$pontszamA += 3;
		$sql .= "UPDATE csapatok SET pontszam = ".$pontszamA." WHERE csapat_nev = '".$csapat_a."';";
	} else if ($eredmeny == 2 && $buntetoEredm == 1) {
		//Nyert a B csapat! B: 2pont A: 1pont
		$pontszamA += 1;
		$pontszamB += 2;
		$sql .= "UPDATE csapatok SET pontszam = ".$pontszamA." WHERE csapat_nev = '".$csapat_a."';";
		$sql .= "UPDATE csapatok SET pontszam = ".$pontszamB." WHERE csapat_nev = '".$csapat_b."';";
	} else if ($eredmeny == 2 && $buntetoEredm == 0) {
		//Nyert a B csapat!
		$pontszamB += 3;
		$sql .= "UPDATE csapatok SET pontszam = ".$pontszamB." WHERE csapat_nev = '".$csapat_b."';";
	} else if ($eredmeny == 0) {
		//döntetlen
	}
	$mysqli->multi_query($sql);

	print ($sql);

	do {
		if ($result = $mysqli->store_result()) {
			var_dump($result->fetch_all());
			$result->free();
		}
	} while ($mysqli->next_result());
}

//visszafele is mehessen a keses
function kesesRogzitese($conn, $mysqli, $keses) {
	//lekerem a meccseket majd vegigmegyek rajtuk es az id alapjan updatelem az osszesnek az idejet
	$meccsek = meccsekLekerese($conn);

	//az eredeti ido elmentese egy kulon oszlopba
	//ha a keses = 0 akkor az eredeti ido kiirasa

	$sql = "";
	if ($meccsek->num_rows > 0) {
		while($seged = $meccsek->fetch_assoc()) {
			$ido = $seged["idopont"];

			$segedsz = strtotime($ido);
			$date = date("H:i", $segedsz);
	
			$time = new DateTime($date);
			$time->add(new DateInterval('PT' . $keses . 'M'));
	
			$stamp = $time->format('H:i');

			$sql .= "UPDATE meccsek SET csapat_a = '".$seged["csapat_a"]."', csapat_a_gol = ".$seged["csapat_a_gol"].", csapat_b = '".$seged["csapat_b"]."', csapat_b_gol = ".$seged["csapat_b_gol"].", idopont = '".$stamp."', eredmeny = ".$seged["eredmeny"]." WHERE id = ".$seged["id"].";";
		}
	}
	$mysqli->multi_query($sql);

	print $sql;

	do {
		if ($result = $mysqli->store_result()) {
			var_dump($result->fetch_all());
			$result->free();
		}
	} while ($mysqli->next_result());
	
	header("location: ../admin.php?error=none");
	exit();
}

function meccsTorlese($conn, $id) {
	$sql = "DELETE FROM meccsek WHERE id = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../admin.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../admin.php?error=none");
	exit();
}

function MeccsSzerkesztese($conn, $id, $csapat_a, $csapat_a_gol, $csapat_b, $csapat_b_gol,$datum, $idopont, $eredmeny) {
	$sql = "UPDATE meccsek SET  csapat_a = ?, csapat_a_gol = ?, csapat_b = ?, csapat_b_gol = ?, datum = ?, idopont = ?, eredmeny = ? WHERE id = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../admin.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ssssssss", $csapat_a, $csapat_a_gol, $csapat_b, $csapat_b_gol, $datum, $idopont, $eredmeny, $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../admin.php?error=none");
	exit();
}

function csoportokLekerese($conn) {
	$sql = "SELECT * FROM csoportok ORDER BY csoport_nev ASC";
	$result = $conn->query($sql);

	return $result;
}

function csoportFeltoltese($conn, $csoport_nev, $csapatok_str) {
	$sql = "INSERT INTO csoportok (csoport_nev, csapatok) VALUES (?, ?)";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../admin.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ss", $csoport_nev, $csapatok_str);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../admin.php?error=none");
	exit();
}

function csoportTorlese($conn, $id) {
	$sql = "DELETE FROM csoportok WHERE id = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../admin.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../admin.php?error=none");
	exit();
}