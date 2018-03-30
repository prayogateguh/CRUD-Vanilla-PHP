<!doctype html>
<?php
  session_start();

  if (isset($_SESSION['login_user'])) {
    header("location: http://localhost:880/twiter/dashboard.php");
  }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Signin Template for Bootstrap</title>
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/login.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="backend/prosesLogin.php" method="POST">
      <img class="mb-4" src="images/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <input type="text" name="inputPengguna" class="form-control" placeholder="Nama Pengguna" required autofocus>
      <input type="password" name="inputKataSandi" class="form-control" placeholder="Kata Sandi" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; Twiter 2018</p>
    </form>
  </body>
</html>