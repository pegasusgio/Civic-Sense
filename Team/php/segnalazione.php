<?php
$conn = mysqli_connect("localhost", "root", "") or die("Connessione non riuscita");

mysqli_select_db($conn, "civicsense") or die("DataBase non trovato"); #connessione al db

if (isset($_SESSION['idT'])) {
  $upload_path = '../Admin/img/';


  $team = (isset($_POST['team'])) ? $_POST['team'] : null;



  $query = "SELECT * FROM segnalazioni WHERE stato  <> 'Risolto' AND team = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('s', $_SESSION['idT']);
  $result_query = $stmt->execute();
  if ($result_query) {
    $result = $stmt->get_result();
    while ($row = mysqli_fetch_assoc($result)) {
      echo "
      <tr>
       
                  <td>" . filter_var($row['id'], FILTER_SANITIZE_NUMBER_INT) . " <br></td>
                  
                  <td>" . filter_var($row['datainv'], FILTER_SANITIZE_STRING) . " <br></td> 
                  
                <td>" . filter_var($row['orainv'], FILTER_SANITIZE_STRING) . "<br></td>
  
                 <td>" . filter_var($row['via'], FILTER_SANITIZE_STRING) . "<br></td>
  
                  <td>" . filter_var($row['descrizione'], FILTER_SANITIZE_STRING) . "<br></td>
  
                   <td><img width='200px' height='200px' src=" . $upload_path . filter_var($row['foto'], FILTER_SANITIZE_STRING) . "><br></td>
            
             <td>" . filter_var($row['tipo'], FILTER_SANITIZE_NUMBER_INT) . "<br></td>
  
                     <td>" . filter_var($row['stato'], FILTER_SANITIZE_STRING) . "<br></td>
  
                     <td>" . filter_var($row['gravita'], FILTER_SANITIZE_NUMBER_INT) . "<br></td>
                 
            </tr> ";
    }
  }
}
