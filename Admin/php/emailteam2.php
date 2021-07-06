
<?php

$conn = mysql_connect ("localhost", "root", "") or die ("Connessione non riuscita"); 

mysql_select_db ("civicsense") or die ("DataBase non trovato"); 


$id = $_POST['id'];
$team = $_POST['team'];


if ($id && $team !== null) {

  $query = "SELECT email_t FROM team WHERE codice = ?"; 
  $stmt = $conn->prepare($query);
  $stmt->bind_param('s',$team);
  $result = $stmt->execute();

  if ($result){

    echo('<a href="mailto: '.$result.'"><center> Clicca qui per mandare un avviso al team. </center></a>');
  }
}
?>