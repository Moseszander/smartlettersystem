<?php
session_start();
include_once "./connection.php";

// Initialize variables to hold file details
$fileDetails = "";
$searched = false;
    // Check if user is logged in
    if (!isset($_SESSION['email'])) {
        header("Location: loginpage.php");
        exit();
    }


// Assuming you have the ID and Name you want to search for
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"]; // Replace with the file name you want to search for

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM uploaded_docs WHERE title = ?";
    $stmt = $link->prepare($sql);

    // Bind parameters
    $stmt->bind_param("s", $name);

    // Execute the statement
    if ($stmt->execute()) {
        // Get the result
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // File found, retrieve the data
            $fileDetails .= "<div class='container1'>";
            $fileDetails .= "<table border='1'>";
            $fileDetails .= "<tr><th>File ID</th><th>File Name</th><th>File Path</th><th>Source Person</th><th>Received At</th><th>Staff ID</th><th>Department ID</th></tr>";

            while ($row = $result->fetch_assoc()) {
                $fileDetails .= "<tr>";
                $fileDetails .= "<td>" . $row['id'] . "</td>";
                $fileDetails .= "<td>" . $row['title'] . "</td>";
                $fileDetails .= "<td>" . $row['file_path'] . "</td>";
                $fileDetails .= "<td>" . $row['source_person'] . "</td>";
                $fileDetails .= "<td>" . $row['received_at'] . "</td>";
                $fileDetails .= "<td>" . $row['staff_id'] . "</td>";
                $fileDetails .= "<td>" . $row['department_id'] . "</td>";
                $fileDetails .= "</tr>";
            }

            $fileDetails .= "</table>";
            $fileDetails .= "</div>";
            $searched = true;
        } else {
            $fileDetails = "File not found";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Search</title>
    <link rel="stylesheet" href="style/upload.css">
</head>
<body>

<header>
    <h1>File Search</h1>
    <?php
            require_once 'includes/nav_clerk.php';
        ?>
</header>

<div class="container">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">File Name:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Search</button>
    </form>
</div>

<?php
// Display file details if searched
if ($searched) {
    echo $fileDetails;
}
?>



</body>
<?php require_once "footer.php"  ?>
</html>
