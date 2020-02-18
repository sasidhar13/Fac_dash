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
		$lid=$_POST['lid'];
		$lstatus=$_POST['lstatus'];
		$sdate=$_POST['sdate'];
		$edate=$_POST['edate'];
		$adate=$_POST['adate'];
		$type=$_POST['ltype'];
		$now = new DateTime();
		$now= $now->format('Y-m-d');
		if ($now>$sdate){
			$msg="Cannot Delete anymore";
			echo "<script type='text/javascript'>alert('$msg');window.location.href='leaveform.php';</script>";
		}else{
			$sql= "DELETE FROM fdbleave WHERE lid=$lid and fid=$fid";
			$sqlresult=mysqli_query($con,$sql);
			$sdatestr = strtotime($sdate); 
			$edatestr = strtotime($edate);
			$datediff = $edatestr - $sdatestr;
			$duration = round($datediff / (60 * 60 * 24));
			if ($lstatus=='Approved'){
				$sql1= "UPDATE leaveinfo SET ltaken=ltaken-".$duration." WHERE fid=$fid and ltype='$ltype'";
				$sql1result=mysqli_query($con,$sql1);
				$sql2="UPDATE leaveinfo SET lremaining=lremaining+".$duration." WHERE fid=$fid and ltype='$ltype'";
				$sql2result=mysqli_query($con,$sql2);
			}
			header("Location:leaveform.php");
		}
		
	?>
</body>
</html>