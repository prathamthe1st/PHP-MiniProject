var eventList = document.getElementById("event-list");
var eventSelect = document.getElementById("event-select");

// Fetch all event names from the database and dynamically populate the event-select dropdown
var url = "./get_event_names.php";
var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    var eventNames = JSON.parse(this.responseText);
    for (var i = 0; i < eventNames.length; i++) {
      var option = document.createElement("option");
      option.value = eventNames[i];
      option.text = eventNames[i];
      eventSelect.appendChild(option);
    }
  }
};
xhr.open("GET", url, true);
xhr.send();

// When the event-select dropdown is changed, retrieve the selected value and make an AJAX request to the PHP script
eventSelect.addEventListener("change", function() {
  var selectedValue = eventSelect.value;
  var xhr = new XMLHttpRequest();
  
  // Define the PHP script to which the AJAX request will be sent
  var url = "./admin_inbox.php";
  
  // Define the data to be sent to the PHP script
  var data = "eventType=" + selectedValue;
  
  // Define the callback function for when the AJAX request is complete
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var registrations = JSON.parse(this.responseText);
      if(registrations.length == 0) {
        eventList.innerHTML = "<p>No registrations for this event.</p>";
      }
      else {
        // create table element
        var table = document.createElement("table");
        table.style.border = "1px solid black"; 
  
        // create header row
        var headerRow = document.createElement("tr");
        var headerEmail = document.createElement("th");
        headerEmail.textContent = "Email";
        headerEmail.style.border = "1px solid black";
        var headerName = document.createElement("th");
        headerName.textContent = "Name";
        headerName.style.border = "1px solid black";
        var headerYear = document.createElement("th");
        headerYear.textContent = "Year";
        headerEmail.style.border = "1px solid black";
        var headerRollNo = document.createElement("th");
        headerRollNo.textContent = "Roll No";
        headerEmail.style.border = "1px solid black";
        headerRow.appendChild(headerEmail);
        headerRow.appendChild(headerName);
        headerRow.appendChild(headerYear);
        headerRow.appendChild(headerRollNo);
        table.appendChild(headerRow);
  
        // loop through registrations and add to table
        for (var i = 0; i < registrations.length; i++) {
          var registration = registrations[i];
          var row = document.createElement("tr");
          var emailCell = document.createElement("td");
          emailCell.style.border = "1px solid black";
          emailCell.padding = "10px";
          emailCell.textContent = registration.email;
          var nameCell = document.createElement("td");
          nameCell.style.border = "1px solid black";
          nameCell.padding = "10px";
          nameCell.textContent = registration.name;
          var yearCell = document.createElement("td");
          yearCell.style.border = "1px solid black";
          yearCell.padding = "10px";
          yearCell.textContent = registration.year;
          var rollNoCell = document.createElement("td");
          rollNoCell.style.border = "1px solid black";
          rollNoCell.padding = "10px";
          rollNoCell.textContent = registration.roll_no;
          row.appendChild(emailCell);
          row.appendChild(nameCell);
          row.appendChild(yearCell);
          row.appendChild(rollNoCell);
          row.style.border = "1px solid black";
          table.appendChild(row);
        }
  
        // add table to eventList div
        eventList.innerHTML = "";
        eventList.appendChild(table);
      }
    }
  };
  
  
  // Send the AJAX request to the PHP script
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send(data);
});
