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
		$q1 = $_POST['q1'];
		$q2= $_POST['q2'];
		$q3= $_POST['q3'];
		$q4= $_POST['q4'];
		$q5= $_POST['q5'];
		if (isset($_POST['subbtn'])){
			$sql = "UPDATE secquesans SET q1='".$q1."' WHERE fid=".$fid."";
			$con->query($sql);
			$sql = "UPDATE secquesans SET q2='".$q2."' WHERE fid=".$fid."";
			$con->query($sql);
			$sql = "UPDATE secquesans SET q3='".$q3."' WHERE fid=".$fid."";
			$con->query($sql);
			$sql = "UPDATE secquesans SET q4='".$q4."' WHERE fid=".$fid."";
			$con->query($sql);
			$sql = "UPDATE secquesans SET q5='".$q5."' WHERE fid=".$fid."";
			$con->query($sql);
			echo "<script type='text/javascript'>alert('Updated Successfully');window.location.href='secques.php';</script>";
		}
		if (isset($_POST['lockedout'])){
			$sql= "SELECT * FROM secquesans WHERE fid=$fid";
			$result=mysqli_query($con,$sql);
			$row=mysqli_fetch_assoc($result);
			if ($q1==$row['q1']){
				if ($q2==$row['q2']){
					if ($q3==$row['q3']){
						if ($q4==$row['q4']){
							if ($q5==$row['q5']){
									$temp=rand(0000000000,9999999999);
									$sql = "UPDATE login SET pwd='".$temp."' WHERE fid=".$fid."";
									$con->query($sql);
									echo '<script type="text/javascript">'; 
									echo 'alert("Temporary pwd is '.$temp.'. Please use this password to login to your account. You can reset your password in Profile Edit section later.");'; 
									echo 'window.location.href = "editform.php";';
									echo '</script>';
							}
						}
					}
				}
			}
		}
	?>
</body>
</html>