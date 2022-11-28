<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
$con = mysqli_connect('localhost', 'root', '', 'phplogin');
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
	<div class="hero">
		<nav class="navtop">
			<div>
				<h1>Website Title</h1>
				<a href="home.php"><i class="fas fa-user-circle"></i>Home</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="wrapper">
			<div class="profile">
			<div class="content">
			  <h1>Edit Profile</h1>
			  <form action="">
				<fieldset>
				  <div class="grid-35">
					<label for="fname">First Name</label>
				  </div>
				  <div class="grid-65">
					<input type="text" id="fname" tabindex="1" />
				  </div>
				</fieldset>
				<fieldset>
				  <div class="grid-35">
					<label for="lname">Last Name</label>
				  </div>
				  <div class="grid-65">
					<input type="text" id="lname" tabindex="2" />
				  </div>
				</fieldset>
				<fieldset>
				  <div class="grid-35">
					<label for="lname">Nickname</label>
				  </div>
				  <div class="grid-65">
					<input type="text" id="lname" tabindex="2" />
				  </div>
				</fieldset>
				<fieldset>
				  <div class="grid-35">
					<label for="lname">Email</label>
				  </div>
				  <div class="grid-65">
					<input type="text" id="lname" tabindex="2" />
				  </div>
				</fieldset>
				<fieldset>
				  <div class="grid-35">
					<label for="lname">Phone Number</label>
				  </div>
				  <div class="grid-65">
					<input type="text" id="lname" tabindex="2" />
				  </div>
				</fieldset>
				<fieldset>
				  <div class="grid-35">
					<label for="lname">Birthday</label>
				  </div>
				  <div class="grid-65">
					<input type="text" id="lname" tabindex="2" />
				  </div>
				</fieldset>
				<fieldset>
				  <input type="button" class="Btn cancel" value="Cancel" />
				  <input type="submit" class="Btn" value="Save Changes" />
				</fieldset>

			  </form>
			</div>
			</div>
			</div>
			</div>
	</body>
</html>