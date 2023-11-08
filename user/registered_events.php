<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventhub";
$type = $_GET["type"];

session_start();

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($type === "current") {
    $sql = "SELECT event_name FROM event_data WHERE event_end_date > CURDATE()";
  } else if ($type === "past") {
    $sql = "SELECT event_name FROM event_data WHERE event_end_date <= CURDATE()";
  } else {
    die("Invalid event type specified");
  }
$result = $conn->query($sql);

// Loop through the results and query each event table
while ($row = $result->fetch_assoc()) {
    $event_name = $row['event_name'];
  
    // Query the event table to see if user's email is present
    $event_table = $event_name;
    $email = $_SESSION["email"];
    $sql = "SELECT COUNT(*) as count FROM $event_table WHERE email = '$email'";
    $result2 = $conn->query($sql);
    $row2 = $result2->fetch_assoc();
  
    // If user's email is present, display it in the event-list
    if ($row2['count'] > 0) {
      echo "<p>$event_name: $email</p>";
    }
    else{
        echo "<p>$event_name: Not Registered for any events</p>";
    }
  }

?>