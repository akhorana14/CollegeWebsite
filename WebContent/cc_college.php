<!DOCTYPE HTML>
<HTML>
<HEAD>
<TITLE>College Corner</TITLE>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</HEAD>
<BODY>
<div class = "overlay" id="overlay1">
	<div class = "gui" id = "gui">
	<a name = "cancel" id = "cancel" onclick = "off(); return false" href = "">X</a>
	<h2 id = "login">Log In to College Corner </h2>
	<form action="cc_college.php" method="POST" id="popup">
	<a id = "username1">Username: </a>
	<input type="text" name="username" id = "username1"> <br>
	<a id = "password">Password: </a>
	<input type="text" name="password" id = "password"><br>
	<input type="submit" id = "submit">
	</form>
	</div>
	</form>
	</div>
	</div>

	<div class = "overlay" id="overlay2">
	<div class = "gui" id = "gui">
	<a name = "cancel" id = "cancel" onclick = "off(); return false" href = "">X</a>
	<h3 id = "signup">Sign Up to College Corner </h3>
	<form action="cc_college.php" method="POST" id="popup">
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
<?php
session_start(); // gets global variables
$name = $_SESSION["college"];
//  chooses which nvarbar to display if the user is logged in or not.
if ($_SESSION['loggedin'] == 1) {
	echo "<div class = 'topnav' id='topnav'>";
	echo "<form method='post' action='cc_college.php'>";
	echo "<a name='log' id='user' href='#' onClick='dropShow()'> Hello,        " . $_SESSION['username'] . "</a>";
	echo "</form>";
	echo "</div>";
} else {
	echo "<div class = 'topnav' id='topnav'>";
	echo "<form method='post' action='cc_college.php'>";
	echo "<a name='log' id='login' href = '?login' onClick = 'onLogin(); return false;' >Login</a>";
	echo "<a name='reg' id = 'register' href = '?register' onClick = 'onRegister(); return false;'>Register</a>";
	echo "</form>";
	echo "</div>";
}
if (isset($_GET['logout'])) {
	unset($_SESSION['username']);
	unset($_SESSION['loggedin']);
	header('Location: cc_college.php');
}
echo "<br>";
echo "<br>";
echo "<br>";
echo "<div class='dropdown'>";
echo "<div id='dropdown-content'>";
echo "<a href='#'> Settings </a>";
echo "<a bref='#''> Colleges </a>";
echo "<a href='?logout'> Logout </a>";
echo "	</div> ";
echo "</div>";
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
$sqlx = "SELECT Name from info WHERE name = '$name' or aliases = '$name'";
$resultx = mysqli_query($conn, $sqlx);
$name = mysqli_fetch_assoc($resultx);
$name = $name['Name'];

$sql = "SELECT Tuition, GPA, SAT, ACT, Writing, Acceptance FROM info WHERE name = '$name'";
$sql1 = "SELECT Name FROM info WHERE name = '$name'";
$sql2 = "SELECT Location FROM info WHERE name = '$name'";
$sql3 = "SELECT Picture1 FROM info WHERE name = '$name'";
$sql4 = "SELECT Picture2 FROM info WHERE name = '$name'";
$result = mysqli_query($conn, $sql);
$result1 = mysqli_query($conn, $sql1);
$result2 = mysqli_query($conn, $sql2);
$result3 = mysqli_query($conn, $sql3);
$result4 = mysqli_query($conn, $sql4);
$row = mysqli_fetch_assoc($result);
$nam = mysqli_fetch_assoc($result1);
$loc = mysqli_fetch_assoc($result2);
$pic1 = mysqli_fetch_assoc($result3);
$pic2 = mysqli_fetch_assoc($result4);
$nam = $nam['Name'];
$loc = $loc['Location'];
$pic1 = $pic1['Picture1'];
$pic2 = $pic2['Picture2'];
if ($row == 0) {
	echo "<script>window.alert('Error.')</script>";
} else {
// loops the heading of the table and display the results.
	echo "<img src='$pic1' width='450' height='350' align='left'>";
	echo "<img src='$pic2' width='450' height='350' align='right'>";
	echo "<CENTER><H1>$nam</H1></CENTER><BR>";
	echo "<CENTER><H2>$loc</H2></CENTER><BR><BR><BR><BR><BR>";
	echo "<CENTER><Table border='5' cellpadding='15'></CENTER>";
	foreach ($row as $key => $row) {
		echo "<TD><CENTER><B>$key : <BR><BR> $row <BR><BR></B></CENTER></TD>";
	}
	echo "</TABLE>";
}
// login details
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
	echo "<script>window.alert('Success, you can login now.')</script>";
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
			header('Location: cc_college.php');
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
