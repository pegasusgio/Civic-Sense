<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Register</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Registra la password del team</div>
        <div class="card-body">
          <form action="registrateam.php" method="POST">
           
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email " required="required">
                <label for="inputEmail">Email </label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                    <label for="inputPassword">Password</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                    <label for="confirmPassword">Conferma la password</label>
                  </div>
                </div>
              </div>
            </div>
             <button type="submit" class="btn btn-primary btn-block" > Registrati </button> 
          </form>
        </div>
      </div>
    </div>
	
<?php

$conn = mysql_connect ("localhost", "root", "") or die ("Connessione non riuscita"); 
mysql_select_db ("civicsense") or die ("DataBase non trovato"); 


$email = (isset($_POST['email'])) ? $_POST['email'] : null;
$pass = (isset($_POST['password'])) ? $_POST['password'] : null;


if ($email && $pass !== null) {

  $query = "UPDATE team SET password = ? WHERE email_t = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('ss',$pass,$email);
  $result = $stmt->execute();	

  if ($query) { /* the control should be done on result and not on query */
	  echo("<br><b><br><p> <center> <font color=white font face='Courier'> Password registrata! Clicca su <a href='login.php'> Login </a> per accedere. </b></center></p><br><br> ");
  } 
}	
	
?>	
	

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
