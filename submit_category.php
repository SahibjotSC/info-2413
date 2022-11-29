<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}

header('Location: home.php');

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	header("Location: home.php?category=connectionfailed");
	exit();
}
if (!isset($_POST['name'], $_POST['description'])) {
	header("Location: home.php?category=incomplete");
	exit();
}
if ($_POST['name'] == "") {
	header("Location: home.php?category=empty");
	exit();
}
if ($stmt = $con->prepare('SELECT * FROM categories WHERE name = ?')) {
	$stmt->bind_param('s', $_POST['category']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		header("Location: home.php?category=catagrydoesexist");
	} else {
		if ($stmtt = $con->prepare('INSERT INTO categories (name, description) VALUES (?, ?)')) {
			$stmtt->bind_param('ss', $_POST['name'], $_POST['description']);
			$stmtt->execute();
			header("Location: home.php?category=success");
			$stmt->close();
		} else {
			header("Location: home.php?category=failed");
		}
	}
	$stmt->close();
} else {
	header("Location: home.php?category=failed");
}
?>