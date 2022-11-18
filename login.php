<?php
	session_start();
	
	$conn = mysqli_connect('localhost', 'root', '');
	mysqli_select_db($conn, 'test1');
	
	$uname = $_POST["uname"];
	$psw = $_POST["psw"];
	
	$s = "select * from registration where uname = '$uname' && psw = '$psw'";
	$result = mysqli_query($conn, $s);
	$num = mysqli_num_rows($result);
	
	if($num == 1) {
		$_SESSION['uname'] = $uname;
		header('location:home.php');
	}
	else {
		header('location:index.html');
	}
?>