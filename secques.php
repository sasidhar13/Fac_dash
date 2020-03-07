<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="css/basic.css">
	<link rel="stylesheet" href="css/secques.css">
	<script type="text/javascript" src="js/basic.js"></script> 
	<script type="text/javascript" src="js/secques.js"></script>
	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Security Verification Questions</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
	<?php
		session_start();
		$fid=$_SESSION["fid"];
	?>
	<div class="navbar_">
		<a style="font-size:30px; cursor:pointer; color: white; " onclick="openNav()">&#9776;</a>
		<h2 align="center" class="page-name">Security Verification Questions</h2>
		<em class="material-icons" onclick="openSearch()">search</em>
	</div>

	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="dashboard.php">Dashboard</a>
		<a href="profile.php">Profile</a>
		<a href="loutprocess.php">Logout</a>
	</div>
	<div class='main' id="main">
		<div class="passconf">
			<form>
				<div class="form-group">
			    	<label for="pwd">Password:</label>
			    	<input type="password" class="form-control" id="pwd">
			  	</div>
			  	<div class="form-group">
			    	<label for="conpwd">Confirm Password:</label>
			    	<input type="password" class="form-control" id="conpwd">
			  	</div>
			  	<?php
			  		$con=mysqli_connect("localhost", "root", "pass");
					mysqli_select_db($con,"fac_dash");
					$result1 = mysqli_query($con,"select * from login where fid=".$fid."");
					$row1= mysqli_fetch_array($result1);
					$pwd=$row1['pwd'];
					echo "<input type='hidden' class='form-control' id='pwdreal' value=".$pwd.">";
				?>
			  	<button onclick="secquesOpen()" type="button" class="btn btn-primary" >Submit</button>
			</form> 
		</div>
		<div class="secques" id="secques">
			<?php
				$result1 = mysqli_query($con,"select * from secquesans where fid=".$fid."");
				$row1= mysqli_fetch_array($result1);
			?>
			<form action="secquesbe.php" method="POST">
				<h3> Edit your Security verification Questions and Answers </h3>
			  	<div class="form-group">
			    	<label for="q1">What is your mother's maiden name?</label>
			    	<input type="text" class="form-control" id="q1" name="q1" placeholder="Value1" value=<?php echo " ".$row1['q1']." "?> >
			  	</div>
			  	<div class="form-group">
			    	<label for="q2">What is your first pet's name?</label>
			    	<input type="text" class="form-control" id="q2" name="q2" placeholder="Value2" value=<?php echo " ".$row1['q2']." "?> >
			  	</div>
			  	<div class="form-group">
			    	<label for="q3">Where is your highschool located at?</label>
			    	<input type="text" class="form-control" id="q3" name="q3" placeholder="Value3" value=<?php echo " ".$row1['q3']." "?> >
			  	</div>
			  	<div class="form-group">
			    	<label for="q4">Where is your hometown?</label>
			    	<input type="text" class="form-control" id="q4" name="q4" placeholder="Value4" value=<?php echo " ".$row1['q4']." "?> >
			  	</div>
			  	<div class="form-group">
			    	<label for="q5">What is your nickname?</label>
			    	<input type="text" class="form-control" id="q5" name="q5" placeholder="Value5" value=<?php echo " ".$row1['q5']." "?> >
			  	</div>
			  	<button type="submit" class="btn btn-primary" name="subbtn" value="info">Submit</button>
			</form>
		</div>
	</div>

</body>
</html>
