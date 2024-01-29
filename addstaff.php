<?php
session_start();
include_once './connection.php'; // Assuming you have a file for database connection

$level = new Levels(); // Add a semicolon here
$department = new Departments($GLOBALS['link']); // Pass the database connection as an argument
    // Check if user is logged in
    if (!isset($_SESSION['email'])) {
        header("Location: loginpage.php");
        exit();
    }


class Levels {
    private $conn;

    public function __construct() {
        $this->conn = $GLOBALS['link']; // Use the global database connection variable
    }

    public function addStaff($name, $email, $password, $level, $department) {
        $name = mysqli_real_escape_string($this->conn, $name);
        $email = mysqli_real_escape_string($this->conn, $email);
        $password = mysqli_real_escape_string($this->conn, $password);
        $level = mysqli_real_escape_string($this->conn, $level);
        $department = mysqli_real_escape_string($this->conn, $department);

        $sql = "INSERT INTO staffs (name, email, password, level, department) VALUES ('$name', '$email', '$password', '$level', '$department')";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            echo "Staff member added successfully!";
        } else {
            echo "Error: " . mysqli_error($this->conn);
        }
    }

    // Define a method to get levels from the database
    public function getLevels() {
        $sql = "SELECT * FROM levels"; // Adjust the query based on your database structure
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }
}
class Departments{
    private $conn;

    public function __construct($conn) {
        $this->conn = $GLOBALS['link']; // Use the provided database connection
    }

    public function getDepartments() {
        $sql = "SELECT * FROM department"; // Adjust the query based on your database structure
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Instantiate Staff class
    $staff = new Staff();

    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $level = $_POST["level"];
    $department = $_POST["department"];

    // Add staff member
    $staff->addStaff($name, $email, $password, $level, $department);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Staff</title>
    <link rel="stylesheet" href="style/upload.css">

    <header>
        <h1>Letter Tracking System</h1>
        <?php
            require_once 'includes/nav_director.php';
        ?>
        
    </header>
</head>
<body>
    <div class="cointainer">
        <h2>Add Staff</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br>
        <div class="container1">
            <label for="level">Level:</label>
            <select name="level" id="">
                <option value="">select level</option>
                    <?php
                         $myinfo = $level->getLevels(); // Use the getLevels method
                            while ($myrow = mysqli_fetch_assoc($myinfo)){
                             echo "<option value=".$myrow['level_id'].">".$myrow['name']."</option>";
                            }
                    ?>
            </select>

                 <label for="department">Department:</label>
                <select name="department" id="">
                    <option value="">select department</option>
                        <?php
                            $myinfo = $department->getDepartments();
                            while ($myrow = mysqli_fetch_assoc($myinfo)){
                            echo "<option value=".$myrow['department_id'].">".$myrow['name']."</option>";
                            }
                        ?>
                </select><br><br>
        </div>

                <button type="submit" name="upload">Add Staff</button>
        </form>
    </div>
    <?php require_once "footer.php"  ?>
</body>
</html>
