<?php
include_once "../connection.php";

$tasksTable = "uploaded_docs";
$staffTable = "staffs";

$staffIdToCheck = 7;



function findTasks($link, $staffIdToCheck){


    $query = "SELECT COUNT(*) AS task_count FROM uploaded_docs WHERE staff_id = $staffIdToCheck";
    $result = $link->query($query);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $taskCount = $row["task_count"];
        echo "Staff with ID $staffIdToCheck has $taskCount tasks assigned.";
    } else {
        echo "Error: " . $conn->error;
    }
}
function findAllStaffs($link){
    $sql = "SELECT * FROM staffs"; // Replace with your actual table name
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()){
            // foreach($row as $staff){
                print_r($row[0]) ;
            
        
            
        }
    } else {
        return false;
    }
}
findTasks($link, $staffIdToCheck);
findAllStaffs($link);
// Close the database connection
$link->close();


?>