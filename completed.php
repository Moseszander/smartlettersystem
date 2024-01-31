<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Completed Records</title>
    <link rel="stylesheet" href="style/view.css">
    <!-- <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style> -->
</head>
<body>
<header>
        <h1>Completed files</h1>

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
                    <th>Assigned Staff</th>
                    <th>Received On</th>
                </tr>
            </thead>
            <tbody>

    <?php
    require_once 'connection.php';

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the "completed" table with specific columns
    $sql = "SELECT id, title, file_path, source_person, received_at, staff_id, department_id FROM completed";
    $result = $conn->query($sql);

    // Check if there are any records
    if ($result->num_rows > 0) {
        // Display table headers
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>File Path</th>
                    <th>Source Person</th>
                    <th>Received At</th>
                    <th>Staff ID</th>
                    <th>Department ID</th>
                </tr>";

        // Output data from each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['file_path']}</td>
                    <td>{$row['source_person']}</td>
                    <td>{$row['received_at']}</td>
                    <td>{$row['staff_id']}</td>
                    <td>{$row['department_id']}</td>
                  </tr>";
        }

        // Close the table
        echo "</table>";
    } else {
        echo "No records found";
    }

    // Close the database connection
    $conn->close();
    ?>
</div>
</body>
</html>
