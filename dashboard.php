<?
	ini_set('mysql_connect_timeout',300);
	ini_set('default_socket_timeout',300);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Dashboard</title>
	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/basic.css">
	<link rel="stylesheet" href="css/dashboard.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script type="text/javascript" src="js/basic.js"></script>    
</head>
<body>
	<?php
		session_start();
			if ($_SESSION['login']=='OK'){
				$login=$_SESSION['login'];
			}else{
				$login='NO';
			}
	?>
	<div class="navbar_">
		<a style="font-size:30px; cursor:pointer; color: white; " onclick="openNav()">&#9776;</a>
		<h2 align="center" class="page-name">DASHBOARD</h2>
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
		<div class="banner">
			<div class="greetings">	
				<h1 align="center">WELCOME!</h1>
			</div>
			<div class="about aboutcard">
				<p>. </p>
				<h1 align="center"> AMRITA UNIVERSITY </h1>
				<?php
				echo "<img id='img' src='images/amrita' width='100%'/>";
				?>
			</div>
		</div>
		<div class="recent">
			<h2 align="center">Acheivements</h2>
			<div class="acheivements acard">
				
			</div>
			<h2 align="center">Evenets/Workshops</h2>
			<div class="events ecard">
				
			</div>
		</div>
	</div>

</body>
</html>
