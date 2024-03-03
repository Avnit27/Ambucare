<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "ambucare";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $patientName = $conn->real_escape_string($_POST['patient-name']);
    $phoneNumber = $conn->real_escape_string($_POST['phone-number']);
    $pickupLocation = $conn->real_escape_string($_POST['pickup-location']);
    $dropLocation = $conn->real_escape_string($_POST['drop-location']);
    $aadharPanNumber = $conn->real_escape_string($_POST['aadhar-pan-number']);

    // Insert user data into database
    $sql = "INSERT INTO ambulance_bookings (patient_name, phone_number, pickup_location, drop_location, aadhar_pan_number)
    VALUES ('$patientName', '$phoneNumber', '$pickupLocation', '$dropLocation', '$aadharPanNumber')";

    if ($conn->query($sql) === TRUE) {
        echo "Ambulance booked successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
