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
		$lid=$_POST['lid'];
		$result = mysqli_query($con,"select * from fdbleave where lid=$lid") or die("Failed to query database".mysqli_error());
		$row= mysqli_fetch_array($result);
		$fid=$row['fid'];
		$sdate=$_POST['sdate'];
		$edate=$_POST['edate'];
		$adate=$_POST['adate'];
		$ltype=$_POST['ltype'];
		$lstatus=$_POST['lstatus'];
		$now = new DateTime();
		$now= $now->format('Y-m-d');
		if ($lstatus=='Denied'){
			$msg="Cannot Roll back anymore";
			echo "<script type='text/javascript'>alert('$msg');window.location.href='leaveformhod.php';</script>";
		}else{
								
			if($lstatus=='Approved'){
				$sdatestr = strtotime($sdate); 
				$edatestr = strtotime($edate);
				$datediff = $edatestr - $sdatestr;
				$duration = round($datediff / (60 * 60 * 24));

				$sql1= "UPDATE leaveinfo SET ltaken=ltaken-".$duration." WHERE fid=$fid and ltype='$ltype'";
				$sql1result=mysqli_query($con,$sql1);

				$sql2="UPDATE leaveinfo SET lremaining=lremaining+".$duration." WHERE fid=$fid and ltype='$ltype'";
				$sql2result=mysqli_query($con,$sql2);
			}
			$sql= "UPDATE fdbleave SET lstatus='Denied' WHERE lid=$lid and hodid=$hodid";
			$sqlresult=mysqli_query($con,$sql);

			header("Location:leaveformhod.php");
		}
	?>
</body>
</html>