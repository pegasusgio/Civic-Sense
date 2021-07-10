<?php

$id = $_GET['id'];
// do some validation here to ensure id is safe

$conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");
$query = "SELECT foto FROM segnalazioni WHERE id=3";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
mysqli_close($link);

header("Content-type: image/jpg");
echo $row['foto'];
