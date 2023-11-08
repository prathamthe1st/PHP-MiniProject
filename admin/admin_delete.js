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
    headerRow.style.color = "white";

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
      const deleteRadio = document.createElement("input");

      deleteRadio.setAttribute("type", "radio");
      nameInput.setAttribute("type", "text");
      nameInput.setAttribute("value", event.event_name);
      descInput.setAttribute("type", "text");
      descInput.setAttribute("value", event.event_description);
      startInput.setAttribute("type", "datetime-local");
      startInput.setAttribute(
        "value",
        `${event.event_start_date}T${event.event_start_time}`
      );
      endInput.setAttribute("type", "datetime-local");
      endInput.setAttribute(
        "value",
        `${event.event_end_date}T${event.event_end_time}`
      );
      venueInput.setAttribute("type", "text");
      venueInput.setAttribute("value", event.event_venue);

      nameCell.appendChild(nameInput);
      descCell.appendChild(descInput);
      startCell.appendChild(startInput);
      endCell.appendChild(endInput);
      venueCell.appendChild(venueInput);

      row.appendChild(deleteRadio);

      row.appendChild(nameCell);
      row.appendChild(descCell);
      row.appendChild(startCell);
      row.appendChild(endCell);
      row.appendChild(venueCell);

      inboxTable.appendChild(row);

      // Get the delete button element
      const deleteButton = document.getElementById("delete");

      // Add an event listener for the delete button click
      deleteButton.addEventListener("click", function () {
        // Get the selected radio button
        const selectedRadio = document.querySelector(
          "input[type=radio]:checked"
        );

        // Check if a radio button is selected
        if (!selectedRadio) {
          alert("Please select an event to delete");
          return;
        }

        // Get the parent row of the selected radio button
        const selectedRow = selectedRadio.closest("tr");

        // Check if a row was found
        if (!selectedRow) {
          alert("Error: selected row not found");
          return;
        }

        // Get the name of the event to delete

        const deleteRadio = document.querySelector("input[type=radio]:checked");
        const deleteEvent = deleteRadio.parentNode.parentNode;
        const deleteEventName =
          deleteEvent.querySelector("td").firstChild.value;

        // Confirm deletion with the user
        const confirmDelete = confirm(
          `Are you sure you want to delete the event "${deleteEventName}"?`
        );

        // If the user confirms the deletion
        if (confirmDelete) {
          // Send an AJAX request to delete the event
          const xhr = new XMLHttpRequest();
          xhr.open(
            "POST",
            "/EventHub/admin/admin_delete.php?name=" +
              encodeURIComponent(deleteEventName)
          );
          xhr.onload = function () {
            if (xhr.status === 200) {
              // If the deletion was successful, remove the row from the table
              selectedRow.remove();
              alert("Event deleted successfully!");
            } else {
              alert("Error deleting event");
            }
          };
          xhr.send();
        }
      });
    });
  }
};

// Send the request
xhr.send();
