<?php
	session_start();
	header('location:index.html');
	
	$conn = mysqli_connect('localhost', 'root', '');
	mysqli_select_db($conn, 'test1');
	
	$uname = $_POST["uname"];
	$psw = $_POST["psw"];
	
	$s = "select * from registration where uname = '$uname'";
	$result = mysqli_query($conn, $s);
	$num = mysqli_num_rows($result);
	
	if($num == 1) {
		echo "Username Already Taken";
	}
	else {
		$reg = " insert into registration(uname , psw) values ('$uname', '$psw')";
		mysqli_query($conn, $reg);
		echo "Registration Sucessful";
	}
?>