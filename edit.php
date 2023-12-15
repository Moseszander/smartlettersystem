<?php
// Assuming you have already established a valid MySQLi connection
// Replace "host", "username", "password", and "database" with your actual details
$con = mysqli_connect("localhost", "root", "", "project");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    // Handle the error appropriately, such as logging or displaying an error message
}

// Handle the form submission to update content
if (isset($_POST['submit'])) {
    $id = $_POST['id']; // Unique identifier for the row to update
    $newContent = $_POST['new_content']; // New content to update

    // Update query
    $updateQuery = "UPDATE uploaddocs SET content = '$newContent' WHERE id = '$id'";

    // Perform the update
    if (mysqli_query($con, $updateQuery)) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

// Close the connection when done
mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Content</title>
</head>
<body>
    <div class="container">
        <form method="post">
            <label for="refno">Refenrence Number:</label>
            <input type="text" name="refno" required><br>

            <label for="title">Document Title:</label>
            <input type="text" name="tite" required><br>

            <label for="source">Unit:</label>
            <input type="text" name="source" required><br>

            <label for="datereceived">Date Received:</label>
            <input type="date" name="datereceived" required><br>

            <label for="file">File:</label>
            <input type="blob" name="file" required><br>

            
            <input type="submit" name="submit" value="Update Content">
        </form>
    </div>
</body>
</html>
