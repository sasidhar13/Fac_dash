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
	<link rel="stylesheet" href="css/leaveform.css">
	<script type="text/javascript" src="js/basic.js"></script>
	<script type="text/javascript" src="js/meetingform.js"></script>   
	<script type="text/javascript" src="js/leaveform.js"></script>    
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
	<?php
		session_start();
		$fid=$_SESSION['fid'];
		$deptid=$_SESSION['deptid'];
		$acctype=$_SESSION['acctype'];
	?>
	<div class="navbar_">
		<a style="font-size:30px; cursor:pointer; color: white; " onclick="openNav()">&#9776;</a>
		<h2 align="center" class="page-name">LEAVE MANAGEMENT</h2>
		<em class="material-icons" onclick="openSearch()">search</em>
	</div>

	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="dashboard.php">Dashboard</a>
		<a href="profile.php">Profile</a>
		<a href="loutprocess.php">Logout</a>
	</div>

	<div class="main" id='main'>
		<div class='menu'>
			<button type="button" class='btn' id='apply' onclick="openApply()" autofocus> Apply </button>
			<button type="button" class='btn' id='leaves' onclick="openLeaves()"> Leaves </button>
			<button type="button" class='btn' id='remaining' onclick="openRemaining()"> Remaining </button>
			<button type="button" class='btn' id='salary' onclick="openSalary()"> Salary </button>
		</div>
		<div class='content'>
			<div id='applydiv'>
				<form class='box' action='lapplyform.php' id='leaveform' method='POST'>
			     	<h2>Fill in the Leave Form</h2>
					<select id="ltype" name='ltype'>
						<option value="casual" >Casual</option>
						<option value="medical">Medical</option>
						<option value="emergency">Emergency</option>
					</select>
					<label for='sdate' id='labels'>From</label>
					<input type='date' id='sdate' name='sdate'>
					<label for='edate' id='labele'>To</label>
					<input type='date' id='edate' name='edate'>
					<input type='text' id='reason' name='reason' placeholder='Reason'>
					<input type='submit' id='applybtn' name='submit' value='Submit'>
				</form>
			</div>
			<div id='leavesdiv'>
				<?php
			    	$con=mysqli_connect("localhost", "root", "pass");
					mysqli_select_db($con,"fac_dash");

					$sql = "SELECT * FROM fdbleave where fid=$fid ORDER BY adate";
					$result = $con->query($sql);


					if($result->num_rows==0){
						echo "<h4>No leaves to show </h4>";
					}else{
						echo "<table class='table'>";
	  					echo "<thead>"; 
					    echo "<tr>";
					    echo "<th scope='col'>#</th>";
						echo "<th scope='col'>Applied on</th>";
						echo "<th scope='col'>From</th>";
						echo "<th scope='col'>To</th>";
						echo "<th scope='col'>Reason</th>";
						echo "<th scope='col'>Status</th>";
						echo "<th scope='col'>Delete</th>";
	    				echo "</tr>";
						echo "</thead>";
						echo "<tbody>"; 
						$i=1;
						while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<th scope='row'>".$i."</th>";
							echo "<td>".$row['adate']."</td>";
							echo "<td>".$row['sdate']."</td>";
							echo "<td>".$row['edate']."</td>";
							echo "<td>".$row['reason']."</td>";
							echo "<td>".$row['lstatus']."</td>";
							echo "<td><form action='ldeleteform.php' method='POST'>";
							echo "<input type='submit' name='delete' id='ldelete' value='Delete'>";
							echo "<input type='hidden' id='lid' name='lid' value='".$row["lid"]."'>";
							echo "<input type='hidden' id='lstatus' name='lstatus' value='".$row["lstatus"]."'>";
							echo "<input type='hidden' id='ltype' name='ltype' value='".$row["ltype"]."'>";
							echo "<input type='hidden' id='sdate' name='sdate' value='".$row["sdate"]."'>";
							echo "<input type='hidden' id='edate' name='edate' value='".$row["edate"]."'>";
							echo "<input type='hidden' id='adate' name='adate' value='".$row["adate"]."'></form></td>";
							echo "</tr>";
							$i=$i+1;
						}
						echo "</tbody>";
						echo "</table>";
					}
				?>
			</div>
			<div id='remainingdiv'>
				<?php
			    	$con=mysqli_connect("localhost", "root", "pass");
					mysqli_select_db($con,"fac_dash");

					$sql = "SELECT * FROM leaveinfo where fid=$fid";
					$result = $con->query($sql);


					if($result->num_rows==0){
						echo "<h4>Error</h4>";
					}else{
						echo "<table class='table'>";
	  					echo "<thead>"; 
					    echo "<tr>";
					    echo "<th scope='col'>#</th>";
						echo "<th scope='col'>leave type</th>";
						echo "<th scope='col'>Available</th>";
						echo "<th scope='col'>Taken</th>";
						echo "<th scope='col'>Remaining</th>";
	    				echo "</tr>";
						echo "</thead>";
						echo "<tbody>"; 
						$i=1;
						while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<th scope='row'>".$i."</th>";
							echo "<td>".$row['ltype']."</td>";
							echo "<td>".$row['lavailable']."</td>";
							echo "<td>".$row['ltaken']."</td>";
							echo "<td>".$row['lremaining']."</td>";
							echo "</tr>";
							$i=$i+1;
						}
						echo "</tbody>";
						echo "</table>";
					}
				?>
			</div>
			<div id='salarydiv'>

			</div>
		</div>
	</div>

</body>
</html>
