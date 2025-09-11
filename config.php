<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "helphub";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Échec connexion : " . $conn->connect_error);
}
?>