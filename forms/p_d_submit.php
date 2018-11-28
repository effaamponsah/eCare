<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$name =filter_input(INPUT_POST, 'p_name');
/* $weight =filter_input(INPUT_POST, 'weight');
$temp =filter_input(INPUT_POST, 'temp');
$bp = filter_input(INPUT_POST, 'bp'); */

/* $sql = "INSERT INTO patients_data (Name, Weight, Temperature, BP)
VALUES ('$name', '$weight', '$temp', $bp)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close(); */

echo $name
?>