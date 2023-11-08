<?php
// create_event.php

// Here you can write your PHP code to generate the HTML code for the create event form
// and return it as a response.

// For example:

  



$content = <<<HTML
<div id="booking" class="section"style="align:center;height:120%">
      <div class="section-center">
        <div class="container">
          <div class="row">
            <div class="col-md-7 col-md-push-5">
              <div class="booking-cta" style="color:white">
                <h1>Create your Event</h1>
                <p>
                  We are thrilled that you are about to create a new event and we do believe that you and your team will certianly be able
                  to make this event a great success and a one to remember.
                </p>
                <h5>
                  Please follow the steps mentioned below on how to plan about your event.
                </h5>
                <ul type="disc" style="color:white">
                  <li><p>Fill the form alonside with all the necessary conditions mentioned</p></li>
                  <li><p>Select the total number of rooms/halls/campus area that you require for the event</p></li>
                  <li><p>Then click on room layout to view the rooms and book your rooms</p></li>
                  <li><p>After that on submission a request will be send to HOD</p></li>
                  <li><p>After the approval of event it shows up in the calendar</p></li>
                </ul>
              </div>
            </div>
            <div class="col-md-4 col-md-pull-7" style="background-color:rgb(255,153,0);margin-top:3%;">
              <div class="booking-form"style="background-color:rgb(255, 173, 51);">
                <form action="./new_event.php" method="post">
                  <div class="form-group">
                    <span class="form-label">Name of the Event</span>
                    <input class="form-control" type="text" name="event-name" placeholder="Enter your Event ame">
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <span class="form-label">Start Date</span>
                        <input class="form-control" type="date" name="event-start-date" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <span class="form-label">End Date</span>
                        <input class="form-control" type="date" name="event-end-date" required>
                      </div>
                    </div>	
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <span class="form-label">Start Time</span>
                        <input class="form-control" type="Time" name="event-start-time" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <span class="form-label">End Time</span>
                        <input class="form-control" type="time" name="event-end-time" required>
                      </div>
                    </div>	
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <span class="form-label">Mode</span>
                          <select class="form-control" name="event-mode">
                          <option>--:--</option>
                          <option>Online</option>
                          <option>Offline</option>
                          <option>Hybrid</option>
                          </select>
                          <span class="select-arrow"></span>
                          </div>
                    </div>
                    <div class="row">
                      <h4 style="padding-left:17%"><b style="font-display:180%;align-items:center;color:#3e485c;padding-top:2px">Select Rooms for the Event</b></h4>
                      <div class="col-sm-4">
                          <div class="form-group">
                              <span class="form-label">Room 1</span>
                              <select class="form-control" name="event-venue[]">
                                  <option>--:--</option>
                                  <option>Auditorium</option>
                                  <option>A202</option>
                                  <option>A225</option>
                                  <option>A325</option>
                                  <option>B113</option>
                                  <option>B415</option>
                                  <option>B507</option>
                              </select>
                              <span class="select-arrow"></span>
                          </div>
                      </div>
                      <div class="col-sm-4">
                          <div class="form-group">
                              <span class="form-label">Room 2</span>
                              <select class="form-control" name="event-venue[]">
                                  <option>--:--</option>
                                  <option>Auditorium</option>
                                  <option>A202</option>
                                  <option>A225</option>
                                  <option>A325</option>
                                  <option>B113</option>
                                  <option>B415</option>
                                  <option>B507</option>
                              </select>
                              <span class="select-arrow"></span>
                          </div>
                      </div>
                      <div class="col-sm-4">
                          <div class="form-group">
                              <span class="form-label">Room 3</span>
                              <select class="form-control" name="event-venue[]">
                                  <option>--:--</option>
                                  <option>Auditorium</option>
                                  <option>A202</option>
                                  <option>A225</option>
                                  <option>A325</option>
                                  <option>B113</option>
                                  <option>B415</option>
                                  <option>B507</option>
                              </select>
                              <span class="select-arrow"></span>
                          </div>
                      </div>
                  </div>

                  <div class="form-group">
                    <span class="form-label">Details the Event</span>
                    <input class="form-control" type="text" name="event-description" placeholder="Enter Details about the event">
                  </div>
                  <div class="form-group">Poster</span>
                    <input class="form-control" type="text" name="event-link" placeholder="Enter Poster Links if any">
                  </div>

                  <div class="form-btn"style="padding:25%">
                  <input  class="submit-btn" name="new-event" type="submit" ></input>                  
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
HTML;
echo $content;
?>
