<!DOCTYPE HTML>
<HTML>
<HEAD>
	<TITLE>College Corner</TITLE>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</HEAD>
<BODY>
<div class = "topnav" id="topnav">
	<form method="post" action="index.php">
	<a name="log" id="login" href = "?login">Login</a>
	<a name="reg" id = "register" href = "?register">Register</a>
</form>
</div>
<h1 id="name">College Corner</h1>
<form action="" method="POST">
<input type="text" placeholder="   Start Searching Colleges  " class="search" name="college">
<button name="search" id="search"></button>
</form>
<?php
/**
$servername = "db4free.net";
$username = "dahdave";
$password = "123456789";
$db = "college_corner";
 **/
$servername = "remotemysql.com";
$username = "tLRfZznYPZ";
$password = "Psw6T2l7OL";
$db = "tLRfZznYPZ";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// for data revolving around the search
if (isset($_POST['submit'])) {
	$name = $_POST['college'];
	$sql = "SELECT Location, Tuition, GPA, SAT, ACT, Writing, Acceptance FROM info WHERE name LIKE '$name'";
	$result = mysqli_query($conn, $sql);
	/* MYSQLI_query is a boolean */
	$row = mysqli_fetch_assoc($result); /* creates an assos array based on the query */
	if ($row == 0) {
		echo "Error. School not found.";
	} else {
		echo "<br><br><br><br>";
		// loops the heading of the table and display the results.
		foreach ($row as $key => $row) {
			echo $key . "  ";
			echo $row;
			echo "<br>";

		}
	}

}
// login details
if (isset($_GET['login'])) {
	echo "<br><br><br><br>";
	echo "<form action='index.php' method='POST' id='popup'>";
	echo "<input type='text' name='username' placeholder='Username'> <br>";
	echo "<input type='text' name='password' placeholder='Password'><br>";
	echo "<input type='submit'>";
	echo "</form>";

}
if (isset($_GET['register'])) {
	echo "<br><br><br><br>";
	echo "<form action='index.php' method='POST' id='popup'>";
	echo "<input type='email' name='email' placeholder='Email' required> <br>";
	echo "<input type='text' name='username1' placeholder='Username' required> <br>";
	echo "<input type='text' name='password1' placeholder='Password' required><br>";
	echo "<input type='text' name='GPA' placeholder='GPA'><br>";
	echo "<input type='text' name='ACT' placeholder='ACT'><br>";
	echo "<input type='text' name='SAT' placeholder='SAT'><br>";
	echo "<input type='submit'>";
	echo "</form>";

}
if (isset($_POST['email'])) // QUERY INTO THE DATABASE AND REGISTER.
{
	// $username2 = "jgeiI6GRFh";
	// $password2 = "htUnrVnZdz";
	$GPA = $_POST['GPA'];
	$EMAIL = $_POST['email'];
	$ACT = $_POST['ACT'];
	$SAT = $_POST['SAT'];
	$username = $_POST['username1'];
	$password = $_POST['password1'];
	$sql = "INSERT INTO `account` (`Username`, `Password`, `Email`, `GPA`, `SAT`, `ACT`) VALUES ('$username', '$password', '$EMAIL', '$GPA', '$SAT', '$ACT')";
	$result = mysqli_query($conn, $sql);
	/* MYSQLI_query is a boolean */
	/* creates an assos array based on the query */
	echo "<h1> Success, you can login now. </h1>";
}
if (isset($_POST['username'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	if (empty($username) || empty($password)) {
		echo "<script> window.alert('Error')</script>";
	} else {
		$sql = "SELECT * FROM account WHERE username = '$username' AND password = '$password'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		if ($row == 0) {
			echo "<script>window.alert('Invalid Username/Password')</script>";
		} else {
			// loops the heading of the table and display the results.
			foreach ($row as $key => $row) {
				echo $key . "  ";
				echo $row;
				echo "<br>";

			}
		}
	}
}
?>

</BODY>
</HTML>