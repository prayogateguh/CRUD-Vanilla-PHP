<!doctype html>
<?php
  require_once("backend/config.php");
  session_start();
  if (!isset($_SESSION['login_user'])) {
    header("location: http://localhost:880/twiter/");
  }

  $currentLoginUser = $_SESSION['login_user'];
  $currentLoginUser = mysqli_query($mysqli, "SELECT * FROM pengguna WHERE nama_pengguna = '$currentLoginUser'");
  $currentLoginUser = mysqli_fetch_array($currentLoginUser);
  $pengguna = $_GET['id'];
  $user = mysqli_query($mysqli, "SELECT * FROM pengguna WHERE id = '$pengguna'");
  $user = mysqli_fetch_array($user);
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
        <a class="nav-link" href="profile.php?id=<?= $currentLoginUser['id']; ?>">Profile</a>
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
      <section class="hero bg-indigo">
            <div class="container">
                <div class="row">
                    <div class="card border-none col-lg-6 col-md-8 col-sm-10 mx-auto bg-texture">
                        <div class="card-body text-center py-4">
                            <div class="mb-3">
                              <?php
                              if ($user['gambar_profile']) { ?>
                                <img src="images/profile/<?= $user['gambar_profile'] ?>" alt="<?= $currentUser['nama_lengkap'] ?>" class="brand-logo img-fluid rounded-circle" width="200" height="200"/>
                              <?php } else { ?>
                                <img src="images/profile/male.jpg" alt="<?= $user['nama_lengkap'] ?>" class="brand-logo img-fluid rounded-circle" width="200" height="200"/>
                              <?php } ?>
                            </div>
                            <?php
                            if ($currentLoginUser['id'] === $user['id']) { ?>
                            <form action="backend/upload.php" method="post" enctype="multipart/form-data">
                              <p>upload poto profile:</p>
                              <input type="file" name="foto">
                              <input type="submit" name="submit" value="Upload">
                            </form>
                            <?php } ?>
                            <h2 class="pt-3 h3"><?= $user['nama_lengkap'] . ", " . $user['pekerjaan'];  ?>.</h2>
                            <p class="mt-4 lead"><?= $user['slogan']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      </div>
    </div>
  </div>
  
  </body>
</html>