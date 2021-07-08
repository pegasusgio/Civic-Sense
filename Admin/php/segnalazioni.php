<?php
$conn = mysqli_connect("localhost", "root", "") or die("Connessione non riuscita");

mysqli_select_db($conn, "civicsense") or die("DataBase non trovato"); #connessione al db

$query = mysqli_query($conn, "SELECT * FROM segnalazioni");


while ($row = mysqli_fetch_assoc($query)) {
  echo "
    <tr>
     
                <td>" . $row['id'] . " <br></td>
                
                <td>" . $row['datainv'] . " <br></td> 
                
              <td>" . $row['orainv'] . "<br></td>

               <td>" . $row['via'] . "<br></td>

                <td>" . $row['descrizione'] . "<br></td>

                 <td>" . $row['foto'] . "<br></td>

                  <td>" . $row['email'] . "<br></td>

                   <td>" . $row['stato'] . "<br></td>

                    <td>" . $row['team'] . "<br></td>

                   <td>" . $row["gravita'"] . "<br></td>
               
          </tr> ";
}
