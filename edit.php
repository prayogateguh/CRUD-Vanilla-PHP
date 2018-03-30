<!doctype html>
<?php
  require_once("backend/config.php");
  session_start();

  if (!isset($_SESSION['login_user'])) {
    header("location: http://localhost:880/twiter/");
  }

  $id = $_GET['id'];
  $status = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM status WHERE id = $id"));
  $idPemilikStatus = $status['id_pengguna'];
  $pemilikStatus = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM pengguna WHERE id = $idPemilikStatus"));
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link href="css/bootstrap.css" rel="stylesheet">
  </head>

  <body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="dashboard.php">Twitter</a>

    <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="profile.php?id=<?= $currentUser['id']; ?>">Profile</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="backend/logout.php">Logout</a>
        </li>
    </ul>
    </div>
  </nav>
  
  <div class="container">
    <div class="row">
      <div class="col-12">
        <form method="POST" action="backend/editStatus.php">
          <div class="form-group">
            <input type="text" class="form-control" name="status" value="<?= $status['status']; ?>" placeholder="Apa yang Anda pikirkan sekarang?">
            <input type="hidden" name="id-user" value="<?= $pemilikStatus['id']; ?>">
            <input type="hidden" name="id-status" value="<?= $id; ?>">
          </div>
          <button type="submit" name="edit" class="btn btn-primary float-right">Edit</button>
        </form>
      </div>
    </div>
  </div>
  
  </body>
</html>