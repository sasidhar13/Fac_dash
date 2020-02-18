<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
</head>
<body>
	<?php
		session_start();
		$hodid=$_SESSION['fid'];
		$con=mysqli_connect("localhost", "root", "pass");
		mysqli_select_db($con,"fac_dash");
		$mid=$_POST['mid'];
		$mdate=$_POST['mdate'];
		$mtime=$_POST['mtime'];
		$now = new DateTime();
		$now= $now->format('Y-m-d');
		if ($now>$mdate){
			$msg="Cannot be deleted anymore";
			echo "<script type='text/javascript'>alert('$msg'); window.location.href='schedulehod.php';</script>";
		}else{
			$sql= "DELETE FROM meetings WHERE mid=$mid and hodid=$hodid";
			$sqlresult=mysqli_query($con,$sql);
			header("Location:schedulehod.php");
		}
	?>
</body>
</html>