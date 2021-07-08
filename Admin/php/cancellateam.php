<?php

$conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

$cod = (isset($_POST['cod'])) ? $_POST['cod'] : null;

if (isset($_POST['submit2'])) {

	if ($cod == null) {
		echo ("<p> <center> <font color=black font face='Courier'> Compila tutti i campi.</center></p>");
	} elseif ($cod !== null) {
		$query = "SELECT * FROM team WHERE codice = '?'";
		$stmt = $conn->prepare($query);
		$stmt->bind_param('s', $cod);
		$resultC = $stmt->execute();

		if ($resultC) {
			$result = $stmt->get_result();
			$row = mysqli_fetch_assoc($result);
			if ($cod == $row['codice']) {
				$query = "DELETE FROM team WHERE codice = '?'";
				$stmt = $conn->prepare($query);
				$stmt->bind_param('s', $cod);
				$result = $stmt->execute();

				if ($query) { /* the control should be done on result and not on query */
					echo ("<br><b><br><p> <center> <font color=black font face='Courier'> Aggiornamento avvenuto correttamente. Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br> ");
				}
			} else {
				echo ("<p> <center> <font color=black font face='Courier'> Inserisci ID esistente.</center></p>");
			}
		}
	}
}
