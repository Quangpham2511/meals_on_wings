<?php
require("settings.php");
session_start();

if (!isset($_SESSION["email"])) {
    header("location: Login.php");
    exit(); // Ensure the script stops executing after the redirect
}

$conn = @mysqli_connect(
    $host,
    $user,
    $pwd,
    $sql_db
);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $errMsg = "";

    if (empty($_POST["firstName"])) {
        $errMsg .= "<p>Please enter first name</p>";
    } else {
        $firstName = sanitise_input($_POST["firstName"]);
    }
    if (empty($_POST["lastName"])) {
        $errMsg .= "<p>Please enter last name</p>";
    } else {
        $lastName = sanitise_input($_POST["lastName"]);
    }
    if (empty($_POST["streetNumber"])) {
        $errMsg .= "<p>Please enter street number</p>";
    } else {
        $streetNumber = sanitise_input($_POST["streetNumber"]);
    }
    if (empty($_POST["streetName"])) {
        $errMsg .= "<p>Please enter street name</p>";
    } else {
        $streetName = sanitise_input($_POST["streetName"]);
    }
    if (empty($_POST["state"])) {
        $errMsg .= "<p>Please enter state</p>";
    } else {
        $state = sanitise_input($_POST["state"]);
    }
    if (empty($_POST["country"])) {
        $errMsg .= "<p>Please enter country</p>";
    } else {
        $country = sanitise_input($_POST["country"]);
    }

    if ($errMsg != "") {
        echo "<p>$errMsg</p>";
    } else {
        // Prepare the SQL insert statement
        $query = "INSERT INTO Orders (firstName, lastName, streetNumber, streetName, state, country) VALUES ('$firstName', '$lastName', '$streetNumber', '$streetName', '$state', '$country')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo "<p>Something is wrong with the query: $query</p>";
        } else {
            echo "<p class='ok'>Successfully added order</p>";
            header("location: restaurant.php");
        }
    }
}
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="description" content="Technology Design Project"/>
    <meta name="keywords" content="HTML, CSS, JavaScript"/>
    <meta name="author" content="Lucy Sturge"/>
    <link rel="stylesheet" href="styles/style.css"/>
    <title>Restaurant Interface</title>
</head>
<body>
<a href="restaurant.php" class="previous">&laquo; Previous</a>
    <nav>
        <ul>
            <li id="title"><strong>Meals on Wings</strong></li>
            <li><form method="post" action="logout.php">
<input type="submit" value="logout" class="logoutnav" name="logout"/>
</form></li>
        </ul>
        <h2 id="name">Great Restaurant</h2>
    </nav>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
</head>
<body>
    <section id="food">
        <fieldset>
<h3> New Order</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="order">
        <p>
            <label>First Name</label>
            <input type="text" name="firstName" required>
        </p>
        <p>
            <label>Last Name</label>
            <input type="text" name="lastName" required>
        </p>
        <p>
            <label>Street Number</label>
            <input type="text" name="streetNumber" required>
        </p>
        <p>
            <label>Street Name</label>
            <input type="text" name="streetName" required>
        </p>
        <p>
            <label>State</label>
            <input type="text" name="state" required>
        </p>
        <p>
            <label>Country</label>
            <input type="text" name="country" required>
        </p>
        <p>
            <input type="submit" value="Submit" id="loginnav">
        </p>
    </form>
    </fieldset>
    </section>
</body>
  
<footer>
        <section id="section1">
            <p><strong>Meals on Wings</strong></p>
            <p><img src="images/icons.png" alt="icons" id="icon"></p>
        </section>
        <section id="section2">
            <ul>
                <li><a href="Register.html" class="enav" class="nav">Contact Us</a></li>
                <li><a href="Login.html" class="enav" class="nav">Security</a></li>
                <li><a href="homepage.html" class="enav" class="nav">Help</a></li>
            </ul>
        </section>
    </footer>