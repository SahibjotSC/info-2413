<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
$con = mysqli_connect('localhost', 'root', '', 'phplogin');
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$stmt = $con->prepare('SELECT * FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($id, $username, $password, $infoID, $superuser, $email, $phone);
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
	<div class="content">
		<nav class="navtop">
			<div>
				<h1>Budget Management System</h1>
				<a href="home.php"><i class="fas fa-user-circle"></i>Home</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="">
			<div class="profile">
			<div class="content">
			  <h1>Edit Profile</h1>
			  <form action="">
				<fieldset>
				  <div>
					<label for="username">UserName</label>
				  </div>
				  <div>
					<input type="text" value ="<?php echo $username; ?>" id="username" tabindex="1" />
				  </div>
				</fieldset>
				
				<fieldset>
				  <div>
					<label for="nickname">Nickname</label>
				  </div>
				  <div>
					<input type="text" id="nickname" tabindex="2" />
				  </div>
				</fieldset>
				<fieldset>
				  <div>
					<label for="email">Email</label>
				  </div>
				  <div>
					<input type="text" value ="<?php echo $email; ?>" id="email" tabindex="2" />
				  </div>
				</fieldset>
				<fieldset>
				  <div>
					<label for="phone">Phone Number</label>
				  </div>
				  <div>
					<input type="text" value ="<?php echo $phone; ?>" id="phone" tabindex="2" />
				  </div>
				</fieldset>
				<fieldset>
				  <div>
					<label for="lname">Birthday</label>
				  </div>
				  <div>
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
			</div>
	</body>
</html>