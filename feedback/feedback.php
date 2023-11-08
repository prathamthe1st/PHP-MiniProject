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

// Check if feedback_event table exists
$tableExists = $conn->query("SHOW TABLES LIKE 'feedback_event'")->num_rows > 0;

// Create feedback_event table if it doesn't exist
if (!$tableExists) {
    $sql = "CREATE TABLE feedback_event (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(50),
        event_name VARCHAR(50) NOT NULL,
        registration VARCHAR(50),
        experience VARCHAR(50),
        volunteers VARCHAR(50),
        conduction VARCHAR(50),
        mood VARCHAR(50),
        future VARCHAR(50),
        rate VARCHAR(50),
        comments VARCHAR(255)
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "Table feedback_event created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

if(isset($_POST['event_feedback'])){
    $email = $_SESSION["email"];
    $registration = $_POST['registration'];
    $experience = $_POST['experience'];
    $volunteers = $_POST['volunteers'];
    $event_type = $_POST['event-type'];
    $mood = $_POST['mood'];
    $more_event = $_POST['more-event'];
    $rate = $_POST['rate'];
    $comments = $_POST['comments'];
    $event_name = $_POST['event_name'];

    $stmt = $conn->prepare("INSERT INTO feedback_event (email ,event_name ,registration, experience, volunteers, conduction, mood, future, rate, comments) VALUES (?,?,?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $email,$event_name,$registration, $experience, $volunteers, $event_type, $mood, $more_event, $rate, $comments);
    
    if ($stmt->execute()) {
        echo "New record created successfully";    
        header("Location: ../user/user.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    // Close statement
    $stmt->close();
}
?>
