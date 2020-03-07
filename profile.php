<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/basic.css">
	<link rel="stylesheet" href="css/profile.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script type="text/javascript" src="js/profile.js"></script>  
	<script type="text/javascript" src="js/basic.js"></script>   
</head>
<body>
	<?php
		@session_start();
		if (isset($_SESSION['login'])){
			$login=@$_SESSION['login'];
		}else{
			$login="NO";
		}
		if (@$_SERVER['HTTP_REFERER']=="http://localhost/project/search.php"){
			$fid=($_POST['fid']);
		}else{
			$fid=@$_SESSION['fid'];
			$acctype=@$_SESSION['acctype'];
		}
		$con=mysqli_connect("localhost", "root", "pass");
		mysqli_select_db($con,"fac_dash");
		$result = mysqli_query($con,"select * from fdbuser where fid=$fid") or die("Failed to query database".mysqli_error($con));
		$row= mysqli_fetch_array($result);
		$deptid=($row['deptid']);
		$_SESSION['deptid']=$deptid;
		$result = mysqli_query($con,"select * from department where deptid=$deptid") or die("Failed to query database".mysqli_error($con));
		$row= mysqli_fetch_array($result);
		$deptname=$row['deptname'];
	?>
	<div class="navbar_">
		<a style="font-size:30px; cursor:pointer; color: white; " onclick="openNav()">&#9776;</a>
		<h2 align="center" class="page-name" >PROFILE</h2>
		<em class="material-icons" onclick="openSearch()">search</em>
	</div>

	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="dashboard.php">Dashboard</a>
		<?php 
			if($login=="OK"){
				echo "<a href='profile.php'>Profile</a>";
				echo "<a href='loutprocess.php'>Logout</a>";
			}else{
				echo "<a href='main.php'>Login</a>";
			}
		?>
	</div>

	
	<div id="main" class="main">

		<div class="card">
			<?php
				echo "<img id='img' src='images/".$fid."' width='100%'/>";
		    ?>
		    <div class="container">
		    	<?php
			    	$con=mysqli_connect("localhost", "root", "pass");
					mysqli_select_db($con,"fac_dash");

					$result = mysqli_query($con,"select * from fdbuser where fid=$fid") or die("Failed to query database".mysqli_error());
					$row= mysqli_fetch_array($result);
					echo "<h1>".$row['fname']." ".$row['lname']."</h1>";
					echo "<h3><i>Faculty ID:</i> ".$row['fid']."</h3>";
					echo "<h3><i>Department:</i> ".$deptname."</h3>";
					echo "<h3><i>Position:</i> ".$row['fposition']."</h3>";
					echo "<h3><i>Phone Number:</i> ".$row['phone']."</h3>";
					echo "<h3><i>Email:</i> ".$row['email']."</h3>";
			    ?>
		  	</div>
		</div>

		<form action="timetable.php" method="post" accept-charset="utf-8">
			<input class="btn" id="timetablebtn" type="submit" name="timetable" value="timetable">
		</form>
		<?php 
			if ($_SERVER['HTTP_REFERER']!='http://localhost/project/search.php'){
					echo "<form action='editform.php' method='post' accept-charset='utf-8'>";
					echo "<input class='btn' type='submit' name='edit' value='edit'>";
					echo "</form>";
					if ($acctype=='faculty'){
						echo "<form action='leaveform.php' method='post' accept-charset='utf-8'>";
					}else{
						echo "<form action='leaveformhod.php' method='post' accept-charset='utf-8'>";
					}
					echo "<input class='btn' id='leavebtn' type='submit' name='leaves' value='leaves'>";
					echo "</form>";
					echo "<form action='schedule.php' method='post' accept-charset='utf-8'>";
					echo "<input class='btn' id='schedulebtn' type='submit' name='schedule' value='schedule'>";
					echo "</form>";
					echo "<form action='secques.php' method='post' accept-charset='utf-8'>";
				echo "<input class='btn' id='secquesbtn' type='submit' name='secques' value='security'>";
				echo "</form>";
			}
		?>
		<div class="tabordion">
				<section id="section1">
		    		<input type="radio" name="sections" id="option1" checked>
		    		<label for="option1">Academic</label>
		    		<article>
		      			<h2>Academic Details</h2>
		      			<?php
		      				$con=mysqli_connect("localhost", "root", "pass");
							mysqli_select_db($con,"fac_dash");
							$result = mysqli_query($con,"select * from fdbuser where fid=$fid") or die("Failed to query database".mysqli_error());
							$row= mysqli_fetch_array($result);
							$facsince=$row['facsince'];
							$facsince=strtotime($facsince);
							$facyear= date("Y",$facsince);
							$now = new DateTime();
							$now= $now->format('Y');
							$exp=$now-$facyear;
		      				echo "<h4><i>Experience:</i> ".$exp." years</h4>";
							$fcourses=$row['courses'];
		      				echo "<h4><i>Courses handled currently: </i>".$fcourses."</h4>";
		      				echo "<h4><i>Educational Qualifications: </i><h4>";
		      				$sql1 = "SELECT * FROM academicinfo where fid=$fid order by year desc";
							$result1 = $con->query($sql1);
		      				if($result1->num_rows==0){
								echo "<h4>None</h4>";
							}else{
			      				echo "<table class='table table-striped table-bordered tposition'>";
			  					echo "<thead>"; 
							    echo "<tr>";
							    echo "<th scope='col'><b>Qualification</b></th>";
								echo "<th scope='col'><b>College/University</b></th>";
								echo "<th scope='col'><b>Year of Graduation</b></th>";
			    				echo "</tr>";
								echo "</thead>";
								echo "<tbody>"; 
								while($row = $result1->fetch_assoc()) {
									echo "<tr>";
									echo "<td>".$row['qualification']."</td>";
									echo "<td>".$row['place']."</td>";
									echo "<td>".$row['year']."</td>";
									echo "</tr>";
								}
								echo "</tbody>";
								echo "</table>";
							}
		      			?>
		    </article>
		  	</section>
		  	<section id="section3">
		    	<input type="radio" name="sections" id="option3">
		    	<label for="option3">Publications</label>
		    	<article>
		     		<h2>Papers/Projects</h2>
		     		<?php
		     			$sql2 = "SELECT * FROM papers where fid=$fid and visibility='Show' order by pdate desc";
						$result2 = $con->query($sql2);
		      			if($result2->num_rows==0){
							echo "<h4>None</h4>";
						}else{
			      		echo "<table class='table table-striped table-bordered tposition'>";
			  			echo "<thead>"; 
						echo "<tr>";
						echo "<th scope='col'><b>Title</b></th>";
						echo "<th scope='col'><b>Published in</b></th>";
						echo "<th scope='col'><b>Date of Publication</b></th>";
						echo "<th scope='col'><b>Link</b></th>";
			    		echo "</tr>";
						echo "</thead>";
						echo "<tbody>"; 
						while($row = $result2->fetch_assoc()) {
							echo "<tr>";
							echo "<td>".$row['title']."</td>";
							echo "<td>".$row['publishedin']."</td>";
							echo "<td>".$row['pdate']."</td>";
							echo "<td><a href='".$row['link']."'>View Publication>></a></td>";
							echo "</tr>";
						}
						echo "</tbody>";
						echo "</table>";
						}
					?>
		    	</article>
		  	</section>
		  	<section id="section4">
		    	<input type="radio" name="sections" id="option4">
		    	<label for="option4">Acheievements</label>
		    	<article>
		      		<h2>Faculty Acheievements</h2>
		      		<?php
		      			$sql3 = "SELECT * FROM acheivement where fid=$fid and visibility='Show' order by adate desc";
						$result3 = $con->query($sql3);
		      			if($result3->num_rows==0){
							echo "<h4>None</h4>";
						}else{
			      		echo "<table class='table table-striped table-bordered tposition'>";
			  			echo "<thead>"; 
						echo "<tr>";
						echo "<th scope='col'><b>#</b></th>";
						echo "<th scope='col'><b>Award</b></th>";
						echo "<th scope='col'><b>Receieved on</b></th>";
			    		echo "</tr>";
						echo "</thead>";
						echo "<tbody>"; 
						$i=1;
						while($row = $result3->fetch_assoc()) {
							echo "<tr>";
							echo "<td>".$i."</td>";
							echo "<td>".$row['aname']."</td>";
							echo "<td>".$row['adate']."</td>";
							echo "</tr>";
							$i=$i+1;
						}
						echo "</tbody>";
						echo "</table>";
						}
			      	?>
			    </article>
		  	</section>
		  	<section id="section5">
		    	<input type="radio" name="sections" id="option5">
		    	<label for="option5">Events</label>
		    	<article>
		      		<?php
			      		function event($sql){
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
									echo "</tr>";
									$i=$i+1;
								}
								echo "</tbody>";
								echo "</table>";
								return 1;
							}
							return 0;
			      		}
		      			echo "<h2>Events Conducted</h2>";
		      			$sql = "SELECT * FROM workshop where fid=$fid and visibility='Show' and attended='Conducted' order by wdate desc";
						event($sql);
			      		echo "<h2>Events Attended</h2>";
		      			$sql = "SELECT * FROM workshop where fid=$fid and visibility='Show' and attended='Attended' order by wdate desc";
		      			event($sql);
			      	?> 
			    </article>
		  	</section>
		  	<section id="section2">
		    	<input type="radio" name="sections" id="option2">
		    	<label for="option2">Other</label>
		    	<article>
		      		<h2>Other Details</h2>
		      		<?php
		      			$result = mysqli_query($con,"select * from otherinfo where fid=$fid") or die("Failed to query database".mysqli_error());
						$row= mysqli_fetch_array($result);
		      			echo "<h4><i>Clubs handled: </i>".$row['clubs']."</h4>";
		      			echo "<h4><i>Date of Birth: </i>".$row['dob']."</h4>";
		      			echo "<h4><i>Blood Group: </i>".$row['bloodgrp']."</h4>";
			      	?>
			    </article>
		  	</section>
		</div>
	</div>
</body>
</html>
