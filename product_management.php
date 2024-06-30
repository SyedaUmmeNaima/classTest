<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Product_Management";






// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}





// Read only the rickshaw_id and name that has speed greater than 10
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['task']) && $_GET['task'] == 'task1') {
$sql = "SELECT registration_number, name FROM Rickshaw WHERE speed > 10";
$result = $conn->query($sql);

$rickshaws = [];
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
$rickshaws[] = $row;
}
}
echo json_encode($rickshaws);
}






// Read all the driver information who has joined after June 24, 2023
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['task']) && $_GET['task'] == 'task2') {
$sql = "SELECT d.* FROM Driver d JOIN Rickshaw_Driver_Mapping rdm ON d.driving_license_number = rdm.driver_id WHERE rdm.date_of_joining > '2023-06-24'";
$result = $conn->query($sql);

$drivers = [];
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
$drivers[] = $row;
}
}
echo json_encode($drivers);
}


// Update the speed of all the rickshaws to 15 whose speed is less than 5
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task']) && $_POST['task'] == 'task3') {
    $sql = "UPDATE Rickshaw SET speed = 15 WHERE speed < 5";
    if ($conn->query($sql) === TRUE) {
    echo "Records updated successfully";
    } else {
    echo "Error updating record: " . $conn->error;
    }
    }







?>