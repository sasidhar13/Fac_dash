<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Security Questions</title>
	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/basic.css">
	<script type="text/javascript" src="js/basic.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">   
</head>
<body>
	<div class="navbar_">
		<a style="font-size:30px; cursor:pointer; color: white; " onclick="openNav()">&#9776;</a>
		<h2 align="center" class="page-name">ANSWER THE SECURITY QUESTIONS</h2>
		<em class="material-icons" onclick="openSearch()">search</em>
	</div>

	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="dashboard.php">Dashboard</a>
		<a href='main.php'>Login</a>
	</div>
	<div id="main" class="main">
		<form action="secquesbe.php" method="POST">
			  	<div class="form-group">
			    	<label for="q1"><h3>What is your mother's maiden name?</h3></label>
			    	<input type="text" class="form-control" id="q1" name="q1" placeholder="Value1">
			  	</div>
			  	<div class="form-group">
			    	<label for="q2"><h3>What is your first pet's name?</h3></label>
			    	<input type="text" class="form-control" id="q2" name="q2" placeholder="Value2" >
			  	</div>
			  	<div class="form-group">
			    	<label for="q3"><h3>Where is your highschool located at?</h3></h3></label>
			    	<input type="text" class="form-control" id="q3" name="q3" placeholder="Value3" >
			  	</div>
			  	<div class="form-group">
			    	<label for="q4"><h3>Where is your hometown?</h3></label>
			    	<input type="text" class="form-control" id="q4" name="q4" placeholder="Value4" >
			  	</div>
			  	<div class="form-group">
			    	<label for="q5"><h3>What is your nickname?</h3></label>
			    	<input type="text" class="form-control" id="q5" name="q5" placeholder="Value5">
			  	</div>
			  	<button type="submit" class="btn btn-primary" name="lockedout" value="lockedout">Submit</button>
			</form>
	</div>

</body>
</html>
