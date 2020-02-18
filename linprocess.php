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
		$fid = $_POST['user'];
		$pwd= $_POST['pass'];

		$fid= stripcslashes($fid);
		$pwd = stripcslashes($pwd);

		$con=mysqli_connect("localhost", "root", "pass");
		mysqli_select_db($con,"fac_dash");

		$result = mysqli_query($con,"select * from login where fid= '$fid' and pwd= '$pwd'") or die("Failed to query database".mysqli_error());
		$row= mysqli_fetch_array($result);

		if ($row['fid'] == $fid && $row['pwd']== $pwd) {
			$_SESSION['fid']=$fid;
			$_SESSION['acctype']=$row['acctype'];
			$_SESSION['deptid']=$row['deptid'];
			$_SESSION["login"] = "OK";
			header("Location:dashboard.php");
		}else{
			echo '<script type="text/javascript">'; 
			echo 'alert("Login failed. Please login again");'; 
			echo 'window.location.href = "main.php";';
			echo '</script>';
		}
	?>
</body>
</html>