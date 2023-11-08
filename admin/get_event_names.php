<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventhub";

// Create a new PDO connection to the database
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$query = "SELECT event_name FROM event_data";
$stmt = $pdo->prepare($query);
$stmt->execute();
$eventNames = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Return the event names as a JSON object
echo json_encode($eventNames);

?>
