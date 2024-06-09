<?php
require("settings.php");
session_start();

if (!isset($_SESSION["email"])) {
    header("location: Login.php");
    exit(); 
}

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
</form></li>
        </ul>
        <h2 id="name">Flight Regulation</h2>
    </nav>
<h1> </h1>

<h3 id="name"> Flight Path Location </h3>
<p id="name"> Choose Location:  


<select name="location" id="location">
  <option value="Location1">Location 1</option>
  <option value="Location2">Location 2</option>
  <option value="Location3">Location 3</option>
  <option value="Location4">Location 4</option>
</select>
</p>
<fieldset>
<fieldset>
<?php
$unregistered_drone = false;

if ($unregistered_drone) {
    echo '<p class="warning">Warning: Unregistered Drone Detected!</p>';
} else {
    echo '<p class="nowarning"> Unauthorised Drones: No unregistered drones detected </p>';
}
?>
</fieldset>
<h2> Drone Status </h2>
<?php
if (!$conn) {
    echo "<p>Database connection failure</p>";
} else {
    $sql = "SELECT drone_id, location, battery_status FROM drones";
    $result = $conn->query($sql);

    if ($result) { 
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

        $result->free(); 
    } else {
        echo '<p>Error in SQL query: ' . $conn->error . '</p>';
    }

    $conn->close(); 
}
?>
<h2 id="name"> Queue and Delivery Time Analysis</h2>
    <table>
        <thead>
            <tr>
                <th>Metrics</th>
                <th>Fixed Assignment (seconds)</th>
                <th>Dynamic 1 (seconds)</th>
                <th>Dynamic 2 (seconds)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Avg queue length</td>
                <td>17.7585</td>
                <td>119.58</td>
                <td>142.29</td>
            </tr>
            <tr>
                <td>Standard deviation of queue length</td>
                <td>18.28, 13.75, 26.60, 50.65</td>
                <td>70.02, 78.71, 122.78, 142.17</td>
                <td>126.87, 119.36, 190.72, 208.80</td>
            </tr>
            <tr>
                <td>Mean waiting time in queue</td>
                <td>33.33, 28.08, 33.30, 43.76</td>
                <td>169.29, 186.26, 191.90, 198.66</td>
                <td>223.90, 229.48, 223.48, 203.70</td>
            </tr>
            <tr>
                <td>Mean delivery time (time in queue + delivery)</td>
                <td>38.16, 33.26, 38.20, 48.96</td>
                <td>174.12, 191.43, 196.80, 203.86</td>
                <td>228.72, 234.66, 228.38, 208.90</td>
            </tr>
            <tr>
                <td>Standard deviation of the waiting time</td>
                <td>22.70, 21.02, 22.47, 36.51</td>
                <td>103.80, 126.62, 129.88, 126.82</td>
                <td>201.82, 206.30, 207.54, 190.33</td>
            </tr>
        </tbody>
    </table>
    <h2 id="name">Probability VS Drone and Depots</h2>
<section id="section1">
    <p>The probability vs the total number of UAVs curve</p>
<p><img src="images/Picture1.png" alt="icons" id="icon"></p>

</section>
<section id="section2">
    <p> probability for each depot</p>
<p><img src="images/Picture2.png" alt="icons" id="icon"></p>

</section>

<section>
<h1> Flight Path Visualisation</h1>
<p><img src="images/R.jpg" alt="icons" id="icon"></p>

</section>

</fieldset>

</body>