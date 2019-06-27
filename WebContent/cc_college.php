<!DOCTYPE HTML>
<HTML>
<HEAD>
<TITLE>College Corner</TITLE>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</HEAD>
<BODY>

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
echo "<form method='post' action='index.php'>";
echo "<a name='log' id='login' href = '?login'>Login</a>";
echo "<a name='reg' id = 'register' href = '?register'>Register</a>";
echo "</form>";
echo "</div>";
}

if (isset($_GET['logout'])) {
unset($_SESSION['username']);
unset($_SESSION['loggedin']);
header('Location: index.php');
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

$sql = "SELECT * FROM info WHERE name = '$name'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if ($row == 0) {
echo "<script>window.alert('Error.')</script>";

} else {
// loops the heading of the table and display the results.
foreach ($row as $key => $row) {
echo $key . "  ";
echo $row;
echo "<br>";

}
}

// login details
if (isset($_GET['login'])) {
	echo "<br><br><br><br>";
	echo "<div class = 'overlay' id='overlay'>";
	echo "<div class = 'gui' id = 'gui'>";
	echo "<a name = 'cancel' id = 'cancel' onclick = 'off(); return false' href = ''>X</a>";
	echo "<h2 id = 'login'>Log In to College Corner </h2>";
	echo "<form action='index.php' method='POST' id='popup'>";
	echo "<a id = 'username1'>Username: </a>";
	echo "<input type='text' name='username' id = 'username1'> <br>";
	echo "<a id = 'password'>Password: </a>";
	echo "<input type='text' name='password' id = 'password'><br>";
	echo "<input type='submit' id = 'submit'>";
	echo "</form>";
	echo "</div>";
	echo "</div>";

}
if (isset($_GET['register'])) {
	echo "<br><br><br><br>";
	echo "<div class = 'overlay' id='overlay'>";
	echo "<div class = 'gui' id = 'gui'>";
	echo "<a name = 'cancel' id = 'cancel' onclick = 'off(); return false' href = ''>X</a>";
	echo "<h3 id = 'signup'>Sign Up to College Corner </h3>";
	echo "<form action='index.php' method='POST' id='popup'>";
	echo "<a id = 'email'>Email: </a>";
	echo "<input type='email' id = 'email' name='email' required> <br>";
	echo "<a id = 'username'>Username: </a>";
	echo "<input type='text' name='username1' id = 'username' required> <br>";
	echo "<a id = 'password'>Password: </a>";
	echo "<input type='text' name='password1' id = 'password' required><br>";
	echo "<a id = 'gpa'>GPA: </a>";
	echo "<input type='text' id = 'gpa' name='GPA'><br>";
	echo "<a id = 'act'>ACT: </a>";
	echo "<input type='text' id = 'act' name='ACT'><br>";
	echo "<a id = 'sat'>SAT: </a>";
	echo "<input type='text' id = 'sat' name='SAT'><br>";
	echo "<input type='submit' id = 'submit1'>";
	echo "</form>";
	echo "</div>";
	echo "</div>";

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
</script>

</BODY>
</HTML>