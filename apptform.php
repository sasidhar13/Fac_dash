<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Leave Management</title>
	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/basic.css">
	<link rel="stylesheet" href="css/apptform.css">
	<script type="text/javascript" src="js/meetingform.js"></script>  
	<script type="text/javascript" src="js/basic.js"></script>   
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
	<?php
		session_start();
		$fid=$_SESSION['fid'];
		$deptid=$_SESSION['deptid'];
		$acctype=$_SESSION['acctype'];

		$con=mysqli_connect("localhost", "root", "pass");
		mysqli_select_db($con,"fac_dash");
		$result = mysqli_query($con,"select * from department where deptid=$deptid") or die("Failed to query database");
		$row= mysqli_fetch_array($result);
		$hodid=($row['hodid']);
	?>
	<div class="navbar_">
		<a style="font-size:30px; cursor:pointer; color: white; " onclick="openNav()">&#9776;</a>
		<h2 align="center" class="page-name">SCHEDULE AN APPOINTMENT</h2>
		<em class="material-icons" onclick="openSearch()">search</em>
	</div>

	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="dashboard.php">Dashboard</a>
		<a href="profile.php">Profile</a>
		<a href="loutprocess.php">Logout</a>
	</div>

	<div class="main" id='main'>
				<form class='box' id='meetform' method='POST'>
			     	<h2>Fill in the Form</h2>
					<label for='adate' id='labels'>Date:</label>
					<input type='date' id='adate' name='adate'>
					<script type="text/javascript">
						$(function() {
						var date = new Date();
						var currentMonth = date.getMonth();
						var currentDate = date.getDate();
						var currentYear = date.getFullYear();
						$('#mdate').datepicker({
						minDate: new Date(currentYear, currentMonth, currentDate)
						});
						});
					</script>
					<label for='atime' id='labele'>Time:</label>
					<input type='time' id='atime' name='atime'>
					<input type='text' id='agenda' name='agenda' placeholder='Agenda'>
					<input type='submit' id='sbtbtn' name='submit' value='Go'>
				</form>
				<?php
					if ($_SERVER['REQUEST_METHOD'] == 'POST'){
						if (!empty($_POST['submit'])){
							$adate= $_POST['adate'];
							$atime= $_POST['atime'];
							$agenda= $_POST['agenda'];
							$aid=rand(000000,999999);
							$status='Pending';
							$now = new DateTime();
							$now= $now->format('Y-m-d');
							if ($adate<$now){
								echo '<script type="text/javascript">';                                         
								echo 'alert("Please pick a future date");'; 
								echo 'window.location.href = "meetingform.php";';
								echo '</script>';
							}
							else if ($atime>='16:00' and $atime<='9:00'){
								echo '<script type="text/javascript">';                                         
								echo 'alert("Please pick time between 9am to 4pm");'; 
								echo 'window.location.href = "meetingform.php";';
								echo '</script>';
							}else{
								$sql = "INSERT INTO appointment(fid,hodid,apptdate, appttime, purpose , apptstatus,aid) VALUES (?,?,?,?,?,?,?)";
								$stmt = mysqli_prepare($con,$sql);
								$stmt->bind_param("sssssss", $fid,$hodid,$adate,$atime,$agenda,$status,$aid);
								$stmt->execute();
								echo '<script type="text/javascript">';              
								echo 'alert("Appointment scheduled successfully!");'; 
								echo 'window.location.href = "schedule.php";';
								echo '</script>';
							}
						}
					}
				?>
		</div>

</body>
</html>
