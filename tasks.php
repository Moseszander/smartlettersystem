<?php



// Assuming you have a table named 'tasks' with columns 'task_id', 'staff_id', 'task_description', etc.
// And a table named 'staff' with columns 'staff_id', 'staff_name', etc.

// Replace these with your actual table and column names
$tasksTable = "tasks";
$staffTable = "staff";

// Replace '123' with the actual staff ID you want to check
$staffIdToCheck = 123;

// Count the number of tasks assigned to a specific staff
$query = "SELECT COUNT(*) AS task_count FROM $tasksTable WHERE staff_id = $staffIdToCheck";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $taskCount = $row["task_count"];
    echo "Staff with ID $staffIdToCheck has $taskCount tasks assigned.";
} else {
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();

?>
