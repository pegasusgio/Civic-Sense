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

    <a class="navbar-brand mr-1" href="" style="  "> Area riservata</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
    <div class="titolo"> <b>SEGNALAZIONI AREE VERDI </b> </a>

      <style>
        .titolo {
          font-size: 30px;
          color: white;
          margin-left: 30%;
        }
      </style>
    </div>

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



    <!-- INIZIO SIDEBAR -->

    <ul class="sidebar navbar-nav" style="  ">
      <br>
      <li class="nav-item dropdown">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Home</span>
        </a>
      </li>


      <li class="nav-item active">
        <a class="nav-link dropdown-toggle" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Segnalazioni</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="segnalazionii.php">
            <center><b>INDICE SEGNALAZIONI</b></center>
          </a>
          <a class="dropdown-item" href="segnalazioniverde.php" style=" background-color:orange;"> <b> Segnalazione su aree verdi</b></a>
          <a class="dropdown-item" href="segnalazionirifiuti.php">Rifiuti e pulizia stradale</a>
          <a class="dropdown-item" href="segnalazionistrade.php">Strade e marciapiedi</a>
          <a class="dropdown-item" href="segnalazionisemafori.php">Segnaletica e semafori</a>
          <a class="dropdown-item" href="segnalazioniilluminazione.php">Illuminazione pubblica</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link " href="team.php">
          <i class="fas fa-fw fa-folder"></i>
          <span>Team</span>
        </a>
    </ul>

    <!-- FINE SIDEBAR -->



    <div class="card mb-3" style="">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Tabella Segnalazioni
      </div>
      <div class="card-body">

        <!-- MAPPA -->

        <style>
          #map {
            height: 500px;
            width: 100%;
          }

          * {
            margin: 0;
            padding: 0;
          }
        </style>
        </head>

        <body>

          <div id="map"></div>

          <?php
          $locations = array();
          $conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione fallita");
          $sql = "SELECT * FROM segnalazioni where tipo = '1' ";
          $result = mysqli_query($conn, $sql);
          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
              $id = filter_var($row['id'], FILTER_SANITIZE_NUMBER_INT);
              $longitudine = filter_var($row['longitudine'], FILTER_SANITIZE_STRING);
              $latitudine = filter_var($row['latitudine'], FILTER_SANITIZE_STRING);
              $descrizione = filter_var($row['descrizione'], FILTER_SANITIZE_STRING);
              $locations[] = array('id' => $id, 'lat' => $latitudine, 'lon' => $longitudine, 'descrizione' => $descrizione);
            }
            /* Convert data to json */
            $markers = json_encode($locations);
            mysqli_close($conn);
          }
          ?>
          <script type='text/javascript'>
            <?php
            echo "var markers=$markers;\n";
            ?>

            function initMap() {

              var latlng = new google.maps.LatLng(41.003656, 16.870685);
              var myOptions = {
                zoom: 8,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: false
              };

              var map = new google.maps.Map(document.getElementById("map"), myOptions);
              var infowindow = new google.maps.InfoWindow(),
                marker, lat, lon;

              for (var o in markers) {

                lat = parseFloat(markers[o].lat);
                lon = parseFloat(markers[o].lon);
                id = parseInt(markers[o].id);
                descrizione = markers[o].descrizione;

                to_display = '<b>Descrizione della segnalazione: </b>' + descrizione + '<br>' +
                  '<b>Latitudine: </b>' + lat + '<br>' +
                  '<b>Longitudine: </b>' + lon + '<br>';

                infowindow = new google.maps.InfoWindow({
                  content: to_display,
                })
                marker = new google.maps.Marker({
                  position: new google.maps.LatLng(lat, lon),
                  id: id,
                  map: map
                });
                marker.addListener("click", () => {
                  infowindow.open({
                    anchor: marker,
                    map,
                    shouldFocus: false,
                  });
                });
              }
            }
          </script>

          <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqWwEj5v1fUTcMI7C-xG2dt-jYs7pRnTk&callback=initMap">
          </script>

          <!-- FINE MAPPA -->

          <br><br><br>
          <!-- Tabella -->
          <div class="table-responsive" style="overflow-x: scroll; ">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="background-color:white;">
              <thead>
                <tr>
                  <th>CODICE SEGNALAZIONE</th>
                  <th>DATA</th>
                  <th>ORA</th>
                  <th>VIA</th>
                  <th>DESCRIZIONE</th>
                  <th>FOTO</th>
                  <th>E-MAIL</th>
                  <th>STATO</th>
                  <th>TEAM</th>
                  <th>GRAVITA'</th>
                </tr>
              </thead>

              <?php include("php/segnalazioniverde.php"); ?>

            </table>

            <!-- MODIFICA GRAVITA' -->

            <!-- inserimento da form del codice della segnalazione da modificare -->
            <br><br><br>

            <div class="card-header">
              <i class="fas fa-table"></i>
              Modifica gravità di una segnalazione
            </div>

            <form method="post" action="segnalazioniverde.php" style=" margin-top:5%; margin-left:5%">
              <b> CODICE SEGNALAZIONE DA MODIFICARE: </b> <input type="text" name="idt"><br><br>
              <b> INSERISCI LA GRAVITA' MODIFICATA: </b> <select class="text" name="gravit">

                <option value="Alta">Alta</option>
                <option value="Media">Media</option>
                <option value="Bassa">Bassa</option>

              </select>

              <input type="submit" name="submit" class="btn btn-primary btn-block" style="width:15%; margin-top:5%;">

            </form>

            <?php

            $conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

            $idt = (isset($_POST['idt'])) ? $_POST['idt'] : null;
            $grav = (isset($_POST['gravit'])) ? $_POST['gravit'] : null;


            if (isset($_POST['submit'])) {

              if ($idt && $grav !== null) {

                $resultC = mysqli_query($conn, "SELECT * FROM segnalazioni WHERE tipo = '1'");
                if ($resultC) {
                  $row = mysqli_fetch_assoc($resultC);
                  if ($id == $row['id']) {
                    $query = "UPDATE segnalazioni SET gravita = ? WHERE id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('ss', $grav, $idt);
                    $result = $stmt->execute();

                    if ($query) {
                      echo ("<br><b><br><p> <center> <font color=black font face='Courier'> Aggiornamento avvenuto correttamente. Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br> ");
                    }
                  } else {
                    echo "<p> <center> <font color=black font face='Courier'> Inserisci ID esistente.</b></center></p>";
                  }
                }
              } else {
                echo ("<p> <center> <font color=black font face='Courier'> Compila tutti i campi.</b></center></p>");
              }
            }

            ?>
            <br><br><br>

            <div class="card-header">
              <i class="fas fa-table"></i>
              Statistiche annuali per le segnalazioni delle aree verdi
            </div>
            <br><br>
            <!-- GRAFICO -->

            <script src="//www.amcharts.com/lib/3/amcharts.js"></script>
            <script src="//www.amcharts.com/lib/3/serial.js"></script>
            <script src="//www.amcharts.com/lib/3/themes/light.js"></script>

            <div id="chartdiv"></div>
            <script src='https://code.jquery.com/jquery-1.11.2.min.js'></script>

            <?php include("php/graficoverde.php"); ?>

            <!-- FINE GRAFICO -->

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