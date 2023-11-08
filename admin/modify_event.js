const xhr = new XMLHttpRequest();

// Set up the request
xhr.open("GET", "/EventHub/admin/admin_modify_event.php");

// Set up the onload callback
xhr.onload = function () {
  if (xhr.status === 200) {
    // Parse the response JSON data
    const eventData = JSON.parse(xhr.responseText);

    // Get the inbox table element
    const inboxTable = document.getElementById("inbox");

    // Clear any previously displayed events
    inboxTable.innerHTML = "";

    // Create the table header row
    const headerRow = document.createElement("tr");
    const nameHeader = document.createElement("th");
    const descHeader = document.createElement("th");
    const startHeader = document.createElement("th");
    const endHeader = document.createElement("th");
    const venueHeader = document.createElement("th");
    nameHeader.innerHTML = "Name";
    descHeader.innerHTML = "Description";
    startHeader.innerHTML = "Start Date/Time";
    endHeader.innerHTML = "End Date/Time";
    venueHeader.innerHTML = "Venue";
    headerRow.appendChild(nameHeader);
    headerRow.appendChild(descHeader);
    headerRow.appendChild(startHeader);
    headerRow.appendChild(endHeader);
    headerRow.appendChild(venueHeader);
    inboxTable.appendChild(headerRow);
    headerRow.style.color="white";

    // Create a table row for each event and add it to the table
    eventData.forEach(function (event) {
      const row = document.createElement("tr");
      const nameCell = document.createElement("td");
      const descCell = document.createElement("td");
      const startCell = document.createElement("td");
      const endCell = document.createElement("td");
      const venueCell = document.createElement("td");
      const nameInput = document.createElement("input");
      const descInput = document.createElement("input");
      const startInput = document.createElement("input");
      const endInput = document.createElement("input");
      const venueInput = document.createElement("input");

      nameInput.setAttribute("type", "text");
      nameInput.setAttribute("value", event.event_name);
      descInput.setAttribute("type", "text");
      descInput.setAttribute("value", event.event_description);
      startInput.setAttribute("type", "datetime-local");
      startInput.setAttribute("value", `${event.event_start_date}T${event.event_start_time}`);
      endInput.setAttribute("type", "datetime-local");
      endInput.setAttribute("value", `${event.event_end_date}T${event.event_end_time}`);
      venueInput.setAttribute("type", "text");
      venueInput.setAttribute("value", event.event_venue);

      nameCell.appendChild(nameInput);
      descCell.appendChild(descInput);
      startCell.appendChild(startInput);
      endCell.appendChild(endInput);
      venueCell.appendChild(venueInput);

      row.appendChild(nameCell);
      row.appendChild(descCell);
      row.appendChild(startCell);
      row.appendChild(endCell);
      row.appendChild(venueCell);

      inboxTable.appendChild(row);
    });

    
      
  }
};

// Send the request
xhr.send(); 