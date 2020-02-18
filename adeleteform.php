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
		$fid=$_SESSION['fid'];
		$con=mysqli_connect("localhost", "root", "pass");
		mysqli_select_db($con,"fac_dash");
		$aid=$_POST['aid'];
		$apptdate=$_POST['apptdate'];
		$appttime=$_POST['appttime'];
		$now = new DateTime();
		$now= $now->format('Y-m-d');
		if ($now>$apptdate){
			$msg="Cannot be deleted anymore";
			echo "<script type='text/javascript'>alert('$msg'); window.location.href='schedule.php';</script>";
		}else{
			$sql= "DELETE FROM appointment WHERE aid=$aid and fid=$fid";
			$sqlresult=mysqli_query($con,$sql);
			header("Location:schedule.php");
		}
	?>
</body>
</html>