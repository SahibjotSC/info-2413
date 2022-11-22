<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}

header('Location: home.php');

// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	header("Location: home.php?registererror=connectionfailed");
	exit();
}
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['name'], $_POST['description'])) {
	// Could not get the data that should have been sent.
	header("Location: home.php?registererror=incomplete");
	exit();
}
// Make sure the submitted registration values are not empty.
if (!isset($_POST['name'], $_POST['description'])) {
	// One or more values are empty.
	header("Location: home.php?registererror=empty");
	exit();
}
if ($stmt = $con->prepare('SELECT * FROM categories WHERE name = ?')) {
	$stmt->bind_param('s', $_POST['category']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		header("Location: home.php?registererror=catagrydoesexist");
	} else {
		// Username doesnt exists, insert new account
		if ($stmtt = $con->prepare('INSERT INTO categories (name, description) VALUES (?, ?)')) {
			$stmtt->bind_param('ss', $_POST['name'], $_POST['description']);
			$stmtt->execute();
			header("Location: home.php?signup=done");
			$stmt->close();
		} else {
			// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
			header("Location: home.php?signup=failed");
		}
	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	header("Location: home.php?signup=failed");
}
?>