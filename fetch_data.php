<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve data from the database
$sql = "SELECT * FROM uploaddocs"; // Replace with your actual table name
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["refno"] . "</td>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["source"] . "</td>";
        echo "<td>" . $row["datereceived"] . "</td>";
        echo "<td><a href='uploads/" . $row["file"] . "'>" . $row["file"] . "</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No results found.</td></tr>";
}

// Close the connection
$conn->close();
?>
