<?php
// Assuming you have already established a valid MySQLi connection
// Replace "host", "username", "password", and "database" with your actual details
$con = mysqli_connect("localhost", "root", "", "project");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    // Handle the error appropriately, such as logging or displaying an error message
}

$uploadResult = '';

// Handle the document upload
if (isset($_POST['upload'])) {
    // Validate and sanitize user inputs
    $refNo = mysqli_real_escape_string($con, $_POST['refno']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $source = mysqli_real_escape_string($con, $_POST['source']);
    $dateReceived = mysqli_real_escape_string($con, $_POST['datereceived']);
    $department = mysqli_real_escape_string($con, $_POST['department']); // Get the selected department

    // File upload handling
    $uploadDir = 'uploads/';
    $uploadedFileName = $_FILES['file']['name'];
    $uploadedFilePath = $uploadDir . $uploadedFileName;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFilePath)) {
        // Insert file details into the database using prepared statements
        $insertQuery = "INSERT INTO uploadeddoc (reference_number, title, source, date_received, department, file_path)
                        VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($con, $insertQuery);
        mysqli_stmt_bind_param($stmt, "ssssss", $refNo, $title, $source, $dateReceived, $department, $uploadedFilePath);

        if (mysqli_stmt_execute($stmt)) {
            $uploadResult = "File uploaded and record inserted successfully.";
        } else {
            $uploadResult = "Error inserting record: " . mysqli_error($con);
        }

        mysqli_stmt_close($stmt);
    } else {
        $uploadResult = "File upload failed.";
    }
}

// Fetch levels from the 'levels' table
$levels = [];
$selectlevelsQuery = "SELECT name FROM levels";
$levelsResult = mysqli_query($con, $selectlevelsQuery);
if ($levelsResult && mysqli_num_rows($levelsResult) > 0) {
    while ($row = mysqli_fetch_assoc($levelsResult)) {
        $levels[] = $row['name'];
    }
}

// Fetch documents from the 'uploadeddocs' table
$documents = [];
$selectQuery = "SELECT * FROM uploaddocs";
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
    <title>Upload and View PDF Documents</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Letter Tracking System</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="upload.html">Upload PDF</a></li>
                <li><a href="edit.html">Edit PDF</a></li>
                <li><a href="view.html">View PDF</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
      

        <div>
            <?php echo $uploadResult; ?>
        </div>

        <h2>Uploaded Documents</h2>
        <table>
            <tr>
                <th>Reference Number</th>
                <th>Title</th>
                <th>Source</th>
                <th>Date Received</th>
                <th>Department</th>
                <th>File</th>
                <th>Assign</th>
            </tr>
            <?php foreach ($documents as $document) : ?>
                <tr>
                    <td><?php echo $document['refno']; ?></td>
                    <td><?php echo $document['title']; ?></td>
                    <td><?php echo $document['source']; ?></td>
                    <td><?php echo $document['datereceived']; ?></td>
  
                    <td><a href="<?php echo $document['file_path']; ?>" target="_blank">View File</a></td>
                    <td>
                        <form action="assign_document.php" method="post">
                            <input type="hidden" name="file_path" value="<?php echo $document['file']; ?>">
                            <select name="selected_department">
                                <option value="">Select a Department</option>
                                <?php foreach ($levels as $dept) : ?>
                                    <option value="<?php echo $dept; ?>"><?php echo $dept; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="submit" name="assign" value="Assign">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Your Company. All rights reserved.</p>
    </footer>
</body>
</html>
