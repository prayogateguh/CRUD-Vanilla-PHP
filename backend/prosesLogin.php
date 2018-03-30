<?php
require_once("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 
    
    $namaPengguna = mysqli_real_escape_string($mysqli, $_POST['inputPengguna']);
    $kataSandi = mysqli_real_escape_string($mysqli, $_POST['inputKataSandi']); 
    
    $sql = "SELECT id FROM pengguna WHERE nama_pengguna = '$namaPengguna' and kata_sandi = '$kataSandi'";
    $result = mysqli_query($mysqli, $sql);
    
    $count = mysqli_num_rows($result);
    
    // If result matched $myusername and $mypassword, table row must be 1 row
    
    if($count == 1) {
        $_SESSION['login_user'] = $namaPengguna;
        
        header("location: http://localhost:880/twiter/dashboard.php");
    }else {
        header("location: http://localhost:880/twiter/");
    }
}