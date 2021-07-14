<?php

$conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

mysqli_select_db($conn, "civicsense") or die("DataBase non trovato"); #connessione al db

$query = mysqli_query($conn, "SELECT * FROM segnalazioni WHERE tipo = '4' ");

while ($row = mysqli_fetch_assoc($query)) {
  echo "
    <tr>
     
                <td>" . filter_var($row['id'], FILTER_SANITIZE_NUMBER_INT) . " <br></td>
                
                <td>" . filter_var($row['datainv'], FILTER_SANITIZE_STRING) . " <br></td> 
                
              <td>" . filter_var($row['orainv'], FILTER_SANITIZE_STRING) . "<br></td>

               <td>" . filter_var($row['via'], FILTER_SANITIZE_STRING) . "<br></td>

                <td>" . filter_var($row['descrizione'], FILTER_SANITIZE_STRING) . "<br></td>

                 <td><img width='200' height='200' src=data:image/jpeg;base64," . filter_var(base64_encode($row['foto']), FILTER_SANITIZE_STRING) . "><br></td>

                  <td>" . filter_var($row['email'], FILTER_SANITIZE_EMAIL) . "<br></td>

                   <td>" . filter_var($row['stato'], FILTER_SANITIZE_STRING) . "<br></td>

                    <td>" . filter_var($row['team'], FILTER_SANITIZE_NUMBER_INT) . "<br></td>

                   <td>" . filter_var($row['gravita'], FILTER_SANITIZE_NUMBER_INT) . "<br></td>
               
          </tr> ";
}
