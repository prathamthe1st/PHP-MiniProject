<?php

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

  // Prepare a SQL query to fetch the events for the selected date with event_confirmation = 0
  $stmt = $conn->prepare("
    SELECT event_name, event_description, event_start_date, event_end_date, event_start_time, event_end_time, event_venue, event_mode, event_link
    FROM event_data
    WHERE  event_confirmation = 0
  ");

  // Bind the $date parameter to the query
  // $stmt->bind_param("s", $date);

  // Execute the query
  $stmt->execute();

  // Fetch the results as an associative array
  $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

  // Encode the results as JSON and send them back to the client
  echo json_encode($results);

  ?>