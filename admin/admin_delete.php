<?php
// Retrieve the event name from the query parameter
$event_name = $_GET["name"];
echo '<script>console.log("Welcome to GeeksforGeeks!"); </script>';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventhub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare a SQL query to delete the event with the given name
$stmt = $conn->prepare("DELETE FROM event_data WHERE event_name = ?");

// Bind the $event_name parameter to the query
$stmt->bind_param("s", $event_name);

// Execute the query
$stmt->execute();

// Check if any rows were affected
if ($stmt->affected_rows > 0) {
  // If so, send a success message back to the client
  echo json_encode(array("message" => "Event deleted successfully"));
} else {
  // If not, send an error message back to the client
  echo json_encode(array("message" => "Error deleting event"));
}

// Close the database connection
$stmt->close();
$conn->close();
?>
