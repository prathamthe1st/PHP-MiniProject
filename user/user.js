const calendar = document.querySelector(".calendar");
const monthYear = calendar.querySelector(".month-year");
const btnPrev = calendar.querySelector(".btn-prev");
const btnNext = calendar.querySelector(".btn-next");
const calendarBody = calendar.querySelector(".calendar-body");
const calendarDates = calendar.querySelector("#calendar-dates");

let date = new Date();
let currentMonth = date.getMonth();
let currentYear = date.getFullYear();


const months = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];



var modal = document.getElementById("myModal");
var btn = document.getElementsByClassName("close")[0];

function showCalendar(month, year) {
  let firstDay = new Date(year, month).getDay();
  let daysInMonth = 32 - new Date(year, month, 32).getDate();

  let tbl = `<tr>`;
  for (let i = 0; i < firstDay; i++) {
    tbl += `<td></td>`;
  }
  for (let i = 1; i <= daysInMonth; i++) {
    if ((i + firstDay - 1) % 7 === 0) {
      tbl += `</tr><tr>`;
    }
    tbl += `<td>${i}</td>`;
  }
  tbl += `</tr>`;
  calendarDates.innerHTML = tbl;
  monthYear.innerHTML = months[month] + " " + year;

 
  var previousCell = null;
  var selectedCells = document.querySelectorAll("td");
 

  selectedCells.forEach(function (cell) {
    cell.style.width = "40px";
  }
  );
  btn.onclick = function () {
    modal.style.display = "none";
    selectedCells.forEach(
      (cell) => (cell.style.backgroundColor = "transparent")
    );
    previousCell = null;
  };

  selectedCells.forEach((cell) => {
    cell.addEventListener("click", function () {
      if (previousCell !== null) {
        previousCell.style.backgroundColor = "transparent";
      }

      cell.style.backgroundColor = "black";
      previousCell = cell;
      modal.style.display = "block";
      document.getElementById("date").innerHTML = cell.innerHTML + " " + months[month] + " " + year;
      const selectedDate = year + "-" + (month + 1) + "-" + cell.innerHTML;

      // Create a new XMLHttpRequest object
      const xhr = new XMLHttpRequest();

      // Set up the request
      xhr.open("GET", "/EventHub/event_form/get_event.php?date=" + selectedDate);

      // Set up the onload callback
      xhr.onload = function () {
        if (xhr.status === 200) {
          if(xhr.responseText.length > 0){
          // Parse the response JSON data
          // console.log(xhr.responseText);
          const eventData = JSON.parse(xhr.responseText);
          console.log(eventData);

          

         
          const eventList = document.getElementById("event-list");

          // Clear any previously displayed events
          eventList.innerHTML = "";

          // Create a new list item for each event and add it to the list
          eventData.forEach(function (event) {
            const listItem = document.createElement("li");
            const eventName = document.createElement("h3");
            const eventDesc = document.createElement("p");
            const eventDateTime = document.createElement("p");
            const eventVenue = document.createElement("p");
            const eventImage = document.createElement("img");
            const registerButton = document.createElement("button");
            const registerForm = document.getElementsByClassName("register_form")[0];
            const btn1 = document.getElementsByClassName("close")[1];
            const overlay = document.querySelector('.overlay');

            eventName.innerHTML = "Name: " + event.event_name;
            eventDesc.innerHTML = "<b>Description: </b> " + event.event_description;
            eventDateTime.innerHTML = "<b>Events starts at: </b>"+event.event_start_date + " "+ event.event_start_time + " - " +" and ends at: " + event.event_end_date + " " + event.event_end_time;
            eventVenue.innerHTML = "<b>Venue: </b>" + event.event_venue;
            
            eventImage.src = event.event_link;
            eventImage.style.width = "100%";
            eventImage.style.height = "50%";
            registerButton.innerHTML = "Register Now";
            registerButton.classList.add("register_btn");

            registerButton.addEventListener("click", () => {
              const event_name = event.event_name;
              const input = document.getElementById("event_name");
              input.innerHTML = event_name;
              input.value = event_name;
              // console.log(input.value);
              registerForm.classList.remove("hidden");
              overlay.classList.remove("hidden");
            });

            btn1.onclick = function () {
              registerForm.classList.add("hidden");
              overlay.classList.add("hidden");
            };

            document.addEventListener('keydown', function (e) {
              console.log(e.key);
            
              if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
              }
            });

            listItem.appendChild(eventName);
            listItem.appendChild(eventDesc);
            listItem.appendChild(eventDateTime);
            listItem.appendChild(eventVenue);
            if(event.event_link != null) {listItem.appendChild(eventImage)}
            else {listItem.appendChild(eventImage)};
            listItem.appendChild(document.createElement("br"));
            listItem.appendChild(registerButton);

            eventList.appendChild(listItem);
            eventList.style.border = "1px solid black";
            // console.log("hello")
          });
        }
        else{
          const eventList = document.getElementById("event-list");
          eventList.innerHTML = "";
          const listItem = document.createElement("li");
          listItem.innerHTML = "No events on this date";
          eventList.appendChild(listItem);
          eventList.style.border = "1px solid black";
        }
      }
      };

      // Send the request
      xhr.send();
    });


  });

}

 btnPrev.addEventListener("click", () => {
  currentYear = currentMonth === 0 ? currentYear - 1 : currentYear;
  currentMonth = currentMonth === 0 ? 11 : currentMonth - 1;
  modal.style.display = "none";
  showCalendar(currentMonth, currentYear);
});

btnNext.addEventListener("click", () => {
  currentYear = currentMonth === 11 ? currentYear + 1 : currentYear;
  currentMonth = (currentMonth + 1) % 12;
  modal.style.display = "none";
  showCalendar(currentMonth, currentYear);
});

const signout = document.getElementById("sign-out");
signout.addEventListener("click", () => {
  console.log("sign out");
  window.location.href = "/EventHub/admin/logout.php";
});

showCalendar(currentMonth, currentYear);