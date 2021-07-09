<?php
session_start();
//puoi modificare la pagina per farla funzionare nella tua macchina
//adatto a tutti i domini (GMAIL,LIBERO.HOTMAIL)
//classi per l'invio dell'email (PHPMailer 5.2)

use Exception as GlobalException;
use FFI\Exception as FFIException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

if (isset($_POST['id']) && isset($_POST['stato']) && isset($_POST['codice'])) {
	$id = $_POST['id'];
	$stato = $_POST['stato'];
	$codice = $_POST['codice'];

	$query = "SELECT * FROM segnalazioni WHERE id = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param('s', $id);
	$result_query = $stmt->execute();

	if ($result_query) {
		//da ente a team
		$result = $stmt->get_result();
		$row = mysqli_fetch_assoc($result);

		if ($row['stato'] == "In attesa" && $stato == "In risoluzione") { //confronta stato attuale e quello da modificare
			$query2 = "UPDATE segnalazioni SET stato = ? WHERE id = ?"; //esegui l'aggiornamento
			$stmt2 = $conn->prepare($query2);
			$stmt2->bind_param('ss', $stato, $codice);
			$result_query2 = $stmt2->execute();

			if ($result_query2) {
				echo ("<br><b><br><p> <center> <font color=black font face='Courier'> Aggiornamento avvenuto correttamente. Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br> ");

				$query3 = "SELECT * FROM team WHERE id = ?";
				$stmt3 = $conn->prepare($query2);
				$stmt3->bind_param('s', $idSS);
				$result_query3 = $stmt3->execute();

				if ($result_query3) {
					$result3 = $stmt3->get_result();
					$row1 = mysqli_fetch_assoc($result2);

					$var = parse_ini_file("config.ini");

					$mail = new PHPMailer(true);

					try {
						$mail->SMTPAuth   = true;                  // sblocchi SMTP 
						$mail->SMTPSecure = "ssl";                 // metti prefisso per il server
						$mail->Host       = "smtp.gmail.com";      // metti il tuo domino es(gmail) 
						$mail->Port       = 465;   				// inserisci la porta smtp per il server DOMINIO
						$mail->SMTPKeepAlive = true;
						$mail->Mailer = "smtp";
						$mail->Username   = $row1['email'];
						$mail->Password   = openssl_decrypt($row1['password'], "AES-128-ECB", $var['SECRETKEY']);
						$mail->AddAddress($_SESSION['email']);
						$mail->SetFrom($row1['email']);
						$mail->Subject = 'Nuova Segnalazione';
						$mail->Body = "Salve team " . $row['codice'] . ", ci è arrivata una nuova segnalazione e vi affido il compito di risoverla"; //Messaggio da inviare
						$mail->Send();
						echo "Message Sent OK";
					} catch (Exception $e) {
						echo $e->errorMessage(); //Errori da PHPMailer
					} catch (GlobalException $e) {
						echo $e->getMessage(); //Errori da altrove
					}
				}
			}
		}
		//da team a ente e utente
		else if ($row['stato'] == "In risoluzione" && $stato == "Risolto") {
			$sql = "UPDATE segnalazioni SET stato = '$stato' WHERE id = $id";
			if ($query) {
				echo ("<br><b><br><p> <center> <font color=black font face='Courier'> Aggiornamento avvenuto correttamente. Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br> ");
				$mail = new PHPMailer(true);

				try {
					$mail->SMTPAuth   = true;                  // sblocchi SMTP 
					$mail->SMTPSecure = "ssl";                 // metti prefisso per il server
					$mail->Host       = "smtp.gmail.com";      // metti il tuo domino es(gmail) 
					$mail->Port       = 465;   				// inserisci la porta smtp per il server DOMINIO
					$mail->SMTPKeepAlive = true;
					$mail->Mailer = "smtp";
					$mail->Username   = $_SESSION['email'];
					$mail->Password   = $_SESSION['pass'];
					$mail->AddAddress($row['email_t']); //ente
					$mail->AddAddress($row['email']); //utente
					$mail->SetFrom($_SESSION['email']);
					$mail->Subject = "Segnalazione risolta";
					$mail->Body = "Il problema presente in " + $row['via'] + " è stata risolta"; //Messaggio da inviare
					$mail->Send();
					echo "Message Sent OK";
				} catch (Exception $e) {
					echo $e->errorMessage(); //Errori da PHPMailer
				} catch (GlobalException $e) {
					echo $e->getMessage(); //Errori da altrove
				}
			}
		} else {
			echo "Operazione non disponibile";
		}
	}
	mysqli_close($conn);
}
