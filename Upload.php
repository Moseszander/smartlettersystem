<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Content Display</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style/view.css">
</head>
<body>
    <header>
        <h1>Uploaded files</h1>

        <?php
            require_once 'includes/nav_clerk.php';
        ?>

    </header>
    <div id="table-container">
        <table id="data-table">
            <thead>
                <tr>
                    <th>Document Id</th>
                    <th>Title</th>
                    <th>File</th>
                    <th>Source Person</th>
                    <th>Received On</th>
                </tr>
            </thead>
            <tbody>
            <?php
function getSortedFiles($sortColumn, $sortOrder) {
    // Database connection settings
    $servername = "localhost";
    $username = "root";
    $password = ""; // Replace with your actual password
    $dbname = "project";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Define a default sorting order if not specified
    if (!in_array($sortOrder, ["ASC", "DESC"])) {
        $sortOrder = "ASC";
    }

    // Define allowed sorting columns
    $allowedColumns = ["received_at", "title"];

    // Check if the specified column is allowed
    if (!in_array($sortColumn, $allowedColumns)) {
        // Default to sorting by received date if the column is not allowed
        $sortColumn = "received_at";
    }

    // Query to fetch data from the database and order by specified column and order
    $sql = "SELECT * FROM uploaded_docs ORDER BY $sortColumn $sortOrder";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Output the sorted data
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo '<td><a href="' . $row['file_path'] . '" download>Download</a></td>';
            echo "<td>" . $row['source_person'] . "</td>";
            echo "<td>" . $row['received_at'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "No records found";
    }

    // Close the database connection
    $conn->close();
}

// Example usage to sort by name in descending order
getSortedFiles("title", "DESC");
?>

            </tbody>
        </table>
    </div>
</body>
</html>
