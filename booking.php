<?php

$con = mysqli_connect("localhost", "root", "");


if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}


mysqli_select_db($con, "travel");


$sql = "CREATE TABLE IF NOT EXISTS Booking_details (
    userID int NOT NULL AUTO_INCREMENT,
    fname varchar(30),
    lname varchar(30),
    email varchar(30),
    phone_num varchar(15), 
    destination varchar(20),
    address varchar(50),
    tickets int(100),
    arrival date,
    leaving date,
    PRIMARY KEY(userID)
);";  // Added missing semicolon here

// Execute the table creation query
if (mysqli_query($con, $sql)) {
    echo "Table 'Booking_details' created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($con) . "<br>";
}

// Prepare and bind the INSERT statement to prevent SQL injection
$stmt = mysqli_prepare($con, "INSERT INTO Booking_details (fname,lname,email,phone_num,destination,address,tickets,arrival,leaving) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssssssss", $fname,$lname,$email,$phone_num,$address,$destination,$tickets,$arrival,$leaving);

// Assign variables from the POST request
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone_num = $_POST['phone_num'];
$address = $_POST['address'];
$destination = $_POST['destination'];
$tickets = $_POST['tickets'];
$arrival = $_POST['arrival'];
$leaving = $_POST['leaving'];

// Execute the prepared statement
if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Place Your Booking'); window.location.href='book.php';</script>";
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($con);
?>
