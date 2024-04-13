<?php
    session_start(); // Start the session

    // Initialize bookedSeats from session or default
    $bookedSeats = $_SESSION['bookedSeats'] ?? [
        "A1" => ["name" => "John Doe", "email" => "johndoe@example.com"],
        "A2" => ["name" => "Jane Doe", "email" => "janedoe@example.com"],
        "B3" => ["name" => "John Smith", "email" => "johnsmith@example.com"],
        "C4" => ["name" => "John and the smith", "email" => "johnandthesmith@example.com"],
    ];

    // Check if we're adding a new booking
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['addBooking'])) {
        $seat = $_GET['seat'];
        $name = $_GET['name'];
        $email = $_GET['email'];

        // Add booking to the array
        $bookedSeats[$seat] = ["name" => $name, "email" => $email];

        // Save the updated array back to the session
        $_SESSION['bookedSeats'] = $bookedSeats;
    }

    $seatDetails = '';

    // Check for form submission to display seat details or booking form
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['getDetails'])) {
        $selectedSeats = $_POST['seats'] ?? [];

        $seatDetails .= "<h2 class='heading'>Seat Details</h2>";

        foreach ($selectedSeats as $seat) {
            if (array_key_exists($seat, $bookedSeats)) {
                // Seat is booked, display details
                $seatDetails .= "<p>Seat $seat is booked by {$bookedSeats[$seat]['name']} ({$bookedSeats[$seat]['email']})</p>";
            } else {
                // Seat is not booked, show button to enter details
                $seatDetails .= "<p>Seat $seat is not booked. 
                    <button onclick=\"document.getElementById('bookingForm$seat').style.display='block'\">Enter Details</button>
                </p>";
                $seatDetails .= "<div id='bookingForm$seat' style='display:none;'>
                    <form method='get'><input type='hidden' name='seat' value='$seat'>
                        <input type='text' name='name' placeholder='Name' required>
                        <input type='email' name='email' placeholder='Email' required>
                        <input type='submit' name='addBooking' value='Save'>
                    </form>
                </div>";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Information</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Ticket Information</h1>
        <form action="index.php" method="post">
            <div class="seating-chart">
            <?php
                    $rows = ['A', 'B', 'C', 'D', 'E']; // Rows
                    $cols = [1, 2, 3, 4, 5]; // Columns
                    
                    foreach ($rows as $row) {
                        foreach ($cols as $col) {
                            $seat = $row . $col;
                            echo "<input type='checkbox' name='seats[]' value='$seat' id='$seat'> <label for='$seat'>$seat</label>";
                        }
                    }
                ?>
            </div>
            
            <input type="submit" name="getDetails" value="Get Details">
        </form>
        <div id="seat-details">
        <?php
            echo $seatDetails;      
            ?>
        </div>
    </div>
</body>
</html>
