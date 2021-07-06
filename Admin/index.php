<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Area riservata - ADMIN</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">


<!-- Navbar -->
 <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.html"> Area Riservata </a>
     <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
     </button>

 <!--Logout-->     
 <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow" >
           <a class="nav-link dropdown-toggle" href="#" title="Logout"  id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-user-circle fa-fw"></i>
           </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="login.php" data-toggle="modal" data-target="#logoutModal" > Logout </a>
          </div>
        </li>
    </ul>
 </form>
 
</nav>


<div id="wrapper">

      <!-- Sidebar -->
  <ul class="sidebar navbar-nav">
    <br>
        <li class="nav-item active">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span>
          </a>
        </li>


   <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span >Segnalazioni</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" >
		   <a class="dropdown-item" href="segnalazionii.php"><center><b>INDICE SEGNALAZIONI</b></center></a>
            <a class="dropdown-item" href="segnalazioniverde.php">Segnalazione su aree verdi</a>
            <a class="dropdown-item" href="segnalazionirifiuti.php">Rifiuti e pulizia stradale</a> 
			<a class="dropdown-item" href="segnalazionistrade.php">Strade e marciapiedi</a>
            <a class="dropdown-item" href="segnalazionisemafori.php">Segnaletica e semafori</a> 
			<a class="dropdown-item" href="segnalazioniilluminazione.php"> Illuminazione pubblica</a> 
          </div>
      </li>
		
	   <li class="nav-item dropdown">
          <a class="nav-link " href="team.php" >
          <i class="fas fa-fw fa-folder"></i>
          <span>Team</span></a>	
      </li>    
		  
</ul>

<div id="content-wrapper">
<div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item active">Indice Tabelle</li>
          </ol>


          <!-- Icon Cards-->


   <div class="row" style="margin-left:15%; margin-top:10%;">

    <a href="team.php">

        <div class="col-lg-4 col-sm-6 portfolio-item" >
          <div class="card h-100" style="   ">
            <img class="card-img-top" src="img/team.jpg" alt="">
            <div class="card-body">
              <h4 class="mr-5" style="margin-top: -30px;">
                <a href="team.php" style="color:black">Team <i class="fas fa-angle-right" style="margin-left:3px;"><i class="fas fa-angle-right" style="margin-left:3px;"></i></i></a>
              </h4>
            </div>
          </div>
        </div>
    </a>
    
    <a href="segnalazionii.php">

        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100" style="   ">
            <img class="card-img-top" src="img/segnalazioni.jpg" alt="">
            <div class="card-body">
              <h4 class="mr-5" style="margin-top: -30px;"> <br>
                <a href="segnalazionii.php" style="color:black"> Segnalazioni <i class="fas fa-angle-right" style="margin-left:3px;"><i class="fas fa-angle-right" style="margin-left:3px;"></i></i></a>
              </h4>
            </div>
          </div>
        </div>
    </a>

  </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

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

</div>
</div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
