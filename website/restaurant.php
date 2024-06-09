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
    <title>Restaurant Interface</title>
</head>
<body>

    <nav>
        <ul>
            <li id="title"><strong>Meals on Wings</strong></li>
            <li><form method="post" action="logout.php">
<input type="submit" value="logout" class="logoutnav" name="logout"/>
</form></li>
        </ul>
        <h2 id="name">Great Restaurant</h2>
    </nav>
    <section id="break">
    <a href="neworder.php" id="new"> New Order </a>
        
       
        </section>
        <fieldset>
            <?php
            
           if (!$conn) {
               echo "<p>Database connection failure</p>";
            } else {
                $sql_table = "Orders";
               $query = "SELECT orderNo, firstName, lastName FROM Orders";
               $result = mysqli_query($conn, $query);
              

                if ($result->num_rows > 0) {
                    echo '<div class="table-container">'; 
                    echo '<table>'; 
                    echo '<tr><th>Order Number</th><th>Customer Name</th><th colspan="2">Status</th></tr>'; 
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row["orderNo"] . '</td>';
                        echo '<td>' . $row["firstName"] . ' ' . $row["lastName"] . '</td>';
                        echo '<td colspan="2">Drone ETA</td>';
                        echo '</tr>';
                    }
                    
                    echo '</table>'; 
                    echo '</div>'; 
                } else {
                  echo '<section id=panda><p>No Orders Yet!</p>';
                    echo '<img src="images/snooze.jpg" alt="panda"></section>';
              }
           }
                ?>
                
        </fieldset>
   
  
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
</body>
</html>
