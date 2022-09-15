<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "non-stop";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);
$mysqli = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}