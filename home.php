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
	header("Location: home.php?error=connectionfailed");
	exit();
}
if ($stmt = $con->prepare('SELECT * FROM categories')) {
	$stmt->execute();
	foreach ($stmt->get_result() as $row)
	{
		$array[] = $row['name'];
	}
	$stmt->close();
} else header("Location: home.php?error=failed");

if ($stmt = $con->prepare('SELECT superuser FROM accounts where username = ?')) {
	$stmt->bind_param('s', $_SESSION['name']);
	$stmt->execute();
	$stmt->bind_result($superuser);
	$stmt->fetch();
	$stmt->close();
}

if ($stmt = $con->prepare('SELECT * FROM changes')) {
	$stmt->execute();
	$changes = 0;
	$remaining = 0;
	foreach ($stmt->get_result() as $changeRow)
	{
		if ($changeRow['type'] == "inc") $remaining = $remaining + $changeRow['value'];
		else if ($changeRow['type'] == "exp") $remaining = $remaining - $changeRow['value'];
		$changes++;
	}
	$stmt->close();
} else header("Location: home.php?error=failed");

if ($superuser == 1 && $changes < 1) {
	$startBudget = 0;
} else $startBudget = 1;

$homeType = '';
$message = '';

if(isset($_GET['category']))
{
	$homeType = 'category';
	if($_GET['category'] == 'connectionfailed')
	{
		$message = '<h6 class="error">*Failed to connect to MySQL</h6>';
	}
	else if ($_GET['category'] == 'incomplete')
	{
		$message = '<h6 class="error">*Please input all required values</h6>';
	}
	else if ($_GET['category'] == 'empty')
	{
		$message = '<h6 class="error">*Please input all required values</h6>';
	}
	else if ($_GET['category'] == 'catagrydoesexist')
	{
		$message = '<h6 class="error">*Catagory does not exist</h6>';
	}
	else if ($_GET['category'] == 'failed')
	{
		$message = '<h6 class="error">*Catagory update failed</h6>';
	}
	else if ($_GET['category'] == 'success')
	{
		$message = '<h6 class="success">*Catagory update successful</h6>';
	}
}
else if(isset($_GET['change']))
{
	$homeType = 'change';
	if($_GET['change'] == 'connectionfailed')
	{
		$message = '<h6 class="error">*Failed to connect to MySQL</h6>';
	}
	else if ($_GET['change'] == 'incomplete')
	{
		$message = '<h6 class="error">*Please input all required values</h6>';
	}
	else if ($_GET['change'] == 'empty')
	{
		$message = '<h6 class="error">*Please input all required values</h6>';
	}
	else if ($_GET['change'] == 'incorrecttype')
	{
		$message = '<h6 class="error">*Error with type of change</h6>';
	}
	else if ($_GET['change'] == 'catagrydoesntexist')
	{
		$message = '<h6 class="error">*Catagory does not exist</h6>';
	}
	else if ($_GET['change'] == 'failed')
	{
		$message = '<h6 class="error">*Update failed</h6>';
	}
	else if ($_GET['change'] == 'success')
	{
		$message = '<h6 class="success">*Update successful</h6>';
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<script src="sorttable.js"></script>
	</head>
	<body>
		<div class="hero">
			<nav class="navtop">
				<div>
					<h1>Budget Management System</h1>
					<a href="profile.php"> </i>Profile</a>
					<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
				</div>
			</nav>
			<div class="content">
				<h2>Home Page</h2>
				<p>Welcome back, <?=$_SESSION['name']?>!
				<?php
				if ($startBudget == 0) {
					echo 'Set the initial budget below:';
				} else if ($superuser == 0 && $changes < 1){
					echo 'Waiting for super user to start budget...';
				} else echo 'Remaining budget: $'.$remaining;
				?>
				</p>
				<?php
				if ($startBudget == 0) {
					echo ("
						<div class='add'>
							<div class='add__container'>
								<form id='login' action='submit_change.php' method='post'>
									<input type='hidden' name='type' value='inc'>
									<input type='hidden' name='category' value='None'>
									<input type='hidden' name='description' value='Initial Budget'>

									<input type='number' class='add__value' name='value' placeholder='Value' required>
									<input type='submit' class='add__btn' type='button' value='UPDATE'>
								</form>
							</div>
						</div>
					");
				}
				?>
			</div>
			<div class="outer-container">
				<div id="container">
					<h1>Expenses/Income</h1>

					<table class="sortable">
						<thead>
						<tr>
							<th>Type</th>
							<th>Description</th>
							<th>Value</th>
							<th>Catagory</th>
							<th>Date Modified</th>
							<th>User</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$con = mysqli_connect('localhost', 'root', '', 'phplogin');
						if ($stmt = $con->prepare('SELECT * FROM changes')) {
							$stmt->execute();
							$result = $stmt->get_result();
							$indexCount = $result->num_rows;
							if($indexCount > 0) {
								while($row = $result->fetch_assoc()) {
									$description[] = $row['description'];
									$value[] = $row['value'];
									$type[] = $row['type'];
									$category[] = $row['category'];
									$changesID[] = $row['changesID'];
									$dateOf[] = $row['dateOf'];
									$accountName[] = $row['accountName'];
								}
							}
							//header("Location: home.php?error=failed".$indexCount);
							//$indexCount = 10;
								

						for($index=0; $index < $indexCount; $index++) {
							$name=$description[$index];
							
							if ($type[$index] == "inc") $typeIcon = "plus";
							else if ($type[$index] == "exp") $typeIcon = "minus";
							else $typeIcon = "";

							echo("
							<tr class='file $typeIcon'>
								<td><a class='name hidden $typeIcon'>$typeIcon</a></td>
								<td><a class='name'>$description[$index]</a></td>
								<td><a class='name'>$$value[$index]</a></td>
								<td><a class='name'>$category[$index]</a></td>
								<td><a class='name'>$dateOf[$index]</a></td>
								<td><a class='name'>$accountName[$index]</a></td>
								<td><a class='name'>
									<form action='remove_change.php' method='post'>
										<button name='changesID' value='$changesID[$index]'>Remove</button>
									</form>
								</a></td>
							</tr>"
							);
						}
						$stmt->close();
						} else header("Location: home.php?error=failed");
						?>
						</tbody>
					</table>
				</div>
			</div>
			<?php
			if ($startBudget != 0) {
				echo "
				<div class='inner-fabs'>
					<div class='fab round change-category' id='fab4' data-tooltip='Add Category'><img src='tag.png' width='38px' height='38px'></div>
					<div class='fab round change-trigger' id='fab3' data-tooltip='Add Expense/Income'><img src='change.png' width='38px' height='38px'></div>
				</div>
				<div class='fab round' id='fab1'><img src='+.png' id='fabIcon' width='56px' height='56px'></div>
				";
			}
			?>
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
						<?php if ($homeType == 'change') echo $message; ?>
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
								<input type="text" class="add__description" name="description" placeholder="Add description" required>
								<input type="number" class="add__value" name="value" placeholder="Value" required>
								
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
						<?php if ($homeType == 'category') echo $message; ?>
						<div class="add__container">
							<form id="login" action="submit_category.php" method="post">
								<input type="text" class="add__description" name="name" placeholder="Category Name" required>
								<input type="text" class="add__description" name="description" placeholder="Description">
								<input type="submit" class="add__btn" type='button' value="ADD CATEGORY">
							</form>
							<form id="login" action="remove_category.php" method="post">
								<select class="add__type" name="category">
									<?php
									foreach ($array as $row)
									{
										echo "<option value=", $row, " selected>", $row, "</option>";
									}
									?>
								</select>
								<input type="submit" class="add__btn" type='button' value="REMOVE CATEGORY">
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
		</div>
		<?php 
		if ($homeType == 'change') echo '<script type="text/javascript"> toggleChange(); </script>';
		else if ($homeType == 'category') echo '<script type="text/javascript"> toggleCategory(); </script>';
		?>
	</body>
</html>