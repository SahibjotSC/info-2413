<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	header("Location: index.php?register=connectionfailed");
	exit();
}
if (!isset($_POST['username'], $_POST['password'], $_POST['retypepassword'], $_POST['email'])) {
	header("Location: index.php?register=incomplete");
	exit();
}
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['retypepassword']) || empty($_POST['email'])) {
	header("Location: index.php?register=empty");
	exit();
}
if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
    header("Location: index.php?register=invalidusername");
	exit();
}
if ($_POST['password'] != $_POST['retypepassword']) {
	header("Location: index.php?register=retypepass&username=".$_POST['username']);
	exit();
}
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 3) {
	header("Location: index.php?register=passwordlength&username=".$_POST['username']);
	exit();
}
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		header("Location: index.php?register=userexist");
	} else {
		if ($stmt = $con->prepare('INSERT INTO accounts (username, email, password, superuser) VALUES (?, ?, ?, ?)')) {
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$isSuperUser = $_POST['issuperuser'] == "" ? false : true;
			$stmt->bind_param('sssi', $_POST['username'], $_POST['email'], $password, $isSuperUser);
			$stmt->execute();
			header("Location: index.php?register=success");
		} else {
			header("Location: index.php?register=failed");
		}
	}
	$stmt->close();
} else {
	header("Location: index.php?register=failed");
}
$con->close();
?>