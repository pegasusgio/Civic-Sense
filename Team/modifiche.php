<?php
session_start();
//puoi modificare la pagina per farla funzionare nella tua macchina
//adatto a tutti i domini (GMAIL,LIBERO.HOTMAIL)
//classi per l'invio dell'email (PHPMailer 5.2)


use Exception as GlobalException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$conn = new mysqli("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

if (isset($_POST['id']) && isset($_POST['stato'])) {
	$idS = $_POST['id'];
	$stato = $_POST['stato'];
	$email = $_SESSION['email'];
	$pass = $_SESSION['pass'];

	$query = "SELECT * FROM segnalazioni WHERE id = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param('s', $idS);
	$result_query = $stmt->execute();

	if ($result_query) {
		//da team a ente e utente
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();

		if ($row['stato'] == "In attesa" && $stato == "In risoluzione") { //confronta stato attuale e quello da modificare
			$query1 = "UPDATE segnalazioni SET stato = ? WHERE id = ?"; //esegui l'aggiornamento
			$stmt1 = $conn->prepare($query1);
			$stmt1->bind_param('ss', $stato, $idS);
			$result_query1 = $stmt1->execute();

			if ($result_query1) {
				echo ("<br><b><br><p> <center> <font color=black font face='Courier'> Aggiornamento avvenuto correttamente. Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br> ");
				$mail = new PHPMailer(true);

				try {
					$mail->SMTPAuth   = true;                  // sblocchi SMTP 
					$mail->SMTPSecure = "ssl";                 // metti prefisso per il server
					$mail->Host       = "smtp.gmail.com";      // metti il tuo domino es(gmail) 
					$mail->Port       = 465;   				// inserisci la porta smtp per il server DOMINIO
					$mail->SMTPKeepAlive = true;
					$mail->Mailer = "smtp";
					$mail->Username   = "$email";
					$mail->Password   = "$pass";
					$mail->AddAddress("civicsense2019@gmail.com");
					$mail->AddAddress($row['email']);
					$mail->SetFrom("$email");
					$mail->Subject = 'Nuova Segnalazione';
					$mail->Body = "La segnalazione è arrivata ed stiamo lavorando per risolverla"; //Messaggio da inviare
					$mail->Send();
					echo "Message Sent OK";
					header("location: http://localhost/Civic-Sense/Team/index.php");
				} catch (Exception $e) {
					echo $e->errorMessage(); //Errori da PHPMailer
				} catch (GlobalException $e) {
					echo $e->getMessage(); //Errori da altrove
				}
			}
		}
		//da team a ente e utente
		else if ($row['stato'] == "In risoluzione" && $stato == "Risolto") {
			$query2 = "UPDATE segnalazioni SET stato = ? WHERE id = ?"; //esegui l'aggiornamento
			$stmt2 = $conn->prepare($query2);
			$stmt2->bind_param('ss', $stato, $idS);
			$result_query2 = $stmt2->execute();

			if ($result_query2) {
				echo ("<br><b><br><p> <center> <font color=black font face='Courier'> Aggiornamento avvenuto correttamente. Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br> ");
				$mail = new PHPMailer(true);

				try {
					$mail->SMTPAuth   = true;                  // sblocchi SMTP 
					$mail->SMTPSecure = "ssl";                 // metti prefisso per il server
					$mail->Host       = "smtp.gmail.com";      // metti il tuo domino es(gmail) 
					$mail->Port       = 465;   				// inserisci la porta smtp per il server DOMINIO
					$mail->SMTPKeepAlive = true;
					$mail->Mailer = "smtp";
					$mail->Username   = "$email";
					$mail->Password   = "$pass";
					$mail->AddAddress("civicsense2019@gmail.com");
					$mail->AddAddress($row['email']);
					$mail->SetFrom("$email");
					$mail->Subject = "Segnalazione risolta";
					$mail->Body = "Il problema presente in " . $row['via'] . " è stata risolta"; //Messaggio da inviare
					$mail->Send();
					header("location: http://localhost/Civic-Sense/Team/index.php");
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
