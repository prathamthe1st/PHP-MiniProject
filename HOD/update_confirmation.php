<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventhub";
session_start();

// Retrieve the event ID from the POST data
$event_name = $_POST["event_name"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare a SQL query to update the event_confirmation value to 1 for the selected event
$stmt = $conn->prepare("
  UPDATE event_data SET event_confirmation = 1
  WHERE event_name = ?
");

// Bind the event name parameter to the query
$stmt->bind_param("s", $_POST["event_name"]);

// Execute the query
$stmt->execute();

// Check if the query was successful
if ($stmt->affected_rows > 0) {
  echo "Event confirmation updated";
  
} else {
  echo "Failed to update event confirmation";
}
?>
