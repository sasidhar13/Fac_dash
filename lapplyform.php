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
		$sqld= "SELECT deptid FROM fdbuser WHERE fid=$fid";
		$resultd=mysqli_query($con,$sqld);
		$rowd=mysqli_fetch_assoc($resultd);
		$deptid=$rowd['deptid'];
		$sqlh= "SELECT hodid FROM department WHERE deptid=$deptid";
		$resulth=mysqli_query($con,$sqlh);
		$rowh=mysqli_fetch_assoc($resulth);
		$hodid=$rowh['hodid'];
		$ltype = $_POST['ltype'];
		$sdate= $_POST['sdate'];
		$edate= $_POST['edate'];
		$reason= $_POST['reason'];
		$lid=rand(00000000,99999999);
		$now = new DateTime();
		$adate= $now->format('Y-m-d');
		$status='Pending';
			
		$sql = "INSERT INTO fdbleave(lid,ltype, sdate, edate , adate, reason,lstatus, fid,hodid) VALUES (?,?,?,?,?,?,?,?,?)";
		$stmt = mysqli_prepare($con,$sql);
		$stmt->bind_param("sssssssss", $lid,$ltype,$sdate,$edate,$adate,$reason,$status,$fid,$hodid);
		$stmt->execute();
		$msg="Leave applied succesfully!";
		echo "<script type='text/javascript'>alert('$msg');window.location.href='leaveform.php';</script>";
	?>
</body>
</html>