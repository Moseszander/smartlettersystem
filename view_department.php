<?php
// Assuming you have already established a valid MySQLi connection
// Replace "host", "username", "password", and "database" with your actual details
$con = mysqli_connect("localhost", "root", "", "project");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    // Handle the error appropriately, such as logging or displaying an error message
}

$selecteddepartment = $_POST['selectedDepartment'];

// Fetch documents from the uploadeddoc table filtered by the selected department
$documents = [];
$selectQuery = "SELECT * FROM uploadeddoc WHERE department = '$selectedDepartment'";
$result = mysqli_query($con, $selectQuery);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $documents[] = $row;
    }
}

// Close the connection when done
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Documents by Department</title>
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
    <header>
        <h1>Letter Tracking System</h1>
        
    </header>

    <div class="container">
        <h2>Documents for Department: <?php echo $selectedDepartment; ?></h2>
        <table>
            <tr>
                <th>Reference Number</th>
                <th>Title</th>
                <th>Source</th>
                <th>Date Received</th>
                <th>Department</th>
                <th>File</th>
            </tr>
            <?php foreach ($documents as $document) : ?>
                <tr>
                    <td><?php echo $document['reference_number']; ?></td>
                    <td><?php echo $document['title']; ?></td>
                    <td><?php echo $document['source']; ?></td>
                    <td><?php echo $document['date_received']; ?></td>
                    <td><?php echo $document['department']; ?></td>
                    <td><a href="<?php echo $document['file_path']; ?>" target="_blank">View File</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <?php require_once "footer.php"  ?>
</body>
</html>
