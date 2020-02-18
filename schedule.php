<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Schedule</title>
	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/basic.css">
	<link rel="stylesheet" href="css/schedule.css">
	<script type="text/javascript" src="js/basic.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">   
</head>
<body>
	<?php
		session_start();
		$fid=$_SESSION['fid'];
		$acctype=$_SESSION['acctype'];
	?>
	<div class="navbar_">
		<a style="font-size:30px; cursor:pointer; color: white; " onclick="openNav()">&#9776;</a>
		<h2 align="center" class="page-name">SCHEDULE</h2>
		<em class="material-icons" onclick="openSearch()">search</em>
	</div>

	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="dashboard.php">Dashboard</a>
		<a href="profile.php">Profile</a>
		<a href="loutprocess.php">Logout</a>
	</div>
	<div id="main" class='main'>
		<h2 id='meethead'>Meetings</h2>
		<div class='meetings'>
			<?php
			    	$con=mysqli_connect("localhost", "root", "pass");
					mysqli_select_db($con,"fac_dash");

					$sqld = "SELECT deptid FROM fdbuser where fid=$fid";
					$resultd = $con->query($sqld);
					$rowd=mysqli_fetch_assoc($resultd);
					$deptid=$rowd['deptid'];
					$sqlh= "SELECT hodid FROM department WHERE deptid=$deptid";
					$resulth=mysqli_query($con,$sqlh);
					$rowh=mysqli_fetch_assoc($resulth);
					$hodid=$rowh['hodid'];

					$sql= "SELECT * FROM meetings WHERE hodid=$hodid";
					$result=$con->query($sql);
					if($result->num_rows==0){
						echo "<h4>No scheduled meetings for now</h4>";
					}else{
						echo "<table class='table'>";
	  					echo "<thead>"; 
					    echo "<tr>";
					    echo "<th scope='col'>#</th>";
						echo "<th scope='col'>Date</th>";
						echo "<th scope='col'>Time</th>";
						echo "<th scope='col'>Agenda</th>";
						if ($acctype=='hod'){
							echo "<th scope='col'>Delete</th>";
						}
	    				echo "</tr>";
						echo "</thead>";
						echo "<tbody>"; 
						$i=1;
						while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<th scope='row'>".$i."</th>";
							echo "<td>".$row['mdate']."</td>";
							echo "<td>".$row['mtime']."</td>";
							echo "<td>".$row['agenda']."</td>";
							if ($acctype=='hod'){
								echo "<td><form action='mdeleteform.php' method='POST'>";
								echo "<input type='submit' name='mdelete' id='mdelete' value='Delete'>";
								echo "<input type='hidden' id='mid' name='mid' value='".$row["mid"]."'>";
								echo "<input type='hidden' id='mdate' name='mdate' value='".$row["mdate"]."'>";
								echo "<input type='hidden' id='mtime' name='mtime' value='".$row["mtime"]."'></form></td>";
							}
							echo "</tr>";
							$i=$i+1;
						}
						echo "</tbody>";
						echo "</table>";
					}
					if ($acctype=='hod'){
						echo "<form action='meetingform.php' method='POST' accept-charset='utf-8'>";
						echo "<input type='submit' id='meetnotify' value='Notify'>";
						echo "</form>";
					}
				?>
		</div>
		<h2 id='appthead'>Appointments</h2>
		<div class='appointments'>
			<?php
			    	$con=mysqli_connect("localhost", "root", "pass");
					mysqli_select_db($con,"fac_dash");

					$sql= "SELECT * FROM appointment WHERE fid=$fid";
					$result=$con->query($sql);
					if($result->num_rows==0){
						echo "<h4>No scheduled meetings for now</h4>";
					}else{
						echo "<table class='table'>";
	  					echo "<thead>"; 
					    echo "<tr>";
					    echo "<th scope='col'>#</th>";
						echo "<th scope='col'>Date</th>";
						echo "<th scope='col'>Time</th>";
						echo "<th scope='col'>Agenda</th>";
						echo "<th scope='col'>Status</th>";
						if ($acctype=='hod'){
							echo "<th scope='col'>Approve</th>";
							echo "<th scope='col'>Deny</th>";
						}else{
							echo "<th scope='col'>Delete</th>";
						}
	    				echo "</tr>";
						echo "</thead>";
						echo "<tbody>"; 
						$i=1;
						while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<th scope='row'>".$i."</th>";
							echo "<td>".$row['apptdate']."</td>";
							echo "<td>".$row['appttime']."</td>";
							echo "<td>".$row['purpose']."</td>";
							echo "<td>".$row['apptstatus']."</td>";
							if ($acctype=='hod'){
								echo "<td><form action='aapproveform.php' method='POST'>";
								echo "<input type='submit' name='aapprove' id='aapprove' value='Approve'>";
								echo "<input type='hidden' id='aid' name='aid' value='".$row["aid"]."'>";
								echo "<input type='hidden' id='apptstatus' name='apptstatus' value='".$row["apptstatus"]."'>";
								echo "<input type='hidden' id='apptdate' name='apptdate' value='".$row["apptdate"]."'>";
								echo "<input type='hidden' id='appttime' name='appttime' value='".$row["appttime"]."'></form></td>";
								echo "<td><form  action='adenyform.php' method='POST'>";
								echo "<input type='text' name='adenymsg' id='adenymsg' value='Message'>";
								echo "<input type='submit' name='adeny' id='adeny' value='Deny'>";
								echo "<input type='hidden' id='aid' name='aid' value='".$row["aid"]."'>";
								echo "<input type='hidden' id='apptstatus' name='apptstatus' value='".$row["apptstatus"]."'>";
								echo "<input type='hidden' id='apptdate' name='apptdate' value='".$row["apptdate"]."'>";
								echo "<input type='hidden' id='appttime' name='appttime' value='".$row["appttime"]."'></form></td>";
							}else{
								echo "<td><form action='adeleteform.php' method='POST'>";
								echo "<input type='submit' name='adelete' id='adelete' value='Delete'>";
								echo "<input type='hidden' id='aid' name='aid' value='".$row["aid"]."'>";
								echo "<input type='hidden' id='apptdate' name='apptdate' value='".$row["apptdate"]."'>";
								echo "<input type='hidden' id='appttime' name='appttime' value='".$row["appttime"]."'></form></td>";
							}
							echo "</tr>";
							$i=$i+1;
						}
						echo "</tbody>";
						echo "</table>";
					}
					if ($acctype!='hod'){
						echo "<form action='apptform.php' method='POST' accept-charset='utf-8'>";
       					echo "<input type='submit' id='apptapply' value='Apply'>";
         				echo "</form>";
					}
				?>
				
		</div>
	</div>

</body>
</html>
