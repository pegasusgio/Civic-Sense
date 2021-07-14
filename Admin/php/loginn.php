<?php

//Recupero dati
if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$query = "SELECT * FROM admin where email = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param('s', $email);
	$result_query = $stmt->execute();

	if ($result_query) {
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();

		if (mysqli_num_rows($result) > 0) {
			$var = parse_ini_file("config.ini");

			if ($password == openssl_decrypt($row['password'], "AES-128-ECB", $var['SECRETKEY'])) {
				echo 'Accesso consentito alla sezione riservata';
				echo '<script>window.location.href = "index.php";</script>';
			} else {
				echo "Accesso negato alla sezione riservata. La password e' errata!";
			}
		} else {
			echo "Non esiste un account admin con queste credenziali.";
		}
	} else {
		//Connessione Database
		$conn = mysqli_connect($var['path'], $var['username'], $var['db_pwd']) or die("Connessione non riuscita");
		mysqli_select_db($conn, $var['db']) or die("Database non trovato"); #connessione al db


		$query = "SELECT * FROM team WHERE email_t = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param('s', $email);
		$result_query = $stmt->execute();

		if ($result_query) {
			if (mysqli_num_rows($result) > 0) {
				$result = $stmt->get_result();
				while ($row = mysqli_fetch_assoc($result)) {
					if ($password != $row["password"] || $email != $row["email_t"]) {
						//CODICE JAVASCRIPT
						echo "ATTENZIONE: La password o la email inserita non e' corretta!";
					} else if ($password == $row["password"] || $email == $row["email_t"]) {
						echo 'Accesso consentito area riservata (TEAM)';
					}
				}
			}
		}
		mysqli_close($conn);
	}
} else {
	echo 'Non esistono;';
}
