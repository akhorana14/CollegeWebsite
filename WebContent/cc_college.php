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