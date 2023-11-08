<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventhub";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the selected event from the query string
$selectedEvent = $_GET["event"];

// Prepare the SQL statement to fetch the data for the selected event
$sql = "SELECT * FROM feedback_event WHERE event_name = '$selectedEvent'";

// Execute the SQL statement and fetch the result
$result = $conn->query($sql);

// Build an array of data
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($data, $row);
    }
}

// Close the database connection
$conn->close();

// Return the data as a JSON object
echo json_encode($data);
?>
