<?php

// Check if the form has been submitted
if(isset($_POST['event_modify'])) {
    // Get the form data
    $event_name = $_POST['event-name'];
    $event_start_date = $_POST['event-start-date'];
    $event_end_date = $_POST['event-end-date'];
    $event_start_time = $_POST['event-start-time'];
    $event_end_time = $_POST['event-end-time'];

 // Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventhub";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

    // Update the event in the database
    $sql = "UPDATE event_data SET event_name='$event_name', event_start_date='$event_start_date', event_end_date='$event_end_date',event_start_time='$event_start_time',event_end_time='$event_end_time' WHERE event_name='$event_name'";

    if (mysqli_query($conn, $sql)) {
        echo "Event updated successfully";
        header("Location: ../admin/admin.php");
    } else {
        echo "Error updating event: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
