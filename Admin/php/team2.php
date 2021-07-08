<?php
$conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

$query = mysqli_query($conn, "SELECT * FROM segnalazioni WHERE gravita IS NOT NULL AND team IS NULL");

if (mysqli_num_rows($query) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($query)) {
        echo "
    <tr>
     
                <td>" . $row['id'] . " <br></td>
                
                <td>" . $row['via'] . " <br></td> 
                
              <td>" . $row['gravita'] . "<br></td>
			  
			    <td>" . $row['tipo'] . "<br></td>
               
          </tr> ";
    }
}
