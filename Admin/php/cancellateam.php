<?php

$conn = mysqli_connect ("localhost", "root", "","civicsense") or die ("Connessione non riuscita"); 

$cod = (isset($_POST['cod'])) ? $_POST['cod'] : null;

if (isset($_POST['submit2'])){   

if ($cod == null) {
echo ("<p> <center> <font color=black font face='Courier'> Compila tutti i campi.</center></p>");
}
elseif ($cod !== null){
	$resultC = mysqli_query($conn,"SELECT * FROM team WHERE codice =' $cod'");
	if($resultC){
		$row = mysqli_fetch_assoc($resultC);
		if($cod == $row['codice']){
			$query = "DELETE FROM team WHERE codice = '$cod'";

			$result = mysqli_query($conn,$query);	

			if($query){
				echo("<br><b><br><p> <center> <font color=black font face='Courier'> Aggiornamento avvenuto correttamente. Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br> ");
			} 
		}else{
			echo ("<p> <center> <font color=black font face='Courier'> Inserisci ID esistente.</center></p>");
		}
	}
}
}


?>