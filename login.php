<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include('connection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['email']) && isset($_POST['pass'])) {
        $email = $_POST['email'];
        $password = $_POST['pass'];

        // Hash the password for comparison
        $hashedPassword = hash('sha256', $password);

        // Prepare and execute the query using prepared statement
        $sql = "SELECT * FROM login WHERE email = ? AND password = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $email, $hashedPassword);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check the result
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            $row = mysqli_fetch_assoc($result);
            $post = $row['role'];

            // Redirect based on role
            ob_end_clean(); // Clear output buffer
            if ($role === "director") {
                header("Location: director_dashboard.php");
            } elseif ($role === "Clerk") {
                header("Location: clerical_dashboard.php");
            } elseif ($role === "staff") {
                header("Location: staff_dashboard.php");
            }
            exit(); // Important: Ensure script stops executing after the redirect
        } else {
            echo "<h1>Login failed. Invalid username or password.</h1>";
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } 
}

// Close the database connection
//mysqli_close($con);
?>
