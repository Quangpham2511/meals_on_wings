<?php
require("settings.php");
session_start();
if (isset($_SESSION["username"])) {
    header("location: restaurant.php");
}

function sanitise_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="description" content="Technology Design Project"/>
	<meta name="key words" content="HTML, CSS, JavaScript"/>
	<meta name="author" content="Lucy Sturge"/>
	<link rel="stylesheet" href="styles/style.css"/>
	<title> Login Page </title>
</head>
<body>

	<nav><ul>
		<li id="title"><strong>Meals on Wings </strong></li>
		<li><a href="Login.php" id="loginnav" class="nav"> Login </a></li>
		<li><a href="Register.html" class="enav" class="nav"> Register </a></li>
		<li><a href="slogin.php" class="enav" class="nav">Staff </a></li>
		<li><a href="home.html" class="enav" class="nav"> Home </a></li>

	</ul>
</nav>
<section id="form">
	
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<h2 id="Welcome">Login</h2>
    <p> Please enter your email and password</p>
		<p><input type="email" name="email" class="input"  size="10" required="required" placeholder="Email"></p>
	<p><input type="password" name="password" class="input" size="10" required="required" placeholder="Password"></p>
<p><input type="submit" value="login" id="login"/></p>
<p class="forgot">Forgot Password?</p>
	</form>
<p class="forgot"> By clicking continue, you agree to our <strong>Terms of Service</strong> and <strong>Privacy Policy</strong></p>
	</section>
<footer>
		<section id="section1">
		<p>
		   <strong> Meals on Wings </strong>
		</p>
		<p>
			<img src="images/icons.png" alt="icons" id="icon"> 
		</p>
		</section>
		<section id="section2">
			<ul>
				<li><a href="Register.html" class="enav" class="nav"> Contact Us </a></li>
				<li><a href="Login.html" class="enav" class="nav"> Security  </a></li>
				<li><a href="homepage.html" class="enav" class="nav"> Help </a></li>
		
			</ul>
	
		</section>

	</footer>
	<?php
    $errMsg = "";
    if (empty($_POST["email"]))
        $errMsg .= " .";
    else {
        $username = sanitise_input($_POST["Email"]);
    }
    if (empty($_POST["password"])) {
        $errMsg .= ". ";
    } else {
        $password = $_POST["password"];
        }



    if ($errMsg != "") {
        echo "$errMsg";
    } else {

        $sql_table = "registration";
        $query = "select rname from $sql_table WHERE email='$username' and password='$password'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo "<p>Something is wrong with", $query, "<p>";
        } else {
            $_SESSION["email"] = $username;
            header("location: restaurant.php");
        }
    }
	?>