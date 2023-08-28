var currentDate = new Date();
var currentMonth = currentDate.getMonth();
var currentYear = currentDate.getFullYear();

var calendarBody = document.getElementById("calendar-body");

function generateCalendar() {
    calendarBody.innerHTML = "";
    
    var firstDay = new Date(currentYear, currentMonth, 1);
    var startingDay = firstDay.getDay();
    
    var totalDays = new Date(currentYear, currentMonth + 1, 0).getDate();
    
    var date = 1;
    for (var i = 0; i < 6; i++) {
        var row = document.createElement("tr");
        
        for (var j = 0; j < 7; j++) {
            if (i === 0 && j < startingDay) {
                var cell = document.createElement("td");
                row.appendChild(cell);
            } else if (date > totalDays) {
                break;
            } else {
                var cell = document.createElement("td");
                cell.textContent = date;
                row.appendChild(cell);
                
                date++;
            }
        }
        
        calendarBody.appendChild(row);
        
        if (date > totalDays) {
            break;
        }
    }
}

function highlightSelectedDay(selectedDate) {
   var selectedDate = new Date(/*document.getElementById("date-input").value*/selectedDate);
    
    if (!isNaN(selectedDate.getTime())) {
        var selectedDay = selectedDate.getDate();
        
        var cells = calendarBody.getElementsByTagName("td");
        for (var i = 0; i < cells.length; i++) {
            if (parseInt(cells[i].textContent) === selectedDay) {
                cells[i].classList.add("highlight");
            } else {
                cells[i].classList.remove("highlight");
            }
        }
    }
}

generateCalendar();