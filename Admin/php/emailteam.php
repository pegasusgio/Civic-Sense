<?php
require ('C:\xampp\htdocs\Ingegneria\Admin\phpmailer\class.phpmailer.php');
include('C:\xampp\htdocs\Ingegneria\Admin\phpmailer\class.smtp.php');
$conn = mysqli_connect ("localhost", "root", "","civicsense") or die ("Connessione non riuscita"); 

$id = (isset($_POST['id'])) ? $_POST['id'] : null;
$team =(isset($_POST['team'])) ? $_POST['team'] : null;


if (isset($_POST['submit'])){   

if ($id && $team !== null) {

	$resultC = mysqli_query ($conn,"SELECT * FROM segnalazioni WHERE gravita IS NOT NULL AND team IS NULL");
	if($resultC){
		$row = mysqli_fetch_assoc($resultC);
		if($id == $row['id']){
			$query = ( "UPDATE segnalazioni SET team = '$team', stato = 'In attesa' WHERE id = '$id' ");
			
			$result = mysqli_query($conn,$query);	
			if ($result){

				echo('<center><b>Aggiornamento avvenuto con successo.</b></center>');
				$mail = new PHPMailer();
				
				try {
					$query1 = ("SELECT * FROM team WHERE codice = $team");
					$result1 = mysqli_query($conn,$query1);	
					if($result1){
						$row = mysqli_fetch_assoc($result1);
						$mail->SMTPAuth   = true;                  // sblocchi SMTP 
						$mail->SMTPSecure = "ssl";                 // metti prefisso per il server
						$mail->Host       = "smtp.gmail.com";      // metti il tuo domino es(gmail) 
						$mail->Port       = 465;   				// inserisci la porta smtp per il server DOMINIO
						$mail->SMTPKeepAlive = true;
						$mail->Mailer = "smtp";
						$mail->Username   = "civicsense2019@gmail.com";     // DOMINIO username
						$mail->Password   = "c1v1csense2019";            // DOMINIO password
						$mail->AddAddress($row["email_t"]);
						$mail->SetFrom("civicsense2019@gmail.com");
						$mail->Subject = 'Nuova Segnalazione';
						$mail->Body = "Salve team$team, vi e' stata incaricata una nuova segnalazione da risolvere."; //Messaggio da inviare
						$mail->Send();
						echo "<center><b>Messaggio inviato.</b></center>";
					}
				} catch (phpmailerException $e) {
					echo $e->errorMessage(); //Errori da PHPMailer
				} catch (Exception $e) {
					echo $e->getMessage(); //Errori da altrove
				}
			}	
		}else{
			echo "<center><b>Inserisci un id esistente. </b></center>"; 
		}
	}
	

	
}
else {
	echo "<center><b>Inserire tutti i campi.</b></center>";
}
}

?>