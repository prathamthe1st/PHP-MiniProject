<?php
// Retrieve the selected event type from the POST parameter
$eventType = $_POST["eventType"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventhub";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare a SQL statement to retrieve data from the selected table
$stmt = $conn->prepare("SELECT * FROM $eventType");

// Execute the prepared statement
$stmt->execute();

// Retrieve the results from the executed statement
$results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Close the database connection
$conn->close();

// Encode the results as JSON and send them back to the client
echo json_encode($results);
?>
