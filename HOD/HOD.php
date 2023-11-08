<?php
// Retrieve the selected date from the query parameter
// $date = $_GET["date"];
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  // Redirect to login page
  echo "You are not logged in";
  header('Location: ../login_page/login.html');
  exit();
}
elseif($_SESSION['role'] !== 'HOD'){
  // Check if user is admin
    // Redirect to login page
    echo "You are not an admin";
    header('Location: ../login_page/login.html');
    exit();
}
else{
  $content = <<<HTML
  <!DOCTYPE html>
<html lang="en">
<head>
  
   
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./HOD.css">

  <!-- Roboto Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <title>Admin Page</title>
    
</head>

<body>
  

  <section class="wrapper">
          <div id="stars" style="z-index: -1; height:0; background: transparent;" ></div>
          <div id="stars2" style="z-index: -1; height:0; background: transparent;"></div>
          <div id="stars3" style="z-index: -1; height:0; background: transparent;"></div>
    
          <nav class="navbar navbar-expand-lg"  style="background:#00b3b3">
              <div class="container-fluid ">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav  ms-auto">
                    <li class="nav-item">
  
                      <a class="nav-link "style="text-align:left" href="../about_us/about-us.html">About us</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link"style="text-align:left" href="../Home/home.html">&#127968</a>
                  </li>
                  </ul>
                </div>
              </div>
          </nav>
  
  <div style="display: flex;">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height:124vh">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <div class="sidebar-top-container">
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" fdprocessedid="58v23n"></button>
            <ul class="dropdown-menu" >
              <li><a class="dropdown-item" id="sign-out">Sign Out</a></li>
            </ul>
          </div>
        <div class="profile-pic">        
          <img src="../assets/admin1.png" alt="" style="height: 100px;width: 100px;border-radius: 50%;">        
        </div>
        <h5>{$_SESSION['email']}</h5>
      </div>    
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <img class="sidebar-icons" src="../assets/calendar.png" alt="" style="height: 30px;width: 30px;">
          <a href="/HOD/HOD.html"class="nav-link active text-white" id="calendar-link">Calendar</a>
        </li>
        <li class="nav-item">
          <img class="sidebar-icons" src="../assets/notify.png" alt="" style="height: 30px;width: 30px;">    
          <a href="./HOD_inbox.html"class="nav-link text-white" id="inbox-link">Inbox</a>
        </li>
      </ul>   
    </div>
    <div id="content" style="height: 100vh; width:90%">
      <div class="calendar">
        <div class="calendar-header">
          <button class="btn-prev">Prev</button>
          <h2 class="month-year"></h2>
          <button class="btn-next">Next</button>
        </div>
        <table class="calendar-body">
          <thead>
            <tr>
              <th>Sun</th>
              <th>Mon</th>
              <th>Tue</th>
              <th>Wed</th>
              <th>Thu</th>
              <th>Fri</th>
              <th>Sat</th>
            </tr>
          </thead>
          <tbody id="calendar-dates"></tbody>
          
        </table>
        
      </div>
      <!-- <div id="myModal" class="modal"> -->

        <!-- Modal content -->
        <div class="modal-content" id="myModal">
          <span class="close">×</span>
          <h2 id="date"></h2>
          <p>No events listed for now :(</p>
          <div id="event-list"></div>

        </div>
      <!-- <div id="myModal" class="modal"> -->
    
        
  </div>
  

  <script src="./HOD.js"></script>
</section>
  </body>
</html>  
HTML;
echo $content;
 
}

?>
