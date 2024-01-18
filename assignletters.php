<?php
include_once "../connection.php";

$tasksTable = "uploaded_docs";
$staffTable = "staffs";

// Get all staff members
$queryStaff = "SELECT id, department_id FROM $staffTable";
$resultStaff = $link->query($queryStaff);

if ($resultStaff === false) {
    // Print detailed error information
    die("Error: " . $link->error);
}

while ($rowStaff = $resultStaff->fetch_assoc()) {
    $staffId = $rowStaff['id'];
    $staffDepartment = $rowStaff['department_id'];

    // Count the number of tasks assigned to each staff in the same department
    $query = "SELECT COUNT(*) AS task_count FROM $tasksTable WHERE id = $staffId AND department_id = '$staffDepartment'";
    $result = $link->query($query);

    if ($result === false) {
        // Print detailed error information
        die("Error: " . $link->error);
    }else{
        print_r($result);
    }


    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $taskCount = $row["task_count"];
        echo "Staff with ID $staffId in department $staffDepartment has $taskCount tasks assigned.<br>";
    } else {
        echo "Error: No results returned for staff with ID $staffId in department $staffDepartment.<br>";
    }
}

// Calculate the number of unassigned tasks
$totalStaff = 3; // Change this to the actual number of staff members
$unassignedTasks = getTotalUnassignedTasks($link, $tasksTable);

// Calculate the number of tasks to assign to each staff member
$tasksPerStaff = floor($unassignedTasks / $totalStaff);

// Assign tasks evenly to all staff members in the same department
assignTasksToStaff($link, $tasksPerStaff, $totalStaff, $tasksTable);

// Close the database connection
$link->close();

// Function to get the total number of unassigned tasks
function getTotalUnassignedTasks($link, $tasksTable) {
    $query = "SELECT COUNT(*) AS unassigned_count FROM $tasksTable WHERE id IS NULL";
    $result = $link->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["unassigned_count"];
    } else {
        return 0;
    }
}

// Function to assign tasks evenly to all staff members in the same department
function assignTasksToStaff($link, $tasksPerStaff, $totalStaff, $tasksTable) {
    $query = "SELECT id, department_id FROM $tasksTable WHERE id IS NULL";
    $result = $link->query($query);

    if ($result && $result->num_rows > 0) {
        $tasks = $result->fetch_all(MYSQLI_ASSOC);

        // Group tasks by department
        $tasksByDepartment = [];
        foreach ($tasks as $task) {
            $tasksByDepartment[$task['department']][] = $task;
        }

        // Distribute tasks evenly among staff members in the same department
        foreach ($tasksByDepartment as $departmentTasks) {
            for ($i = 0; $i < $totalStaff; $i++) {
                $tasksToAssign = array_slice($departmentTasks, $i * $tasksPerStaff, $tasksPerStaff);
                $staffId = $i + 5; // Assuming staff IDs start from 5
                assignTasksToStaffMember($link, $staffId, $tasksToAssign, $tasksTable);
            }
        }

        echo "Tasks have been evenly assigned to all staff members based on their departments.";
    } else {
        echo "No unassigned tasks to distribute.";
    }
}

// Function to update tasks with assigned staff ID
function assignTasksToStaffMember($link, $staffId, $tasksToAssign, $tasksTable) {
    $taskIds = implode(',', array_column($tasksToAssign, 'id'));
    $query = "UPDATE $tasksTable SET id = $staffId WHERE id IN ($taskIds)";
    $link->query($query);
}
?>
