<?php
$conn = new mysqli("localhost", "root", "", "civicsense");

$upload_path = 'jpeg/';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$file_path = $upload_path . $_FILES['image']['name'];
	$img_name = $_FILES['image']['name'];
	$email = $_POST['email'];
	$tipo = $_POST['tipo'];
	if ($tipo == "Segnalazione di area verde") {
		$tipo = 1;
	} else if ($tipo == "Rifiuti e pulizia stradale") {
		$tipo = 2;
	} else if ($tipo == "Strade e marciapiedi") {
		$tipo = 3;
	} else if ($tipo == "Segnaletica e semafori") {
		$tipo = 4;
	} else if ($tipo == "Illuminazione pubblica") {
		$tipo = 5;
	}
	$via = $_POST['via'];
	$descrizione = $_POST['descrizione'];
	$lat = $_POST['latitudine'];
	$lat = floatval($lat);
	$lng = $_POST['longitudine'];
	$lng = floatval($lng);


	try {
		move_uploaded_file($_FILES['image']['tmp_name'], $file_path);
		$query = "INSERT INTO `segnalazioni`(`datainv`, `orainv`, `via`, `descrizione`, `foto`, `email`,`tipo`,`latitudine`,`longitudine`) 
			VALUES (CURRENT_DATE,CURRENT_TIME,'?','?','{?}','?','?','?','?')";
		$stmt = $conn->prepare($query);
		$stmt->bind_param('sssssss', $via, $descrizione, $img_name, $email, $tipo, $lat, $lng);
		$result = $stmt->execute();
		if ($result) {
			echo "Inserimento dei dati completato";
		} else {
			echo "Errore nell'inserimento dei dati";
		}
	} catch (Exception $e) {
		$e->getMessage();
	}
	$conn->close();
}
