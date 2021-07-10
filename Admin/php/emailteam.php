<?php

use Exception as GlobalException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

$id = (isset($_POST['id'])) ? $_POST['id'] : null;
$team = (isset($_POST['team'])) ? $_POST['team'] : null;

if (isset($_POST['submit'])) {

	if ($id && $team !== null) {

		$result = mysqli_query($conn, "SELECT * FROM segnalazioni WHERE gravita IS NOT NULL AND team IS NULL");
		if ($result) {
			$row = mysqli_fetch_assoc($result);

			if ($id == $row['id']) {

				$query = ("UPDATE segnalazioni SET team = ?, stato = 'In attesa' WHERE id = ?");
				$stmt = $conn->prepare($query);
				$stmt->bind_param('ss', $team, $id);
				$result_query = $stmt->execute();

				if ($result_query) {

					echo ('<center><b>Aggiornamento avvenuto con successo.</b></center>');

					try {
						$query1 = ("SELECT * FROM team WHERE codice = ?");
						$stmt1 = $conn->prepare($query1);
						$stmt1->bind_param('s', $team);
						$result_query1 = $stmt1->execute();

						if ($result_query1) {

							$result1 = $stmt1->get_result();
							$row1 = mysqli_fetch_assoc($result1);

							$var = parse_ini_file("config.ini");

							$mail = new PHPMailer();

							$mail->SMTPAuth   = true;                  // sblocchi SMTP 
							$mail->SMTPSecure = "ssl";                 // metti prefisso per il server
							$mail->Host       = "smtp.gmail.com";      // metti il tuo domino es(gmail) 
							$mail->Port       = 465;   				// inserisci la porta smtp per il server DOMINIO
							$mail->SMTPKeepAlive = true;
							$mail->Mailer = "smtp";
							$mail->Username   = $_SESSION['email'];
							$mail->Password   = openssl_decrypt($_SESSION['password'], "AES-128-ECB", $var['SECRETKEY']);
							$mail->AddAddress($row1["email_t"]);
							$mail->SetFrom(openssl_decrypt($_SESSION['password'], "AES-128-ECB", $var['SECRETKEY']));
							$mail->Subject = 'Nuova Segnalazione';
							$mail->Body = "Salve team " . $row1['codice'] . ", vi e' stata incaricata una nuova segnalazione da risolvere."; //Messaggio da inviare
							$mail->Send();
							echo "<center><b>Messaggio inviato.</b></center>";
						}
					} catch (Exception $e) {
						echo $e->errorMessage(); //Errori da PHPMailer
					} catch (GlobalException $e) {
						echo $e->getMessage(); //Errori da altrove
					}
				}
			} else {
				echo "<center><b>Inserisci un id esistente. </b></center>";
			}
		}
	} else {
		echo "<center><b>Inserire tutti i campi.</b></center>";
	}
}
