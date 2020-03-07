
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Edit profile</title>
	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/basic.css">
	<link rel="stylesheet" href="css/editform.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script type="text/javascript" src="js/basic.js"></script>    
</head>
<body>
	<?php
		@session_start();
		if (isset($_SESSION['login'])){
			$login=$_SESSION['login'];
			$fid=$_SESSION['fid'];
		}else{
			$login='NO';
		}

		$con=mysqli_connect("localhost", "root", "pass");
		mysqli_select_db($con,"fac_dash");
	?>
	<div class="navbar_">
		<a style="font-size:30px; cursor:pointer; color: white; " onclick="openNav()">&#9776;</a>
		<h2 align="center" class="page-name">EDIT PROFILE</h2>
		<em class="material-icons" onclick="openSearch()">search</em>
	</div>

	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href='dashboard.php'>Dashboard</a>
		<?php 
			if($login=='OK'){
				echo "<a href='profile.php'>Profile</a>";
				echo "<a href='loutprocess.php'>Logout</a>";
			}else{
				echo "<a href='main.php'>Login</a>";
			}
		?>
	</div>

	<div id="main" class="main mcard">
		<div class="position pwd">
			<div class="left">
				<h2>Edit Personal Details</h2>
			</div>
			<form action="editformbe.php" class="right" method="POST">
				<div class="form-group">
			    	<label for="opwd">Old Password:</label>
			    	<input type="password" class="form-control" id="opwd" name="opwd">
			  	</div>
			  	<div class="form-group">
			    	<label for="conopwd">Confirm Old Password:</label>
			    	<input type="password" class="form-control" id="conopwd" name="conopwd">
			  	</div>
			  	<div class="form-group">
			    	<label for="npwd">New Password:</label>
			    	<input type="password" class="form-control" id="npwd" name="npwd">
			  	</div>
			  	<button name="pwdsubbtn" value="pwdinfo" type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
		<div class="pedit position gap">
			<div class="left">
				<h2>Edit Personal Details</h2>
			</div>
			<?php
				$result1 = mysqli_query($con,"select * from fdbuser where fid=".$fid."");
				$row1= mysqli_fetch_array($result1);
			?>
			<form action="editformbe.php" class="pform right" method="POST">
			  	<div class="form-row">
			    	<div class="form-group col-md-6">
			    		<label for="fname">First Name</label>
			      		<input type="text" class="form-control" id="fname" name="fname" placeholder="FirstName" value=<?php echo " ".$row1['fname']." "?> >
			    	</div>
			    	<div class="form-group col-md-6">
			      		<label for="lname">Last Name</label>
			      		<input type="text" class="form-control" id="lname" name="lname" placeholder="LastName" value=<?php echo " ".$row1['lname']." "?> >
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label for="email">Email</label>
			    	<input type="text" class="form-control" id="email" name="email" placeholder="Email" value=<?php echo " ".$row1['email']." "?>>
			  	</div>
			  	<div class="form-group">
			    	<label for="phone">Phone Number</label>
			    	<input type="text" class="form-control" id="phone" name="phone" placeholder="PHNO" value=<?php echo " ".$row1['phone']." "?>>
			  	</div>
			  	<div>UPDATE PROFILE PICTURE
			  	</div>
			  	<button name="psubbtn" value="pinfo" type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
		<div class="pubadd position gap">
			<div class="left">
				<h2>Add Publications</h2>
			</div>
			<form class="right" method="POST" action="editformbe.php">
			  <div class="form-group">
			    <label for="title">Title</label>
			    <input type="text" class="form-control" id="title" name="title" placeholder="TITLE">
			  </div>
			  <div class="form-group">
			    <label for="pubin">Published in</label>
			    <input type="text" class="form-control" id="pubin" name="pubin" placeholder="PUBLISHED IN">
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-8">
			      <label for="link">Link</label>
			      <input type="text" class="form-control" id="link" name="link" placeholder="LINK">
			    </div>
			    <div class="form-group col-md-4">
			      <label for="date">Date</label>
		    <input class="form-control" type="date" value="2000-01-01" id="date" name="date">
			    </div>
			  </div>
			  <button type="submit" class="btn btn-primary" name="pubsubbtn" value="pubinfo">Add</button>
			</form>
		</div>
		<div class="pubhide position gap">
			<div class="left">
				<h2>Hide/Show Publications</h2>
			</div>
			<div class="right">
				<?php
		     			$sql2 = "SELECT * FROM papers where fid=$fid order by pdate desc";
						$result2 = $con->query($sql2);
		      			if($result2->num_rows==0){
							echo "<h4>Error</h4>";
						}else{
			      		echo "<table class='table table-striped table-bordered tposition'>";
			  			echo "<thead>"; 
						echo "<tr>";
						echo "<th scope='col'><b>Title</b></th>";
						echo "<th scope='col'><b>Published in</b></th>";
						echo "<th scope='col'><b>Date of Publication</b></th>";
						echo "<th scope='col'><b>Link</b></th>";
						echo "<th scope='col'><b>Visibility</b></th>";
						echo "<th scope='col'><b>Change Visibility</b></th>";
			    		echo "</tr>";
						echo "</thead>";
						echo "<tbody>"; 
						while($row = $result2->fetch_assoc()) {
							echo "<tr>";
							echo "<td>".$row['title']."</td>";
							echo "<td>".$row['publishedin']."</td>";
							echo "<td>".$row['pdate']."</td>";
							echo "<td><a href='".$row['link']."'>View Publication>></a></td>";
							echo "<td>".$row['visibility']."</td>";
							echo "<td><form id='form' method='POST' action='editformbe.php'>";
							echo "<input type='submit' name='phideshow' id='phideshow' value='Click'>";
							echo "<input type='hidden' id='pid' name='pid' value='".$row["pid"]."'>";
							echo "<input type='hidden' id='visibility' name='visibility' value='".$row["visibility"]."'></form></td>";
							echo "</tr>";
						}
						echo "</tbody>";
						echo "</table>";
						}
					?>
			</div>
		</div>
		<div class="achedit position gap">
			<div class="left">
				<h2>Add Acheivements</h2>
			</div>
			<form class="right" action="editformbe.php" method="POST">
			  <div class="form-row">
			    <div class="form-group col-md-8">
			      <label for="aname">Award</label>
			      <input type="text" class="form-control" id="aname" name="aname" placeholder="Name">
			    </div>
			    <div class="form-group col-md-4">
			      <label for="adate">Date</label>
				    <input class="form-control" type="date" value="2020-01-01" id="adate" name="adate">
			    </div>
			  </div>
			  <button type="submit" class="btn btn-primary" name="achsubbtn" value="achinfo">Add</button>
			</form>
		</div>
		<div class="achhide position gap">
			<div class="left">
				<h2>Hide/Show Acheievements</h2>
			</div>
			<div class="right">
				<?php
		      			$sql3 = "SELECT * FROM acheivement where fid=$fid order by adate desc";
						$result3 = $con->query($sql3);
		      			if($result3->num_rows==0){
							echo "<h4>Error</h4>";
						}else{
			      		echo "<table class='table table-striped table-bordered tposition'>";
			  			echo "<thead>"; 
						echo "<tr>";
						echo "<th scope='col'><b>#</b></th>";
						echo "<th scope='col'><b>Award</b></th>";
						echo "<th scope='col'><b>Receieved on</b></th>";
						echo "<th scope='col'><b>Visibility</b></th>";
						echo "<th scope='col'><b>Change Visibility</b></th>";
			    		echo "</tr>";
						echo "</thead>";
						echo "<tbody>"; 
						$i=1;
						while($row = $result3->fetch_assoc()) {
							echo "<tr>";
							echo "<td>".$i."</td>";
							echo "<td>".$row['aname']."</td>";
							echo "<td>".$row['adate']."</td>";
							echo "<td>".$row['visibility']."</td>";
							echo "<td><form id='form' action='editformbe.php' method='POST'>";
							echo "<input type='submit' name='achhideshow' id='achhideshow' value='Click'>";
							echo "<input type='hidden' id='aid' name='aid' value='".$row["aid"]."'>";
							echo "<input type='hidden' id='visibility' name='visibility' value='".$row["visibility"]."'></form></td>";
							echo "</tr>";
							$i=$i+1;
						}
						echo "</tbody>";
						echo "</table>";
						}
			      	?>
			</div>
		</div>
		<div class="eveadd position gap">
			<div class="left">
				<h2>Add Events</h2>
			</div>
			<form class="right" action="editformbe.php" method="POST">
			  <div class="form-group">
			    <label for="ename">Name</label>
			    <input type="text" class="form-control" id="ename" name="ename" placeholder="Name of the event">
			  </div>
			  <div class="form-group">
			    <label for="eplace">Place</label>
			    <input type="text" class="form-control" id="eplace" name="eplace" placeholder="Place conducted">
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="edate">Date</label>
			    <input class="form-control" type="date" value="2020-01-01" id="edate" name="edate">
			    </div>
			    <div class="form-group col-md-6">
					  <label for="int">In table</label>
					  <select class="form-control" id="int" name="int">
					    <option>Conducted</option>
					    <option>Attended</option>
					  </select>
			    </div>
			  </div>
			  <button type="submit" class="btn btn-primary" name="esubbtn" value="einfo">Add</button>
			</form>
		</div>
		<div class="evehide position gap">
			<div class="left">
				<h2>Hide/Show Events</h2>
			</div>
			<div class="right">
				<?php
				$sql = "SELECT * FROM workshop where fid=$fid order by attended, wdate desc";
				$con=mysqli_connect("localhost", "root", "pass");
							mysqli_select_db($con,"fac_dash");
			      			$result = $con->query($sql);
			      			if($result->num_rows==0){
								echo "<h4>None</h4>";
							}else{
					      		echo "<table class='table table-striped table-bordered tposition'>";
					  			echo "<thead>"; 
								echo "<tr>";
								echo "<th scope='col'><b>#</b></th>";
								echo "<th scope='col'><b>Name</b></th>";
								echo "<th scope='col'><b>Place</b></th>";
								echo "<th scope='col'><b>Date</b></th>";
								echo "<th scope='col'><b>In Table</b></th>";
								echo "<th scope='col'><b>Visibility</b></th>";
								echo "<th scope='col'><b>Change Visibility</b></th>";
					    		echo "</tr>";
								echo "</thead>";
								echo "<tbody>"; 
								$i=1;
								while($row = $result->fetch_assoc()) {
									echo "<tr>";
									echo "<td>".$i."</td>";
									echo "<td>".$row['wname']."</td>";
									echo "<td>".$row['wplace']."</td>";
									echo "<td>".$row['wdate']."</td>";
									echo "<td>".$row['attended']."</td>";
									echo "<td>".$row['visibility']."</td>";
									echo "<td><form id='form' action='editformbe.php' method='POST'>";
									echo "<input type='submit' name='whideshow' id='whideshow' value='Click'>";
									echo "<input type='hidden' id='wid' name='wid' value='".$row["wid"]."'>";
									echo "<input type='hidden' id='visibility' name='visibility' value='".$row["visibility"]."'></form></td>";
									echo "</tr>";
									$i=$i+1;
								}
								echo "</tbody>";
								echo "</table>";
							}
					?>
			</div>
		</div>
		<div class="oedit position gap">
			<div class="left">
				<h2>Edit Other Details</h2>
			</div>
			<form class="oform right" action="editformbe.php" method="POST">
					<?php
					$result1 = mysqli_query($con,"select * from otherinfo where fid=".$fid."");
					$row1= mysqli_fetch_array($result1);
					?>
				  <div class="form-group">
				    <label for="clubs">Clubs Handled</label>
				    <input type="text" class="form-control" id="clubs" name="clubs" placeholder="None" value=<?php echo " ".$row1['clubs']." "?> >
				  </div>
				  <div class="form-group">
				    <label for="dob">Date of Birth</label>
				    <input class="form-control" type="date" id="dob" name="dob" value=<?php echo " ".$row1['dob']." "?> >
				  </div>
				  <div class="form-group">
				    <label for="bg">Blood Group</label>
				    <input type="text" class="form-control" id="bg" name="bg" placeholder="X+" value=<?php echo " ".$row1['bloodgrp']." "?> >
				  </div>
				  <button name="osubbtn" value="oinfo" type="submit" class="btn btn-primary">Submit</button>
		</form>
		</div>
	</div>

</body>
</html>
