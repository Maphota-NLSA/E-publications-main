<?php 
// Function to build the calendar
function build_calendar($month, $year, $events = []) {
    // Array containing names of all days in a week
    $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

    // First day of the month
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    // Number of days in the month
    $numberDays = date('t', $firstDayOfMonth);

    // Information about the first day of the month
    $dateComponents = getdate($firstDayOfMonth);

    // Name of the month
    $monthName = $dateComponents['month'];

    // Index value 0-6 of the first day of the month
    $dayOfWeek = $dateComponents['wday'];

    // Create the table tag opener and day headers
    $calendar = "<table class='calendar'>";
    $calendar .= "<caption>$monthName $year</caption>";
    $calendar .= "<tr>";

    // Create the calendar headers
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th>$day</th>";
    }

    // Create the rest of the calendar
    $calendar .= "</tr><tr>";

    // Add empty cells for days before the start of the month
    if ($dayOfWeek > 0) {
        $calendar .= str_repeat("<td></td>", $dayOfWeek);
    }

    $currentDay = 1;

    // Get the current month and year
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while ($currentDay <= $numberDays) {
        // Seventh column (Saturday) reached. Start a new row.
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";

        // Highlight today and check for events
        $isToday = ($date === date('Y-m-d')) ? "today" : "";
        $eventContent = isset($events[$date]) ? "<div class='event'>" . htmlspecialchars($events[$date]) . "</div>" : "";

        $calendar .= "<td class='$isToday'>$currentDay $eventContent</td>";

        // Increment counters
        $currentDay++;
        $dayOfWeek++;
    }

    // Complete the row of the last week in month, if necessary
    if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        $calendar .= str_repeat("<td></td>", $remainingDays);
    }

    $calendar .= "</tr>";
    $calendar .= "</table>";

    return $calendar;
}

// Example events (replace with dynamic event fetching logic if connected to a database)
$exampleEvents = [
    "2025-01-09" => "Meeting with Team",
    "2025-01-15" => "Project Deadline",
    "2025-01-22" => "Birthday Celebration",
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Event Calendar</title>
    <!-- Tab icon -->     
    <link href="../assets/img/favicon.webp" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .calendar {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .calendar caption {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .calendar th, .calendar td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            vertical-align: top;
        }
        .calendar th {
            background-color: #f4f4f4;
        }
        .calendar td.today {
            background-color: #cce5ff;
        }
        .calendar td .event {
            margin-top: 10px;
            padding: 5px;
            background-color: #ffebcd;
            border: 1px solid #ffa500;
            border-radius: 5px;
            font-size: 0.9rem;
            text-align: left;
        }
        @media (max-width: 768px) {
            .calendar th, .calendar td {
                padding: 8px;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center mt-3">Event Calendar</h1>
    <div class="calendar-container">
        <?php
        // Render the calendar for the current month
        echo build_calendar(date('m'), date('Y'), $exampleEvents);
        ?>
    </div>
</div>
</body>
</html>
