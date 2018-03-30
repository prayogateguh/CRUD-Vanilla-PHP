<?php
require_once("config.php");

//getting id of the data from url
$sid = $_GET['sid'];
$kid = $_GET['kid'];
//deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM komentar WHERE id=$kid");
//redirecting to the display page (index.php in our case)
header("Location: http://localhost:880/twiter/status.php?id=$sid");
