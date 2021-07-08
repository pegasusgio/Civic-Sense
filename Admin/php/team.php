<?php
$conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

$sql = mysqli_query($conn, "SELECT * FROM team");

// output data of each row
while ($row = mysqli_fetch_assoc($sql)) {
    echo "
		<tr>
                <td>" . filter_var($row['codice'], FILTER_SANITIZE_NUMBER_INT) . " </td>
                
                <td>" . filter_var($row['email_t'], FILTER_SANITIZE_EMAIL) . "</td> 
                
              <td>" . filter_var($row['nomi'], FILTER_SANITIZE_STRING) . "</td>
               
          </tr> ";
}
