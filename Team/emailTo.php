<?php session_start();
//puoi modificare la pagina per farla funzionare nella tua macchina
//adatto a tutti i domini (GMAIL,LIBERO.HOTMAIL)
//classi per l'invio dell'email (PHPMailer 6.5.0)

use Exception as GlobalException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$conn = new mysqli("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

if (isset($_POST['id']) && isset($_POST['stato'])) {
	$idS = $_POST['id'];
	$stato = $_POST['stato'];
	$email = $_SESSION['email'];
	$pass = $_SESSION['password'];

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
			$stmt1 = $conn->prepare($query);
			$stmt1->bind_param('ss', $stato, $idS);
			$result_query1 = $stmt1->execute();

			if ($result_query1) {
				echo ("<br><b><br><p> <center> <font color=black font face='Courier'> Aggiornamento avvenuto correttamente. Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br> ");

				$query2 = "SELECT * FROM admin";
				$stmt2 = $conn->prepare($query);
				$result_query2 = $stmt2->execute();

				if ($result_query2) {
					$result2 = $stmt2->get_result();

					$mail = new PHPMailer(true);

					try {
						$mail->SMTPAuth   = true;                  // sblocchi SMTP 
						$mail->SMTPSecure = "ssl";                 // metti prefisso per il server
						$mail->Host       = "smtp.gmail.com";      // metti il tuo domino es(gmail) 
						$mail->Port       = 465;   				// inserisci la porta smtp per il server DOMINIO
						$mail->SMTPKeepAlive = true;
						$mail->Mailer = "smtp";
						$mail->Username   = $_SESSION['email'];
						$mail->Password   = $_SESSION['password'];
						while ($row2 = mysqli_fetch_assoc($result2)) { // aggiunge tutti gli indirizzi email degli enti
							$mail->AddAddress($row2['email']);
						}
						$mail->AddAddress($row['email']);
						$mail->SetFrom($_SESSION['email']);
						$mail->Subject = 'Nuova Segnalazione';
						$mail->Body = "La segnalazione è arrivata e stiamo lavorando per risolverla"; //Messaggio da inviare
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
		}
		//da team a ente e utente
		else if ($row['stato'] == "In risoluzione" && $stato == "Risolto") {
			$query3 = "UPDATE segnalazioni SET stato = ? WHERE id = ?"; //esegui l'aggiornamento
			$stmt3 = $conn->prepare($query);
			$stmt3->bind_param('ss', $stato, $idS);
			$result_query3 = $stmt3->execute();

			if ($result_query3) {
				echo ("<br><b><br><p> <center> <font color=black font face='Courier'> Aggiornamento avvenuto correttamente. Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br> ");

				$query4 = "SELECT * FROM admin";
				$stmt4 = $conn->prepare($query);
				$result_query4 = $stmt4->execute();

				if ($result_query4) {
					$result4 = $stmt4->get_result();

					$mail = new PHPMailer(true);

					try {
						$mail->SMTPAuth   = true;                  // sblocchi SMTP 
						$mail->SMTPSecure = "ssl";                 // metti prefisso per il server
						$mail->Host       = "smtp.gmail.com";      // metti il tuo domino es(gmail) 
						$mail->Port       = 465;   				// inserisci la porta smtp per il server DOMINIO
						$mail->SMTPKeepAlive = true;
						$mail->Mailer = "smtp";
						$mail->Username   = $_SESSION['email'];
						$mail->Password   = $_SESSION['password'];
						while ($row4 = mysqli_fetch_assoc($result4)) {
							$mail->AddAddress($row4['email']); //ente
						}
						$mail->AddAddress($row['email']);
						$mail->SetFrom($_SESSION['email']);
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
			}
		} else {
			echo "Operazione non disponibile";
		}
	}
	mysqli_close($conn);
}
