<?php
	session_start();
	if (!isset($_SESSION['uname'])) {
		header('location:login.php');
	}
?>

<html>
<body>
<h1>Welcome <?php echo $_SESSION['uname']; ?> </h1>
<a href="logout.php"> Logout </a>
</body>
</html>