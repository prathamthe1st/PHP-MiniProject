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
elseif($_SESSION['role'] !== 'user'){
  // Check if user is admin
    // Redirect to login page
    echo "You are not an user";
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
    <link rel="stylesheet" href="./user.css">
    <link rel="stylesheet" href="./btn.css">
    <title>Main Menu</title>

    </head>

    <body>
    <section class="wrapper">
        <!-- <div id="stars" style="z-index: -1; height:0; background: transparent;" ></div>
            <div id="stars2" style="z-index: -1; height:0; background: transparent;"></div>
            <div id="stars3" style="z-index: -1; height:0; background: transparent;"></div> -->

        <nav class="navbar navbar-expand-lg" style="background:#00b3b3">
        <div class="container-fluid ">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ms-auto">
                <li class="nav-item ms-2">

                <a class="nav-link " style="text-align:center" href="../about_us/about-us.html"
                    style="text-align: center;">About us</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" style="text-align:center" href="../login_page/login.html"
                    style="text-align: center;">Login</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" style="text-align:center" href="../Home/home.html"
                    style="text-align: center;">&#127968</a>

                </li>
            </ul>
            </div>
        </div>
        </nav>

        <div id="stars"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>

        <div style="display: flex;">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height:124vh">
            <svg class="bi me-2" width="40" height="32">
            <use xlink:href="#bootstrap"></use>
            </svg>
            <div class="sidebar-top-container">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false" fdprocessedid="58v23n"></button>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Sign Out</a></li>
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
                <img class="sidebar-icons" src="../assets/calendar.png" alt=""
                style="height: 30px;width: 30px; margin-right: 9px">
                <a href="./user.php" class="nav-link active text-white" id="calendar-link"> Calendar</a>
            </li>
            <li class="nav-item">
                <img class="sidebar-icons" src="../assets/eventcreate.png" alt=""
                style="height: 30px;width: 30px; margin-right: 9px">
                <a href="registered_events.html" class="nav-link text-white" id="create-event-link"> Registered Events</a>
            </li>
            <li class="nav-item">
                <img class="sidebar-icons" src="../assets/notify.png" alt=""
                style="height: 30px;width: 30px; margin-right: 9px">
                <a href="user_inbox.html" class="nav-link text-white" id="inbox-link"> Inbox</a>
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
            <div id="event-list" style="padding:10px ; list-style-type: none;"></div>
            <div class="register_form hidden" >
                <span class="close" style="position:absolute;right:17px;top:0px;font-size:40px">×</span>
                <div class="booking-form"style="background-color:rgb(255, 173, 51);text-align:center">
                <form action="./user_event_registration.php" method="post">
                    <input type="hidden" id="event_name" name="event_name" value="">
                    <div class="row">
                        <div class="form-group">
                        <span class="form-label">Enter your full Name</span>
                        <input class="form-control" name="name" type="text" style="width:700px" required>
                    </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                        <span class="form-label">Enter your roll no:</span>
                        <input class="form-control" name="roll_no" type="number" style="width:700px" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                        <span class="form-label">Which year are you currently in:</span>
                            <select class="form-control" name="year" style="width:700px" >
                            <option>--:--</option>
                            <option>FY</option>
                            <option>SY</option>
                            <option>TY</option>
                            <option>LY</option>
                            </select>
                            <span class="select-arrow"></span>
                        </div>
                    </div>
                    <button class="register_btn" type="submit" name="user_register_event" style="margin-top:15px">Submit</button>                
                </form>
                </div>
            </div>
            <div class="overlay hidden"></div>

            </div>
            <!-- <div id="myModal" class="modal"> -->


        </div>
        </div>

        <!-- </div> -->

    
    <script src="./user.js"></script>
    </section>

    </body>

    </html>

HTML;
echo $content;
}

?>


