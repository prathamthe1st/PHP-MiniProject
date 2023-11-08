const xhr = new XMLHttpRequest();

// Set up the request
xhr.open("GET", "/EventHub/HOD/get_unregistered_events.php");
console.log("Hello");
// Set up the onload callback
xhr.onload = function () {
  if (xhr.status === 200) {
    // Parse the response JSON data
    console.log(xhr.responseText);
    const eventData = JSON.parse(xhr.responseText);

    // Get the inbox list element
    const inboxList = document.getElementById("inbox");

    // Clear any previously displayed events
    inboxList.innerHTML = "";

    // Create a new list item for each event and add it to the list
    eventData.forEach(function (event) {
       
      const listItem = document.createElement("li");
      const eventName = document.createElement("h3");
      const eventDesc = document.createElement("p");
      const eventDateTime = document.createElement("p");
      const eventVenue = document.createElement("p");
      const approveBtn = document.createElement("button");

      approveBtn.innerHTML = "Approve";   
            
      approveBtn.addEventListener("click", function() {
        // Make an AJAX call to update the event_confirmation value to 1
        const xhr2 = new XMLHttpRequest();
        xhr2.open("POST", "/EventHub/HOD/update_confirmation.php");
        xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr2.onload = function() {
          if (xhr2.status === 200) {
            // Refresh the event list after the update is complete
            console.log("Event confirmation updated");
            console.log(xhr2.responseText);
            const xhr3 = new XMLHttpRequest();
            xhr3.open("GET", "/EventHub/HOD/HOD.php");
            xhr3.onload = function () {
              if (xhr3.status === 200) {
                // Parse the response JSON data
                const updatedEventData = JSON.parse(xhr3.responseText);

                // Clear any previously displayed events
                inboxList.innerHTML = "";

                // Create a new list item for each event and add it to the list
                updatedEventData.forEach(function (updatedEvent) {
                  const updatedListItem = document.createElement("li");
                  const updatedEventName = document.createElement("h3");
                  const updatedEventDesc = document.createElement("p");
                  const updatedEventDateTime = document.createElement("p");
                  const updatedEventVenue = document.createElement("p");
      
                  updatedEventName.innerHTML = updatedEvent.event_name;
                  updatedEventDesc.innerHTML = updatedEvent.event_description;
                  updatedEventDateTime.innerHTML = updatedEvent.event_start_date + " " + updatedEvent.event_start_time + " - " + updatedEvent.event_end_date + " " + updatedEvent.event_end_time;
                  updatedEventVenue.innerHTML = "Venue: " + updatedEvent.event_venue;
            
                  updatedListItem.appendChild(updatedEventName);
                  updatedListItem.appendChild(updatedEventDesc);
                  updatedListItem.appendChild(updatedEventDateTime);
                  updatedListItem.appendChild(updatedEventVenue);
            
                  inboxList.appendChild(updatedListItem);
                });
              } else {
                console.error("Failed to get updated event data: " + xhr3.statusText);
              }
            };
            xhr3.send();
          } else {
            console.error("Failed to update event confirmation: " + xhr2.statusText);
          }
        };
        xhr2.send("event_name=" + event.event_name);
      });


          eventName.innerHTML = event.event_name;
          eventDesc.innerHTML = event.event_description;
          eventDateTime.innerHTML = event.event_start_date + " " + event.event_start_time + " - " + event.event_end_date + " " + event.event_end_time;
          eventVenue.innerHTML = "Venue: " + event.event_venue;
      
          listItem.appendChild(eventName);
          listItem.appendChild(eventDesc);
          listItem.appendChild(eventDateTime);
          listItem.appendChild(eventVenue);
          listItem.appendChild(approveBtn);
      
          inboxList.appendChild(listItem);
       
      });
      
  }
};

// Send the request
xhr.send();