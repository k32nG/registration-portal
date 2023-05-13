<?php
error_reporting(E_ALL ^ E_NOTICE);

require_once('config.php');
require_once('user.php');

// define variables and set to empty values
$nameErr = $emailErr = $passwordErr = "";
$name = $email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// validate name
	if (empty($_POST["name"])) {
	  $nameErr = "Name is required";
	} else {
	  $name = test_input($_POST["name"]);
	  if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
		$nameErr = "Only letters and white space allowed";
	  }
	}
  
	// validate email
	if (empty($_POST["email"])) {
	  $emailErr = "Email is required";
	} else {
	  $email = test_input($_POST["email"]);
	  // check if email is valid
	  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailErr = "Invalid email format";
	  }
	}
  
	// validate password
	if (empty($_POST["password"])) {
	  $passwordErr = "Password is required";
	} else {
	  $password = test_input($_POST["password"]);
	}
  
	// if no errors, sanitize data and insert into database
	if (empty($nameErr) && empty($emailErr) && empty($passwordErr)) {
	  // create new user object
	  $user = new User($conn);
	  // sanitize input data to prevent SQL injection attacks
	  $userName = mysqli_real_escape_string($conn, $name);
	  $email = mysqli_real_escape_string($conn, $email);
	  $password = mysqli_real_escape_string($conn, $password);
	
	  
	  // check if user was successfully created
	  if ($user->createUser($userName, $password, $email)) {
		// User was successfully created
		header("location: index.php");
		exit();
		} else {
			// User creation failed
			echo "Error: Could not create user.";
		}
	}
  }
  
  // function to sanitize input data
  function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
  }  

?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration Page</title>
</head>
<body>
	<header>
        <?php require_once 'header.php'; ?> 
        <h1>Create an Account</h1>
    </header>
	<main class="container">
		<form action="register.php" method="post">
			<div class="form-group">
				<label for="name">Name:</label>
				<input type="text" class="form-control" id="name" name="name" required><br>
				<label for="email">Email:</label>
				<input type="email" class="form-control" id="email" name="email" required><br>
				<label for="password">Password:</label>
				<input type="password" class="form-control" id="password" name="password" required><br>
				<hr>
				<input type="submit" class="btn btn-primary" value="Register">
			</div>
		</form>
	</main>
	<?php require_once 'footer.php'; ?> 
</body>
</html>