<?php session_start() ?>
<!DOCTYPE html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Login</title>

  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="#" method="POST">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required="required" autofocus="autofocus">
              <label for="inputEmail"> Email </label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required" autocomplete="off">
              <label for="inputPassword"> Password </label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Ricordami
              </label>
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-block"> Login</button>
          <br>
          <center> <a class="d-block small mt-3" href="registrateam.php">Sei un nuovo team? Registra la tua password!</a> </center>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <?php
  // Recupero dati
  if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = mysqli_connect('localhost', 'root', '') or die("Connessione non riuscita");
    mysqli_select_db($conn, 'civicsense') or die("Database non trovato"); #connessione al db

    $var = parse_ini_file("config.ini");

    $query = "SELECT * FROM admin where email = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $encrypted_password = openssl_encrypt($password, "AES-128-ECB", $var['SECRETKEY']);
    $stmt->bind_param('ss', $email, $encrypted_password);
    $result_query = $stmt->execute();

    if ($result_query) {
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();

      if (mysqli_num_rows($result) > 0) {

        echo 'Accesso consentito alla sezione riservata';
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['id'] = $row['id'];
        echo '<script>window.location.href = "index.php";</script>';
      } else {

        $query1 = "SELECT * FROM team where email_t = ? and password = ?";
        $stmt1 = $conn->prepare($query1);
        $encrypted_password = openssl_encrypt($password, "AES-128-ECB", $var['SECRETKEY']);
        $stmt1->bind_param('ss', $email, $encrypted_password);
        $result_query1 = $stmt1->execute();

        if ($result_query1) {
          $result1 = $stmt1->get_result();
          $row1 = $result1->fetch_assoc();

          if (mysqli_num_rows($result1) > 0) {
            $_SESSION['email'] = $email;
            $_SESSION['pass'] = $password;
            $_SESSION['idT'] = $row1['codice'];
            header("location: http://localhost//Civic-Sense/Team/index.php");
          } else {
          }
        }
      }
    }
    mysqli_close($conn);
  }
  ?>