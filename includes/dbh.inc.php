<?php
#detalii baza de date
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "writist_2";

#conectare
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

#mesaj in caz de eroare
if (!$conn) {
    die("Connection failed:" . mysqli_connect_error());
}
