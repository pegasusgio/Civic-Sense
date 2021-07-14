<?php

$conn = new mysqli("localhost", "root", "", "civicsense");

$upload_path = 'jpeg/';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$filename = $_FILES['image']['name'];
	$filetype = $_FILES['image']['type'];
	$filetmp_name = filter_var($_FILES['image']['tmp_name'], FILTER_SANITIZE_STRING);

	//check if the type is image
	if (str_contains($filetype, "image")) {

		//save the extension
		$ext = pathinfo($filename, PATHINFO_EXTENSION);

		//remove the extension
		$without_extension = pathinfo($str, PATHINFO_FILENAME);

		//clean the name
		$cleaned_file = preg_replace("/[^a-zA-Z0-9]+/", "", $without_extension);

		//add the extension
		$cleaned_file = $cleaned_file . "." . $ext;
		$file_path = $upload_path . $cleaned_file;
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
			if (move_uploaded_file($filetmp_name, $file_path)) {
				$query = "INSERT INTO `segnalazioni`(`datainv`, `orainv`, `via`, `descrizione`, `foto`, `email`,`tipo`,`latitudine`,`longitudine`) 
						VALUES (CURRENT_DATE,CURRENT_TIME,'?','?','{?}','?','?','?','?')";
				$stmt = $conn->prepare($query);
				$stmt->bind_param('sssssss', $via, $descrizione, $filename, $email, $tipo, $lat, $lng);
				$result = $stmt->execute();
				if ($result) {
					echo "Inserimento dei dati completato";
				} else {
					echo "Errore nell'inserimento dei dati";
				}
			} else {
				echo "Errore nell'inserimento dei dati";
			}
		} catch (Exception $e) {
			$e->getMessage();
		}
	}
	$conn->close();
}
