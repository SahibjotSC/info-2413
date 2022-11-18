<!DOCTYPE html>
<html>
<head>
    <title>Budget Management System</title>
    <link rel="stylesheet" href="stylesheets/style.css">
</head>
<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="button"></div>
                <button type="button" class="toggle-button" onclick="login()">Login</button>
                <button type="button" class="toggle-button" onclick="register()">Register</button>
            </div>
            <form id="login" class="input-group" action="login.php" method="post">
                <input type="text" class="input-field" placeholder="Username" name="uname" required>
                <input type="password" class="input-field" placeholder="Password" name="psw" required>
                <input type="checkbox" class="check-box"><span>Remember Username</span>
                <button type="submit" class="submit-button">Login</button>
            </form>
            <form id="register" class="input-group" action="" method="post">
                <input id="username" type="text" class="input-field" placeholder="Username" name="uname" required> <span class="required error" id="username-info"></span>
                <input id="password" type="password" class="input-field" placeholder="Password" name="psw" onkeyup='check();' required>
                <input id="confirm_password" type="password" class="input-field" placeholder="Retype Password" name="repsw" onkeyup='check();' required>
                <input id="checkbox" type="checkbox" class="check-box" required><span>I agree to the terms & conditions</span>
				<input id="register-button" type="submit" class="submit-button" value="Register", onclick="return signupValidation()">
            </form>
        </div>
    </div>

    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("button");

        function register() {
            x.style.left = "-400px"
            y.style.left = "50px"
            z.style.left = "110px"
        }

        function login() {
            x.style.left = "50px"
            y.style.left = "450px"
            z.style.left = "0"
        }
		
		var check = function() {
		  if (document.getElementById('password').value ==
			document.getElementById('confirm_password').value) {
			document.getElementById('confirm_password').style.color = 'green';
			document.getElementById('confirm_password').innerHTML = 'matching';
			document.getElementById('register-button').visibility  = hidden;
		  } else {
			document.getElementById('confirm_password').style.color = 'red';
			document.getElementById('confirm_password').innerHTML = 'not matching';
			document.getElementById('register-button').visibility  = visible;
		  }
		}
		
		function signupValidation() {
			var valid = false;
			
			var Password = $('#psw').val();
			var ConfirmPassword = $('#repsw').val();
			
			if(Password != ConfirmPassword){
				alert("Password does not match");
				valid = false;
			}
			
			return valid;
		}
    </script>

</body>
</html>
