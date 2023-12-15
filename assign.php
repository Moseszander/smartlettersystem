<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["file_path"]) && isset($_POST["selected_department"])) {
    $con = mysqli_connect("localhost", "root", "", "project");
    
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        // Handle the error appropriately, such as logging or displaying an error message
    }
    
    $filePath = mysqli_real_escape_string($con, $_POST["file_path"]);
    $selectedDepartment = mysqli_real_escape_string($con, $_POST["selected_department"]);
    
    $insertQuery = "INSERT INTO assigned (file_path, department) VALUES ('$filePath', '$selectedDepartment')";
    
    if (mysqli_query($con, $insertQuery)) {
        echo "success";
    } else {
        echo "Error assigning document: " . mysqli_error($con);
    }
    
    mysqli_close($con);
} else {
    echo "Invalid request";
}
?>
