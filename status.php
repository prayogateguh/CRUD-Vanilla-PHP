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

  $id = $_GET['id'];
  $status = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM status WHERE id = $id"));

  $idPemilikStatus = $status['id_pengguna'];
  $pemilikStatus = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM pengguna WHERE id = $idPemilikStatus"));

  $semuaKomentar = mysqli_query($mysqli, "SELECT * FROM komentar WHERE id_status = '$id' ORDER BY id ASC");

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
      <div class="list-group">
        <div class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <a href="profile.php?id=<?= $idPemilikStatus; ?>" class="mb-1"><?= $pemilikStatus['nama_lengkap']; ?></a>
            <small><?= date("F jS, Y", strtotime($status['tanggal_dibuat'])) ?></small>
          </div>
          <p class="mb-1"><?= $status['status']; ?></p>
          <small>
          <?php if ($currentUser['id'] === $pemilikStatus['id']){?>
          <a href="edit.php?id=<?= $status['id']; ?>">Edit</a> | 
          <a href="backend/deleteStatus.php?id=<?= $status['id']; ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></small>
          <?php } ?>
        </div>
      </div>

      <!-- form add komentar -->
      <form method="POST" action="backend/addKomentar.php" class="mb-5">
        <div class="form-group mt-2">
          <input type="text" class="form-control" id="komentar" name="komentar" placeholder="Tulis komentar...">
          <input type="hidden" name="id-status" value="<?= $status['id']; ?>">
          <input type="hidden" name="id-komentator" value="<?= $currentUser['id']; ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-primary float-right">Kirim</button>
      </form>

      <!-- status komentar -->
      <ul class="col-md-12 px-0 pt-5">
      <?php
      while($komentar = mysqli_fetch_array($semuaKomentar)) {
        $idKomentator = $komentar['id_pengguna'];
        $komentator = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM pengguna WHERE id = '$idKomentator'")); 
      ?>
          <li class="list-group-item border-right-0 border-left-0">
          <?= $komentar['komentar'] ?>
          - <a href="profile.php?id=<?= $idKomentator; ?>"><?= $komentator['nama_lengkap']; ?></a>
          <?php
          if ($currentUser['id'] === $idKomentator) { ?>
          (<a href="backend/deleteKomentar.php?sid=<?= $status['id']; ?>&kid=<?= $komentar['id']; ?>"  onClick="return confirm('Are you sure you want to delete?')">Delete</a>)
          <?php } ?>
          </li>
        </ul>
      <?php } ?>
      </div>
    </div>
  </div>
  
  </body>
</html>