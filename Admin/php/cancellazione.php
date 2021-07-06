<?php

$conn = mysql_connect ("localhost", "root", "") or die ("Connessione non riuscita"); 

mysql_select_db ("civicsense") or die ("DataBase non trovato"); 


$id = (isset($_POST['id'])) ? $_POST['id'] : null;
$stato = (isset($_POST['stato'])) ? $_POST['stato'] : null;


if ($id && $stato !== null) {


 $query = "UPDATE segnalazioni SET stato = '$stato' WHERE id = '$id'";

$result = mysql_query($query);	

if($result){
	echo("<br><b><br><p> <center> <font color=black font face='Courier'> Inserimento avvenuto correttamente! Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br> ");
} 
}

?>
	