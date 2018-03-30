<?php
//including the database connection file
require_once("config.php");

if(isset($_POST['submit'])) {	
    $komentar = mysqli_real_escape_string($mysqli, $_POST['komentar']);
    $idStatus = mysqli_real_escape_string($mysqli, $_POST['id-status']);
    $idKomentator = mysqli_real_escape_string($mysqli, $_POST['id-komentator']);
    $tanggalDibuat = date("Y-m-d H:i:s");
		
	// checking empty fields
	if(empty($komentar)) {
				
		if(empty($komentar)) {
			echo "<font color='red'>Tidak bisa membuat komentar.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO komentar(id_pengguna,id_status,komentar,tanggal_dibuat) VALUES('$idKomentator','$idStatus','$komentar','$tanggalDibuat');");
		
		//redirect user to the dashboard
		header("location: http://localhost:880/twiter/status.php?id=$idStatus");
	}
}
