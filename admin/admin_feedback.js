// Listen to the change event of the dropdown list
document.getElementById("event-dropdown").addEventListener("change", function() {
    // Get the selected option value
    var selectedOption = this.value;

    // Create an AJAX request to fetch the data from the database
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Parse the JSON response
            console.log(xhr.responseText);
            var data = JSON.parse(xhr.responseText);

            // Create a table to display the data
            var table = document.createElement("table");
            table.style.borderCollapse = "collapse";
            table.style.width = "100%";
            var headerRow = document.createElement("tr");
            var headers = ["ID", "Email", "Event Name", "Registration", "Experience", "Volunteers", "Conduction", "Mood", "Future", "Rate", "Comments"];
            for (var i = 0; i < headers.length; i++) {
                var header = document.createElement("th");
                header.style.border = "1px solid #ddd";
                header.style.padding = "8px";
                header.innerHTML = headers[i];
                headerRow.appendChild(header);
            }
            table.appendChild(headerRow);

            // Populate the table with the received data
            for (var i = 0; i < data.length; i++) {
                var row = document.createElement("tr");
                var feedback = data[i];
                var keys = ["id", "email", "event_name", "registration", "experience", "volunteers", "conduction", "mood", "future", "rate", "comments"];
                for (var j = 0; j < keys.length; j++) {
                    var cell = document.createElement("td");
                    cell.style.border = "1px solid #ddd";
                    cell.style.padding = "8px";
                    cell.innerHTML = feedback[keys[j]];
                    row.appendChild(cell);
                }
                table.appendChild(row);
            }

            // Update the content of the inbox div with the created table
            var inbox = document.getElementById("inbox");
            inbox.innerHTML = "";
            inbox.appendChild(table);
        }
    };
    xhr.open("GET", "./admin_feedback.php?event=" + selectedOption, true);
    xhr.send();
});
