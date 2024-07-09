<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Date Picker</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .months-days-pickers {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
        }

        .label {
            text-align: left;
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .month-button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            cursor: pointer;
        }

        .month-button:hover {
            background-color: #f0f0f0;
        }

        .month-button.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .day-slider {
            width: 100%;
            margin: 20px 0;
        }

        .day-slider input[type="range"] {
            width: 100%;
        }

        .button-row {
            text-align: center;
            margin-top: 20px;
        }

        .months-submit-buttons {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        .months-submit-buttons:hover {
            background-color: #0056b3;
        }

        .highlight {
            background-color: #90ee90;
            border-radius: 15px;
            box-shadow: 0 0 10px #333;
        }

        .highlight a {
            color: #005f5f !important;
            font-weight: bold !important;
        }

        #datepicker {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <form id="form" action="{{ route('userPlan.index') }}" method="POST">
        @csrf
        <div class="months-days-pickers">
            <label class="label">Tour Name</label>
            <input type="text" name="tourName" class="form-control" required />

            <label class="label">Number of people to book</label>
            <input type="number" name="numberOfPeople" class="form-control" required />

            <h2>Choose the number of days & the month</h2>
            <div class="day-slider">
                <input type="range" min="1" max="7" name="days" />
            </div>
            <input type="hidden" name="month" id="monthInput">
            <input type="hidden" name="selectedDays">
            <div id="month-buttons">
                <div class="month-button">January</div>
                <div class="month-button">February</div>
                <div class="month-button">March</div>
                <div class="month-button">April</div>
                <div class="month-button">May</div>
                <div class="month-button">June</div>
                <div class="month-button">July</div>
                <div class="month-button">August</div>
                <div class="month-button">September</div>
                <div class="month-button">October</div>
                <div class="month-button">November</div>
                <div class="month-button">December</div>
            </div>

            <div class="button-row">
                <button class="months-submit-buttons" type="button">BACK</button>
                <button class="months-submit-buttons" type="submit">MAKE TOUR</button>
            </div>
            <p>Your 5-day trip starts in June</p>
        </div>
        <div id="datepicker"></div>
    </form>

    
    <script>
        $(document).ready(function() {
            var $slider = $('.day-slider input[type="range"]');
            var $daysDisplay = $(".months-days-pickers p");
            var $monthButtons = $("#month-buttons div");
            var $calendar = $("#datepicker");
            var currentYear = new Date().getFullYear();
            var currentMonth = new Date().getMonth();
            var $monthInput = $('#monthInput'); // Reference to hidden input for month
            var $selectedDaysInput = $('input[name="selectedDays"]'); // Reference to hidden input for selected days
            var selectedDates = []; // Array to store selected dates as strings
            var lastSelectedDate = null; // Initialize lastSelectedDate

            // Function to return date string without the day name
            function formatDate(date) {
                return (date.getMonth() + 1) + '/' + date.getDate() + '/' + date
                    .getFullYear(); // Format as "MM/DD/YYYY"
            }

            // Update the display for the selected month and day
            function updateDisplay() {
                var numberOfDays = $slider.val();
                var activeMonth = $monthButtons.filter(".active").text();
                $daysDisplay.text("Your " + numberOfDays + " day trip starts in " + activeMonth);
            }

            // Update the hidden input for selected days
            function updateSelectedDaysInput() {
                $selectedDaysInput.val(JSON.stringify(selectedDates));
            }

            $calendar.datepicker({
                defaultDate: new Date(currentYear, currentMonth, 1),
                changeMonth: true,
                changeYear: true,
                beforeShowDay: function(date) {
                    var dateStr = formatDate(date);
                    var highlighted = [true, ''];
                    if (selectedDates.includes(dateStr)) {
                        highlighted = [true, 'highlight'];
                    }
                    return highlighted;
                },
                onSelect: function(dateText, inst) {
                    var selectedDate = new Date(dateText);
                    var formattedDate = formatDate(selectedDate);

                    if (selectedDates.length >= $slider.val()) {
                        alert("You've already selected the maximum number of days.");
                        return false;
                    }

                    if (lastSelectedDate !== null) {
                        // Check if the selected date follows the previous selected date
                        var timeDiff = selectedDate.getTime() - lastSelectedDate.getTime();
                        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                        if (diffDays !== 1) {
                            alert("Please select consecutive dates.");
                            return false;
                        }
                    }
                    lastSelectedDate = selectedDate; // Update lastSelectedDate
                    selectedDates.push(formattedDate); // Add formatted date to the array
                    updateSelectedDaysInput(); // Update the hidden input with new values
                    $calendar.datepicker("refresh"); // Refresh the calendar to apply changes
                }
            });

            $slider.on("input", function() {
                updateDisplay();
            });

            // Initialize the display text on page load
            updateDisplay();
            updateSelectedDaysInput(); // Initialize selected days input on page load

            $monthButtons.on("click", function() {
                $monthButtons.removeClass("active");
                $(this).addClass("active");
                currentMonth = $(this).index(); // Update currentMonth to the index of the clicked button
                $monthInput.val(getMonthName(
                    currentMonth)); // Update the hidden input to reflect the new month name
                $calendar.datepicker("setDate", new Date(currentYear, currentMonth, 1));
                updateDisplay();
                selectedDates = []; // Reset selected dates when month changes
                lastSelectedDate = null; // Reset last selected date
                updateSelectedDaysInput();
            });

            function getMonthName(monthNumber) {
                var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ];
                return months[monthNumber]; // Direct 0-based index
            }

            // Set initial month selection and display
            $monthButtons.eq(currentMonth).addClass("active");
            $monthInput.val(getMonthName(currentMonth));
        });
    </script>




</body>

</html>