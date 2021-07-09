<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Tables</title>

  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <!-- grafico -->
  <link rel="stylesheet" href="css/graficostyle.css">


</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href=""> Area riservata</a>


    <!-- INIZIO LOGOUT -->

    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" title="Logout" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="login.html" data-toggle="modal" data-target="#logoutModal"> Logout </a>
          </div>
        </li>
      </ul>
    </form>
  </nav>

  <!-- finestra avviso-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sei sicuro di voler lasciare il sito?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Clicca "Logout" per uscire dal sito.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulla</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- FINE LOGOUT-->


  <div id="wrapper">

    <div class="card mb-3">


      <!-- MAPPA -->

      <style>
        #map {
          height: 500px;
          width: 100%;
          margin-left: 0%;
        }

        * {
          margin: 0;
          padding: 0;
        }
      </style>


      <div id="map"></div>

      <script>
        function initMap() {
          var location = new google.maps.LatLng(40.382003, 17.367155);
          var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 18,
            center: location
          });
          <?php
          $conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione fallita");

          if (isset($_SESSION['idT'])) {
            $query = "SELECT * FROM segnalazioni WHERE team = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $_SESSION['idT']);
            $result_query = $stmt->execute();
            if ($result_query) {
              $result = $stmt->get_result();
              while ($row = mysqli_fetch_assoc($result)) {
                echo "
            var location = new google.maps.LatLng(" . filter_var($row['latitudine'], FILTER_SANITIZE_NUMBER_FLOAT) . "," . filter_var($row['longitudine'], FILTER_SANITIZE_NUMBER_FLOAT) . ");
            var marker = new google.maps.Marker({
              map: map,
              position: location
            }); ";
              }
              mysqli_close($conn);
            }
          }
          ?>
          /*var marker = new google.maps.Marker({
                  map: map,
                  position: location
              });
          var marker1 = new google.maps.Marker({
            map: map,
            position: location1
          });*/

        }
      </script>


      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7GIu4drL85xcaTdq8hAtRzVWjbKxs3NQ&callback=initMap">
      </script>





      <!-- FINE MAPPA -->






      <br><br><br>

      <div class="card-header">
        <i class="fas fa-table"></i>
        Tabella Segnalazioni da risolvere
      </div>
      <br><br>
      <div class="card-body">
        <!-- Tabella -->
        <div class="table-responsive" style="overflow-x: scroll;">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>CODICE SEGNALAZIONE</th>
                <th>DATA</th>
                <th>ORA</th>
                <th>VIA</th>
                <th>DESCRIZIONE</th>
                <th>FOTO</th>
                <th>TIPO</th>
                <th>STATO</th>
                <th>GRAVITA'</th>
              </tr>
            </thead>

            <?php include("php/segnalazione.php"); ?>


          </table>








          <!-- MODIFICA STATO SEGNALAZIONE -->

          <!-- inserimento da form del codice della segnalazione da modificare -->
          <br><br><br>

          <div class="card-header">
            <i class="fas fa-table"></i>
            Modifica stato di una segnalazione
          </div>

          <form method="post" action="modifiche.php" style=" margin-top:5%; margin-left:5%">
            <b>CODICE SEGNALAZIONE DA MODIFICARE: <input type="text" name="id"><br><br></b>
            <b> INSERISCI LO STATO MODIFICATO: </b> <select class="text" name="stato">

              <option value="Risolto">Risolto</option>
              <option value="In risoluzione">In risoluzione</option>

              <input type="submit" class="btn btn-primary btn-block" style="width:15%; margin-top:5%;">

          </form>

          <br><br><br>


          <br><br>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>












</body>

</html>