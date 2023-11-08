<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventhub";

session_start();

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['new-event'])){
    $event_name = $_POST['event-name'];
    $event_start_date = $_POST['event-start-date'];
    $event_end_date = $_POST['event-end-date'];
    $event_start_time = $_POST['event-start-time'];
    $event_end_time = $_POST['event-end-time'];
    $event_mode = $_POST['event-mode'];
    $event_venue = implode(',', $_POST['event-venue']);
    $event_description = $_POST['event-description'];  
    $event_link = $_POST['event-link'];
    

    $stmt = $conn->prepare("INSERT INTO event_data (event_name, event_start_date, event_end_date, event_start_time, event_end_time, event_mode, event_venue, event_description, event_link) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $event_name, $event_start_date, $event_end_date, $event_start_time, $event_end_time, $event_mode, $event_venue, $event_description, $event_link);
    
    if ($stmt->execute()) {
        echo "New record created successfully";    
        $table_name = str_replace(' ', '_', $event_name); // replace spaces with underscores
        $sql = "CREATE TABLE ".$table_name." ( name VARCHAR(30) NOT NULL,email VARCHAR(30) NOT NULL ,  year INT(4) NOT NULL, roll_no INT(10) NOT NULL)";
        if ($conn->query($sql) === TRUE) {
            echo "Table created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    
    header("Location: ../admin/admin.php");
    exit();
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    
      // Close statement
      $stmt->close();

}



?>
