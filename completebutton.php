<?php
include_once "./connection.php";

if (isset($_GET['id'])) {
    // Get the ID of the row you want to copy
    $selectedId = $_GET['id'];

    // SQL to copy data from 'uploaded_docs' to 'completed' for a specific row
    $copySql = "INSERT INTO completed (title, file_path, source_person, received_at, staff_id, department_id)
                SELECT title, file_path, source_person, received_at, staff_id, department_id
                FROM uploaded_docs
                WHERE id = ?";

    // Use a prepared statement to prevent SQL injection
    $copyStmt = $link->prepare($copySql);
    $copyStmt->bind_param("i", $selectedId);

    if ($copyStmt->execute() === TRUE) {
        // After successfully copying, delete the row from 'uploaded_docs'
        $deleteSql = "DELETE FROM uploaded_docs WHERE id = ?";
        $deleteStmt = $link->prepare($deleteSql);
        $deleteStmt->bind_param("i", $selectedId);

        if ($deleteStmt->execute() === TRUE) {
            echo "Data copied successfully from 'uploaded_docs' to 'completed' and row deleted for ID: " . $selectedId;
            header('Location: view_staff.php');
        } else {
            echo "Error deleting row from 'uploaded_docs': " . $link->error;
        }

        // Close the prepared statement for delete
        $deleteStmt->close();
    } else {
        echo "Error: " . $link->error;
    }

    // Close the prepared statement for copy
    $copyStmt->close();
} else {
    echo "Error: 'id' parameter is not set in the URL.";
}

// Close the database connection
$link->close();
?>
