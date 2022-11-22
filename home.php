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
	header("Location: home.php?registererror=connectionfailed");
	exit();
}
if ($stmt = $con->prepare('SELECT * FROM categories')) {
	$stmt->execute();
	foreach ($stmt->get_result() as $row)
	{
		$array[] = $row['name'];
	}
	$stmt->close();
} else header("Location: home.php?signup=failed");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
		<div class="hero">
			<nav class="navtop">
				<div>
					<h1>Website Titlsde</h1>
					<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
					<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
				</div>
			</nav>
			<div class="inner-fabs">
				<div class="fab round change-category" id="fab4" data-tooltip="Add Category"><img src="tag.png" width="38px" height="38px"></div>
				<div class="fab round change-trigger" id="fab3" data-tooltip="Add Expense/Income"><img src="change.png" width="38px" height="38px"></div>
			</div>
			<div class="fab round" id="fab1"><img src="+.png" id="fabIcon" width="56px" height="56px"></div>
			<script>
				let fab1 = document.getElementById("fab1");
				let innerFabs = document.getElementsByClassName("inner-fabs")[0];

				fab1.addEventListener("click", function () {
					innerFabs.classList.toggle("show");
				});

				document.addEventListener("click", function (e) {
					switch (e.target.id) {
						case "fab1":
						case "fab2":
						case "fab3":
						case "fab4":
						case "fabIcon":
							break;
						default:
							innerFabs.classList.remove("show");
							break;
					}
				});
			</script>
			<div class="modal changebox">
				<div class="modal-content" >
					<span class="close-button"></span>
					<div class="add">
						<div class="add__container">
							<form id="login" action="submit_change.php" method="post">
								<select class="add__type" name="type">
									<option value="inc" selected>+</option>
									<option value="exp">-</option>
								</select>
								<select class="add__type" name="category">
									<?php
									foreach ($array as $row)
									{
										echo "<option value=", $row, " selected>", $row, "</option>";
									}
									?>
								</select>
								<input type="text" class="add__description" name="description" placeholder="Add description">
								<input type="number" class="add__value" name="value" placeholder="Value">
								
								<input type="submit" class="add__btn" type='button' value="UPDATE">
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="modal categorybox">
				<div class="modal-content" >
					<span class="close-button"></span>
					<div class="add">
						<div class="add__container">
							<form id="login" action="submit_category.php" method="post">
								<input type="text" class="add__description" name="name" placeholder="Category Name">
								<input type="text" class="add__description" name="description" placeholder="Description">
								
								<input type="submit" class="add__btn" type='button' value="ADD CATEGORY">
							</form>
						</div>
					</div>
				</div>
			</div>
			<script>
				const categorybox = document.querySelector(".categorybox");
				const changebox = document.querySelector(".changebox");
				const changeTrigger = document.querySelector(".change-trigger");
				const categoryTrigger = document.querySelector(".change-category");

				function toggleChange() {
					changebox.classList.toggle("show-change");
				}
				
				function toggleCategory() {
					categorybox.classList.toggle("show-category");
				}

				function windowOnClick(event) {
					if (event.target === changebox) {
						toggleChange();
					}
					if (event.target === categorybox) {
						toggleCategory();
					}
				}

				changeTrigger.addEventListener("click", toggleChange);
				categoryTrigger.addEventListener("click", toggleCategory);
				window.addEventListener("click", windowOnClick);
			</script>
			<div class="content">
				<h2>Home Page</h2>
				<p>Welcome back, <?=$_SESSION['name']?>!</p>
			</div>
		</div>
	</body>
</html>