<?php
//including the database connection file
require_once("config.php");

if(isset($_POST['submit'])) {	
	$status = mysqli_real_escape_string($mysqli, $_POST['status']);
	$idUser = mysqli_real_escape_string($mysqli, $_POST['id-user']);
	$tanggalDibuat = date("Y-m-d H:i:s");
		
	// checking empty fields
	if(empty($status)) {
				
		if(empty($status)) {
			echo "<font color='red'>Tidak bisa membuat status palsu.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO status(id_pengguna,status,tanggal_dibuat) VALUES('$idUser','$status','$tanggalDibuat')");
		
		//redirect user to the dashboard
		header("location: http://localhost:880/twiter/dashboard.php");
	}
}
