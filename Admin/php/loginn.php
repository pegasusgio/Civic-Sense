<?php
	//Recupero dati
	if(isset($_POST['email']) && isset($_POST['password'])){
		$email = $_POST['email'];
		$password = $_POST['password'];
		if($email == "civicsense18@gmail.com")
		{
			if($password == "admin")
			{
				echo 'Accesso consentito alla sezione riservata';
			}
			else
			{
				echo 'Accesso negato alla sezione riservata.La password � errata!';
			}
		}
		else
		{
			//Connessione Database
			$conn = mysql_connect ("localhost", "root", "") or die ("Connessione non riuscita"); 
	        mysql_select_db ("civicsense") or die ("DataBase non trovato"); #connessione al db


			$query = "SELECT * FROM team WHERE email_t = ?";
			$stmt = $conn->prepare($query);
			$stmt->bind_param('s',$email);
			$result = $stmt->execute();	

			if (mysql_num_rows($result) > 0) {
	   
	    		while($row = mysql_fetch_assoc($result)) 
				{
					if($password != $row["password"] || $email != $row["email_t"])
					{
						//CODICE JAVASCRIPT
						echo 'ATTENZIONE: La password o la email inserita non � corretta!';
					}
					else if ($password == $row["password"] || $email == $row["email_t"]){
						echo 'Accesso consentito area riservata (TEAM)';
					}
			
				}
			}
			mysql_close($conn);
		}
	}
	else{
		echo 'Non esistono;';
	}
	
	
		
?>