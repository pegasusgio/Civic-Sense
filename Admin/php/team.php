<?php
$conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

$sql = mysqli_query($conn, "SELECT * FROM team");


// output data of each row
while ($row = mysqli_fetch_assoc($sql)) {
    echo "
		<tr>
                <td>" . $row['codice'] . " </td>
                
                <td>" . $row['email_t'] . "</td> 
                
              <td>" . $row['nomi'] . "</td>
               
          </tr> ";
}
