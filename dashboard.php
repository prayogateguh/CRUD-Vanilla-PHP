<!doctype html>
<?php
  require_once("backend/config.php");
  session_start();

  if (!isset($_SESSION['login_user'])) {
    header("location: http://localhost:880/twiter/");
  }

  $pengguna = $_SESSION['login_user'];
  $user = mysqli_query($mysqli, "SELECT * FROM pengguna WHERE nama_pengguna = '$pengguna'");
  $currentUser = mysqli_fetch_array($user);

  $semuaStatus = mysqli_query($mysqli, "SELECT * FROM status ORDER BY tanggal_dibuat DESC");
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
      <h3>Hi <?= $currentUser['nama_lengkap']; ?>,</h3>
      <form method="POST" action="backend/addStatus.php">
        <div class="form-group">
          <input type="text" class="form-control" name="status" placeholder="Apa yang Anda pikirkan sekarang?">
          <input type="hidden" name="id-user" value="<?= $currentUser['id']; ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-primary float-right">Kirim</button>
      </form>
      </div>

      <div class="col-12 mt-3">
      <div class="list-group">
      <?php
      
      while($status = mysqli_fetch_array($semuaStatus)) { ?>	
        <div class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <?php
            $idPengguna = $status['id_pengguna'];
            $pembuatStatus = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM pengguna WHERE id = '$idPengguna'"));
            ?>
            <a href="profile.php?id=<?= $pembuatStatus['id']; ?>" class="mb-1"><?= $pembuatStatus['nama_lengkap'] ?></a>
            <small><?= date("F jS, Y", strtotime($status['tanggal_dibuat'])) ?></small>
          </div>
          <p class="mb-1"><?= $status['status'] ?></p>
          <small><a href="status.php?id=<?= $status['id']; ?>">Komentar</a> | <a href="#">Bagikan</a></small>
        </div>	
      <?php } ?>
      </div>
      </div>
    </div>
  </div>
  
  </body>
</html>