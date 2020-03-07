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
		$fid=$_SESSION['fid'];
		$con=mysqli_connect("localhost", "root", "pass");
		mysqli_select_db($con,"fac_dash");
		$sqld= "SELECT deptid FROM fdbuser WHERE fid=$fid";
		$resultd=mysqli_query($con,$sqld);
		$rowd=mysqli_fetch_assoc($resultd);
		$deptid=$rowd['deptid'];
		if(isset($_POST['pwdsubbtn'])){
			$opwd=$_POST['opwd'];
			$conopwd=$_POST['conopwd'];
			$npwd=$_POST['npwd'];
			if ($opwd==$conopwd){
				$result = mysqli_query($con,"select * from login where fid='$fid'") or die("Failed to query database".mysqli_error($con));
				$row= mysqli_fetch_array($result);
				if ($opwd==$row['pwd']){
					$sql = "UPDATE login SET pwd='".$npwd."' WHERE fid=".$fid."";
					$con->query($sql);
					echo '<script type="text/javascript">'; 
					echo 'alert("Password Updated");'; 
					echo 'window.location.href = "main.php";';
					echo '</script>';
				}else{
					echo "<script type='text/javascript'>alert('Wrong Password');window.location.href='editform.php';</script>";
				}
			}else{
				echo "<script type='text/javascript'>alert('Passwords do not match');window.location.href='editform.php';</script>";
			}
		}
		if (isset($_POST['psubbtn'])){
			$fname = $_POST['fname'];
			$lname= $_POST['lname'];
			$email= $_POST['email'];
			$phone= $_POST['phone'];
			$sql = "UPDATE fdbuser SET fname='".$fname."' WHERE fid=".$fid."";
			$con->query($sql);
			$sql = "UPDATE fdbuser SET lname='".$lname."' WHERE fid=".$fid."";
			$con->query($sql);
			$sql = "UPDATE fdbuser SET email='".$email."' WHERE fid=".$fid."";
			$con->query($sql);
			$sql = "UPDATE fdbuser SET phone='".$phone."' WHERE fid=".$fid."";
			$con->query($sql);
			echo "<script type='text/javascript'>alert('Updated Successfully');window.location.href='editform.php';</script>";
		}
		if (isset($_POST['pubsubbtn'])){
			$title = $_POST['title'];
			$pubin= $_POST['pubin'];
			$link= $_POST['link'];
			echo $link;
			$date= $_POST['date'];
			$visibility="Show";
			$pid=rand(0000,9999);
			$sql = "INSERT INTO papers(pid,title, link, pdate, fid,publishedin, visibility) VALUES (?,?,?,?,?,?,?)";
			$stmt = mysqli_prepare($con,$sql);
			$stmt->bind_param("sssssss", $pid,$title,$link,$date,$fid,$pubin,$visibility);
			$stmt->execute();
			echo "<script type='text/javascript'>alert('Added Successfully');window.location.href='editform.php';</script>";
		}
		if (isset($_POST['phideshow'])){
			$pid=$_POST['pid'];
			$visibility=$_POST['visibility'];
			if ($visibility=="Show"){
				$visibility="Hide";
			}else{
				$visibility="Show";
			}
			$sql = "UPDATE papers SET visibility='".$visibility."' WHERE fid=".$fid." AND pid=".$pid."";
			$con->query($sql);
			echo "<script type='text/javascript'>alert('Updated Successfully');window.location.href='editform.php';</script>";
		}
		if (isset($_POST['pubsubbtn'])){
			$title = $_POST['title'];
			$pubin= $_POST['pubin'];
			$link= $_POST['link'];
			$date= $_POST['date'];
			$visibility="Show";
			$pid=rand(0000,9999);
			$sql = "INSERT INTO papers(pid,title, link, pdate, fid,publishedin, visibility) VALUES (?,?,?,?,?,?,?)";
			$stmt = mysqli_prepare($con,$sql);
			$stmt->bind_param("sssssss", $pid,$title,$link,$date,$fid,$pubin,$visibility);
			$stmt->execute();
			echo "<script type='text/javascript'>alert('Added Successfully');window.location.href='editform.php';</script>";
		}
		if (isset($_POST['phideshow'])){
			$pid=$_POST['pid'];
			$visibility=$_POST['visibility'];
			if ($visibility=="Show"){
				$visibility="Hide";
			}else{
				$visibility="Show";
			}
			$sql = "UPDATE papers SET visibility='".$visibility."' WHERE fid=".$fid." AND pid=".$pid."";
			$con->query($sql);
			echo "<script type='text/javascript'>alert('Updated Successfully');window.location.href='editform.php';</script>";
		}
		if (isset($_POST['achsubbtn'])){
			$aname = $_POST['aname'];
			$adate= $_POST['adate'];
			$visibility="Show";
			$aid=rand(00000,99999);
			$sql = "INSERT INTO acheivement(aid,aname, adate,fid, visibility) VALUES (?,?,?,?,?)";
			$stmt = mysqli_prepare($con,$sql);
			$stmt->bind_param("sssss", $aid,$aname,$adate,$fid,$visibility);
			$stmt->execute();
			echo "<script type='text/javascript'>alert('Added Successfully');window.location.href='editform.php';</script>";
		}
		if (isset($_POST['achhideshow'])){
			$aid=$_POST['aid'];
			$visibility=$_POST['visibility'];
			if ($visibility=="Show"){
				$visibility="Hide";
			}else{
				$visibility="Show";
			}
			$sql = "UPDATE acheivement SET visibility='".$visibility."' WHERE fid=".$fid." AND aid=".$aid."";
			$con->query($sql);
			echo "<script type='text/javascript'>alert('Updated Successfully');window.location.href='editform.php';</script>";
		}
		if (isset($_POST['esubbtn'])){
			$ename = $_POST['ename'];
			$edate= $_POST['edate'];
			$eplace=$_POST['eplace'];
			$int=$_POST['int'];
			$visibility="Show";
			$wid=rand(0000,9999);
			$sql = "INSERT INTO workshop(wid,wname, wdate,wplace,attended,fid, visibility) VALUES (?,?,?,?,?,?,?)";
			$stmt = mysqli_prepare($con,$sql);
			$stmt->bind_param("sssssss", $wid,$ename,$edate,$eplace,$int,$fid,$visibility);
			$stmt->execute();
			echo "<script type='text/javascript'>alert('Added Successfully');window.location.href='editform.php';</script>";
		}
		if (isset($_POST['whideshow'])){
			$wid=$_POST['wid'];
			$visibility=$_POST['visibility'];
			if ($visibility=="Show"){
				$visibility="Hide";
			}else{
				$visibility="Show";
			}
			$sql = "UPDATE workshop SET visibility='".$visibility."' WHERE wid=".$wid." AND fid=".$fid."";
			$con->query($sql);
			echo "<script type='text/javascript'>alert('Updated Successfully');window.location.href='editform.php';</script>";
		}
		if (isset($_POST['osubbtn'])){
			$dob = $_POST['dob'];
			$clubs= $_POST['clubs'];
			$bg= $_POST['bg'];
			$sql = "UPDATE otherinfo SET clubs='".$clubs."' WHERE fid=".$fid."";
			$con->query($sql);
			$sql = "UPDATE otherinfo SET dob='".$dob."' WHERE fid=".$fid."";
			$con->query($sql);
			$sql = "UPDATE otherinfo SET bloodgrp='".$bg."' WHERE fid=".$fid."";
			$con->query($sql);
			echo "<script type='text/javascript'>alert('Updated Successfully');window.location.href='editform.php';</script>";
		}
	?>
</body>
</html>