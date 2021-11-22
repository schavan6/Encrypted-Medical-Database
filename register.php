<?php 

//include 'config.php';

error_reporting(0);

session_start();


$server = "localhost";
$user = "root";
$pass = "root";
$database = "ads_project";
$port = 3307;



//$conn = mysqli_real_connect($server, $user, $pass, $database, $port);
$conn = new mysqli($server, $user, $pass, $database);

if($conn -> connect_error){
	die("connection failed! ". $conn -> connect_error);
}

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$pass = $_POST['password'];

	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);


	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";

		$result = $conn -> query($sql);
		
		if (!$result->num_rows > 0) {
			
			$sql = "INSERT INTO users(username, email, password) VALUES ('$username', '$email', '$password')";

			if ($result = $conn -> query($sql)) {
		  		
		  		$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
				echo "<script>alert('User Registration Completed.')</script>";
			}
			else {
				echo "<script>alert('Error: " . $conn->error." !')</script>";
			    
			}


			
		} else {
			echo "<script>alert('Email Already Exists!')</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched!')</script>";
	}
	$conn -> close();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Register Form</title>
	<style>
	a.sign_up {
        position: absolute;
        top: 30px;
        right: 90px;
        z-index: 2;
        font-size:20px;
        border-radius:0.12em;
        box-sizing: border-box;
        font-family:fantasy;
        font-weight: bold;
        font-weight: 400;
        padding:0.35em 1.2em;
        color:#FFFFFF;
        transition: all 0.2s;
        text-decoration:none;

    }
    a.sign_up:hover{
        color:#000000;
        background-color:#FFFFFF;
    }

	</style>
</head>
<body>
    <a class="sign_up" href="home.html">Home page</a>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text">Have an account? <a href="index.php">Login Here</a>.</p>
		</form>
	</div>
</body>
</html>