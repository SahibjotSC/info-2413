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
	header("Location: home.php?change=connectionfailed");
	exit();
}
if (!isset($_POST['type'], $_POST['category'], $_POST['description'], $_POST['value'])) {
	header("Location: home.php?change=incomplete".$_POST['type']);
	exit();
}
if ($_POST['type'] == "" || $_POST['category'] == "" || $_POST['description'] == "" || $_POST['value'] == "") {
	header("Location: home.php?change=empty");
	exit();
}
if ($_POST['type'] != 'inc' && $_POST['type'] != 'exp') {
	header("Location: home.php?change=incorrecttype");
	exit();
}
if ($_POST['value'] < 1) {
	header("Location: home.php");
	exit();
}
if ($stmt = $con->prepare('SELECT * FROM categories WHERE name = ?')) {
	$stmt->bind_param('s', $_POST['category']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		if ($stmtt = $con->prepare('INSERT INTO changes (description, value, type, category, accountName) VALUES (?, ?, ?, ?, ?)')) {
			$stmtt->bind_param('sdsss', $_POST['description'], $_POST['value'], $_POST['type'], $_POST['category'], $_SESSION['name']);
			$stmtt->execute();
			header("Location: home.php");
		}
		else {
			header("Location: home.php?change=failed");
		}
		$stmtt->close();
	} else {
		header("Location: home.php?change=failed");
	}
	$stmt->close();
} else {
	header("Location: home.php?change=failed");
}

if ($stmt = $con->prepare('SELECT value FROM changes where description = ?')) {
	$var = 'Initial Budget';
	$stmt->bind_param('s', $var);
	$stmt->execute();
	$stmt->bind_result($initial);
	$stmt->fetch();
	$stmt->close();
}

if ($stmt = $con->prepare('SELECT * FROM changes')) {
	$stmt->execute();
	$remaining = 0;
	foreach ($stmt->get_result() as $changeRow)
	{
		if ($changeRow['type'] == "inc") $remaining = $remaining + $changeRow['value'];
		else if ($changeRow['type'] == "exp") $remaining = $remaining - $changeRow['value'];
	}
	$stmt->close();
}

if ($remaining < $initial * 0.2)
{
	if ($stmt = $con->prepare('SELECT * FROM accounts')) {
		$stmt->execute();
		foreach ($stmt->get_result() as $emailRow)
		{
			$msg = "Initial Funds: ".$initial." Remaining funds: ".$remaining;
			mail($emailRow['email'],"Low Funds Alert",$msg);
		}
		$stmt->close();
	}
}
?>