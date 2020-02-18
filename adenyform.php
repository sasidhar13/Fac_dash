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
		$aid=$_POST['aid'];
		$result = mysqli_query($con,"select * from appointment where aid=$aid") or die("Failed to query database".mysqli_error());
		$row= mysqli_fetch_array($result);
		$fid=$row['fid'];
		$apptstatus=$_POST['apptstatus'];
		$apptdate=$_POST['apptdate'];
		$appttime=$_POST['appttime'];
		$now = new DateTime();
		$now= $now->format('Y-m-d');
		if ($now>$apptdate or $apptstatus=='Denied'){
			$msg="Cannot be denied anymore";
			echo "<script>(alert('$msg'));window.location.href='schedulehod.php';</script>";
		}else{
			$sql= "UPDATE appointment SET apptstatus='Denied' WHERE aid=$aid and hodid=$hodid";
			$sqlresult=mysqli_query($con,$sql);
			header("Location:schedulehod.php");
		}
							
	?>
</body>
</html>