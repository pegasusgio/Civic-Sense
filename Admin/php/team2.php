<?php

$conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

$query = mysqli_query($conn, "SELECT * FROM segnalazioni WHERE gravita IS NOT NULL AND team IS NULL");

if (mysqli_num_rows($query) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($query)) {
        echo "
    <tr>
     
                <td>" . filter_var($row['id'], FILTER_SANITIZE_NUMBER_INT) . " <br></td>
                
                <td>" . filter_var($row['via'], FILTER_SANITIZE_STRING) . " <br></td> 
                
              <td>" . filter_var($row['gravita'], FILTER_SANITIZE_STRING) . "<br></td>
			  
			    <td>" . filter_var($row['tipo'], FILTER_SANITIZE_NUMBER_INT) . "<br></td>
               
          </tr> ";
    }
}
