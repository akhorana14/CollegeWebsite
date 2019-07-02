<!DOCTYPE HTML>
<HTML>

<HEAD>
	<TITLE>College Corner</TITLE>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<script src="index.js"></script>
</HEAD>
<BODY>
<video autoplay muted loop id="backgroundVideo">
  <source src="school (1).mp4" type="video/mp4">
</video> 
	
	
<?php 
session_start(); // gets global variables
//  chooses which nvarbar to display if the user is logged in or not.
if ($_SESSION['loggedin'] == 1) {
	echo "<div class = 'topnav' id='topnav'>";
	echo "<form method='post' action='cc_college.php'>";
	echo "<a name='log' id='user' href='#' onClick='dropShow()'> Hello,        " . $_SESSION['username'] . "</a>";
	echo "</form>";
	echo "</div>";
} else {
	echo "<div class = 'topnav' id='topnav'>";
	echo "<form method='post' action='index.php'>";
	echo "<a name='log' id='login' href = '?login' onClick = 'onLogin(); return false;' >Login</a>";
	echo "<a name='reg' id = 'register' href = '?register' onClick = 'onRegister(); return false;'>Register</a>";
	echo "</form>";
	echo "</div>";
}
if (isset($_GET['logout'])) {
	unset($_SESSION['username']);
	unset($_SESSION['loggedin']);
	header('Location: index.php');
}
?>
<h1 id="name">College Corner</h1>
<form action="" method="POST">
<input type="text" placeholder="   Start Searching Colleges  " class="search" name="college">

<img src="https://images.vexels.com/media/users/3/143356/isolated/preview/64e14fe0195557e3f18ea3becba3169b-search-magnifying-glass-by-vexels.png" id="search"
onclick="document.forms('search').submit()"/>
<input type="submit" value="" name="submit" id="search">
</form>
<div class = "overlay" id="overlay1">
	<div class = "gui" id = "gui">
	<a name = "cancel" id = "cancel" onclick = "off(); return false" href = "">X</a>
	<h2 id = "login">Log In to College Corner </h2>
	<form action="index.php" method="POST" id="popup">
	<a id = "username1">Username: </a>
	<input type="text" name="username" id = "username1"> <br>
	<a id = "password">Password: </a>
	<input type="text" name="password" id = "password"><br>
	<input type="submit" id = "submit">
	</form>  
	</div> 
	</div>
	
	<div class = "overlay" id="overlay2">
	<div class = "gui" id = "gui">
	<a name = "cancel" id = "cancel" onclick = "off(); return false" href = "">X</a>
	<h3 id = "signup">Sign Up to College Corner </h3>
	<form action="index.php" method="POST" id="popup">
	<a id = "email">Email: </a>
	<input type="email" id = "email" name="email" required> <br>
	<a id = "username">Username: </a>
	<input type="text" name="username1" id = "username" required> <br>
	<a id = "password">Password: </a>
	<input type="text" name="password1" id = "password" required><br>
	<a id = "gpa">GPA: </a>
	<input type="text" id = "gpa" name="GPA"><br>
	<a id = "act">ACT: </a>
	<input type="text" id = "act" name="ACT"><br>
	<a id = "sat">SAT: </a>
	<input type="text" id = "sat" name="SAT"><br>
	<input type="submit" id = "submit1">
	</form>
	</div>
	</div>
<br>
<br>   
<div class="dropdown">
	<div id="dropdown-content">
		<a href="#"> Settings </a>
		<a bref="#"> Colleges </a>
		<a href="?logout"> Logout </a>
	</div>
</div>
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
	$sql = "SELECT * FROM info WHERE name = '$name'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
	if ($row == 0) {
		echo "<script>window.alert('Try searching a different school.')</script>";
	} else {
		$_SESSION['college'] = $name;
			echo "<script>window.alert('$name')</script>";
			header("Location: cc_college.php");
	}

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
			$_SESSION['loggedin'] = true; // allows for a different navbar for logged in users.
			$_SESSION['username'] = $username;
			// loops the heading of the table and display the results.
			foreach ($row as $key => $row) {
				echo $key . "  ";
				echo $row;
				echo "<br>";
			}
			header('Location: index.php');

			}
		}
	}
?>
<script>
	var shown = false;
	function dropShow() {
		if(shown == true)
			{ dropHide(); }else{
				shown = true;
				document.getElementById('dropdown-content').style.display = 'block';
			}
	}
	function dropHide() {
		document.getElementById('dropdown-content').style.display = 'none';
		shown = false;
	}
	function onLogin() {
	document.getElementById("overlay1").style.display = "block";
}
function onRegister() {
	document.getElementById("overlay2").style.display = "block";
}
function off() {
  document.getElementById("overlay1").style.display = "none";
	document.getElementById("overlay2").style.display = "none";
}
	</script>
</BODY>
</HTML>
