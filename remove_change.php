<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}

// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	header("Location: home.php?".$_POST['changesID']);
	exit();
}
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['changesID'])) {
	// Could not get the data that should have been sent.
	header("Location: home.php?".$_POST['changesID']);
	exit();
}
// Make sure the submitted registration values are not empty.
if ($_POST['changesID'] == "") {
	// One or more values are empty.
	header("Location: home.php?".$_POST['changesID']);
	exit();
}
if ($stmt = $con->prepare('SELECT * FROM changes WHERE changesID = ?')) {
	$stmt->bind_param('i', $_POST['changesID']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		if ($stmtt = $con->prepare('DELETE FROM changes WHERE changesID = ?')) {
			$stmtt->bind_param('i', $_POST['changesID']);
			$stmtt->execute();
			header("Location: home.php?".$_POST['changesID']);
			$stmt->close();
		} else {
			// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
			header("Location: home.php?".$_POST['changesID']);
		}
	} else {
		header("Location: home.php?".$_POST['changesID']);
		// Username doesnt exists
	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	header("Location: home.php?".$_POST['changesID']);
}
?>