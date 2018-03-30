<?php
// Include the database configuration file
require_once("config.php");
session_start();
define ('SITE_ROOT', realpath(dirname(__FILE__, 2)));

// Get the user ID
$currentLoginUser = $_SESSION['login_user'];
$currentLoginUser = mysqli_query($mysqli, "SELECT * FROM pengguna WHERE nama_pengguna = '$currentLoginUser'");
$currentLoginUser = mysqli_fetch_array($currentLoginUser);
$currentLoginUserId = $currentLoginUser['id'];

if(isset($_POST['submit'])){

    $foto = date('d-m-Y-H-i-s').'-'.$_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    // Set path folder tempat menyimpan fotonya
    $path = SITE_ROOT.DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."profile".DIRECTORY_SEPARATOR.$foto;

    move_uploaded_file($tmp, $path);

    $query = "UPDATE pengguna SET gambar_profile='$foto' WHERE id='$currentLoginUserId'";
    mysqli_query($mysqli, $query);
}

header("location: http://localhost:880/twiter/profile.php?id=$currentLoginUserId");
?>