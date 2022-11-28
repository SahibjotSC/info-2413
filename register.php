<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	header("Location: index.php?register=connectionfailed");
	exit();
}
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['retypepassword'], $_POST['email'])) {
	// Could not get the data that should have been sent.
	header("Location: index.php?register=incomplete");
	exit();
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['retypepassword']) || empty($_POST['email'])) {
	// One or more values are empty.
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
// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		header("Location: index.php?register=userexist");
	} else {
		// Username doesnt exists, insert new account
		if ($stmt = $con->prepare('INSERT INTO accounts (username, email, password, superuser) VALUES (?, ?, ?, ?)')) {
			// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$isSuperUser = $_POST['issuperuser'] == "" ? false : true;
			$stmt->bind_param('sssi', $_POST['username'], $_POST['email'], $password, $isSuperUser);
			$stmt->execute();
			header("Location: index.php?register=success");
		} else {
			// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
			header("Location: index.php?register=failed");
		}
	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	header("Location: index.php?register=failed");
}
$con->close();
?>