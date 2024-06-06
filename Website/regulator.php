<?php
require("settings.php");
session_start();

/* if (!isset($_SESSION["email"])) {
    header("location: Login.php");
    exit(); 
}*/

$conn = @mysqli_connect(
    $host,
    $user,
    $pwd,
    $sql_db
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="description" content="Technology Design Project"/>
    <meta name="keywords" content="HTML, CSS, JavaScript"/>
    <meta name="author" content="Lucy Sturge"/>
    <link rel="stylesheet" href="styles/style.css"/>
    <title>Flight Regulator Interface</title>
</head>
<body>

<ul>
            <li id="title"><strong>Meals on Wings</strong></li>
            <li><form method="post" action="logout.php">
<input type="submit" value="logout" class="logoutnav" name="logout"/>
</form>r</li>
        </ul>
        <h2 id="name">Flight Regulator</h2>
    </nav>
<h1> </h1>

<h3> Flight Path Location </h3>
<label for="location">Choose Location:</label>
</body>


<select name="location" id="location">
  <option value="Location1">Loction 1</option>
  <option value="Location2">Location 2</option>
  <option value="Location3">Location 3</option>
  <option value="Location4">Location 4</option>
</select>
<?php
$unregistered_drone = false;

if ($unregistered_drone) {
    echo '<p class="warning">Warning: Unregistered Drone Detected!</p>';
} else {
    echo '<p class="nowarning"> No unregistered drones detected </p>';
}
?>
<h3> Drone Status </h3>
<?php
if (!$conn) {
    echo "<p>Database connection failure</p>";
} else {
    $sql = "SELECT drone_id, location, battery_status FROM drones";
    $result = $conn->query($sql);

    if ($result) { // Check if the query was successful
        if ($result->num_rows > 0) {
            echo "<section class=table>";
            echo "<table>";
            echo "<tr><th>Drone ID</th><th>Location</th><th>Battery Status</th></tr>";

            while($row = $result->fetch_assoc()) {
                echo '<td>' . $row["drone_id"] . '</td>';
                echo '<td>' . $row["location"] . '</td>';
                echo '<td>' . $row["battery_status"] . '%</td>';
                echo '</tr>';
            }

            echo "</table>";
            echo "</section>";
        } else {
            echo '<p>No drones found</p>';
        }

        $result->free(); // Free the result set
    } else {
        echo '<p>Error in SQL query: ' . $conn->error . '</p>';
    }

    $conn->close(); // Close the database connection
}
?>


<section>
<h1> Insert Visualisation here</h1>
</section>


</body>