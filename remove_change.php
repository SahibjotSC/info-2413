<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	header("Location: home.php?".$_POST['changesID']);
	exit();
}
if (!isset($_POST['changesID'])) {
	header("Location: home.php?".$_POST['changesID']);
	exit();
}
if ($_POST['changesID'] == "") {
	header("Location: home.php?".$_POST['changesID']);
	exit();
}
if ($stmt = $con->prepare('SELECT * FROM changes WHERE changesID = ?')) {
	$stmt->bind_param('i', $_POST['changesID']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		if ($stmtt = $con->prepare('DELETE FROM changes WHERE changesID = ?')) {
			$stmtt->bind_param('i', $_POST['changesID']);
			$stmtt->execute();
			header("Location: home.php?".$_POST['changesID']);
			$stmt->close();
		} else {
			header("Location: home.php?".$_POST['changesID']);
		}
	} else {
		header("Location: home.php?".$_POST['changesID']);
	}
	$stmt->close();
} else {
	header("Location: home.php?".$_POST['changesID']);
}
?>