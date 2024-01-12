<?php
session_start();
include_once "./connection.php";

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: loginpage.php");
    exit();
}

// Get the SQL query from the AJAX request
$query = $_POST['query'];

// Execute the query
$result = $link->query($query);

// Check for errors
if (!$result) {
    die("Query failed: " . $link->error);
}

// Process and output the result
while ($row = $result->fetch_assoc()) {
     echo "<option value='".$row["id"]."'>" . $row["name"] . "</option>";
    // print_r($row);
}

// Close the database connection
$link->close();

?>
