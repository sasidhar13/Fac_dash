<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search</title>
	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/basic.css">
	<link rel="stylesheet" href="css/search.css">
	<script type="text/javascript" src="js/basic.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
</head>
<body>
	<?php
		session_start();
		if (isset($_SESSION['login'])){
			$login=$_SESSION['login'];
		}else{
			$login='NO';
		}
	?>
	<div class="navbar_">
		<a style="font-size:30px; cursor:pointer; color: white; " onclick="openNav()">&#9776;</a>
		<h2 align="center" class="page-name">SEARCH</h2>
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

	<div class="main" id='main'>
	<div id='leftside'>	
		<div class="search_form" id='sform'>
		<ul class="nav nav-tabs nav-fill tab_font ">
			<li class="nav-item">
			    <a>Search by</a>
			</li>
			<li class="nav-item active">
			    <a class="nav-link" data-toggle="tab" href="#faculty">Faculty</a>
			</li>
	    	<li class="nav-item">
		    	<a class="nav-link" data-toggle="tab" href="#papers">Papers</a>
		    </li>
		    <li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#workshops">Seminars/Workshops</a>
		    </li>  
		</ul>
		<div class="tab-content">
			<div id="faculty" class="tab-pane fade in active">
	      		<h3>Search for faculty</h3>
	      		<form method="POST">
				 	<div class="form-group row">
				    	<label for="fac_id" class="col-sm-2 col-form-label">Faculty ID</label>
				    	<div class="col-sm-10">
				    		<input type="text" class="form-control" name="fac_id" placeholder="Faculty ID">
				    	</div>
				  	</div>
				  	<div class="form-row">
					    <div class="form-group col-md-6">
					      	<label for="fac_fname">First Name</label>
							<input type="text" class="form-control" id="fac_fname" name="fac_fname" placeholder="First Name">
					    </div>
					    <div class="form-group col-md-6">
					      	<label for="fac_lname">Last Name</label>
					      	<input type="text" class="form-control" id="fac_lname" name="fac_lname" placeholder="Last Name">
					    </div>
					</div>
				    <div class="form-group">
					    <label for="fac_dept">Department</label>
					    <select class="form-control" id="fac_dept" name="fac_dept">
					    	<option value='--'>--</option>
					        <option value='CSE'>CSE</option>
					      	<option value='ECE'>ECE</option>
					      	<option value='EEE'>EEE</option>
					      	<option value='IT'>IT</option>
					    </select>
					</div>
				    <div class="form-group">
					    <label for="fac_pos">Position</label>
					    <select class="form-control" id="fac_pos" name="fac_pos">
					        <option value='--'>--</option>
					        <option value="HOD">HOD</option>}
					       	<option value='Professor'>Professor</option>
					      	<option value='Assistant Professor'>Assistant Professor</option>
					    </select>
					</div>
				  <div class="form-group row">
				    <div class="col-sm-10">
				      <button type="submit" class="btn btn-primary">Search</button>
				    </div>
				  </div>
				</form>
		    </div>
		   	<div id="papers" class="tab-pane fade">
		   		<h3>Search for papers</h3>
	      		<p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	    	</div>
		   	<div id="workshops" class="tab-pane fade">
		  		<h3>Search for Workshops/Seminars</h3>
	      		<p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	    	</div>
    	</div>
    </div>
	</div>
	<div class="results">
		<?php
			public function display($sql){
				$con=mysqli_connect("localhost", "root", "pass");
				mysqli_select_db($con,"fac_dash");
				$result = $con->query($sql);
				if($result->num_rows==0){
					echo "<h3>No such user</h3>";
				}else{
					echo "<table class='table table-striped table-dark'>";
	  				echo "<thead class='thead-dark'>"; 
					echo "<tr>";
				    echo "<th scope='col'>#</th>";
					echo "<th scope='col'>fid</th>";
					echo "<th scope='col'>First Name</th>";
					echo "<th scope='col'>Last Name</th>";
					echo "<th scope='col'>Department</th>";
					echo "<th scope='col'>Position</th>";
					echo "<th scope='col'>Link to Profile</th>";
	    			echo "</tr>";
					echo "</thead>";
					echo "<tbody>"; 
					$i=1;
					while($row = $result->fetch_assoc()) {
						$result1 = mysqli_query($con,"select * from department where deptid=".$row['deptid']."");
						$row1= mysqli_fetch_array($result1);
						$deptname=$row1['deptname'];
						echo "<tr>";
						echo "<th scope='row'>".$i."</th>";
						echo "<td>".$row['fid']."</td>";
						echo "<td>".$row['fname']."</td>";
						echo "<td>".$row['lname']."</td>";
						echo "<td>".$deptname."</td>";
						echo "<td>".$row['fposition']."</td>";
						echo "<td><form  action='profile.php' method='POST'>";
						echo "<input type='submit' name='profile' id='profile' value='View Profile'>";
						echo "<input type='hidden' id='fid' name='fid' value='".$row["fid"]."'></form></td>";
						echo "</tr>";
						$i=$i+1;
					}
					echo "</tbody>";
					echo "</table>";
					return 1;
				}
				return 0;
			}
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				
				$con=mysqli_connect("localhost", "root", "pass");
				mysqli_select_db($con,"fac_dash");
				
				if (!empty($_POST['fac_id'])){
					$fid = $_POST['fac_id'];
					$sql = "SELECT * FROM fdbuser where fid=$fid";
					echo "<h3>Faculty ID search results</h3>";
					$result=display($sql);
				}
				if (!empty($_POST['fac_fname'])){
					$fname=$_POST['fac_fname'];
					echo "<h3>Faculty First Name search results</h3>";
					$sql = "SELECT * FROM fdbuser where fname='$fname'";
					display($sql);
				}
				if (!empty($_POST['fac_lname'])){
					echo "<h3>Faculty Last Name search results</h3>";
					$lname=$_POST['fac_lname'];
					$sql = "SELECT * FROM fdbuser where lname='$lname'";
					display($sql);
				}
				$pos=$_POST['fac_pos'];
				if ($pos!='--'){
					echo "<h3>Faculty position search results</h3>";
					$sql = "SELECT * FROM fdbuser where fposition='$pos'";
					display($sql);
				}
				$dept=$_POST['fac_dept'];
				if ($dept!='--'){
					echo "<h3>Faculty department search results</h3>";
					$result = mysqli_query($con,"select * from department where deptname= '$dept'") or die("Failed to query database".mysqli_error());
					$row= mysqli_fetch_array($result);
					$deptid=$row['deptid'];
					$sql = "SELECT * FROM fdbuser where deptid=$deptid";
					display($sql);
				}					
			}
		?>
	</div>
</div>

</body>
</html>
