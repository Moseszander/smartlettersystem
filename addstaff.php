<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include_once './connection.php';

$level = new Levels();
$department = new Departments($GLOBALS['link']);
$staff = new Staff($GLOBALS['link']); // Pass the database connection as an argument

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: loginpage.php");
    exit();
}

class Staff {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addStaff($name, $email, $password, $level_id, $department_id) {
        $name = mysqli_real_escape_string($this->conn, $name);
        $email = mysqli_real_escape_string($this->conn, $email);
        $level_id = mysqli_real_escape_string($this->conn, $level_id);
        $department_id = mysqli_real_escape_string($this->conn, $department_id);

        // Use prepared statement to prevent SQL injection
        $stmt = $this->conn->prepare("INSERT INTO staffs (name, email, password, level_id, department_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $name, $email, password_hash($password, PASSWORD_DEFAULT), $level_id, $department_id);

        if ($stmt->execute()) {
            echo "Staff member added successfully!";
        } else {
            die("Error in SQL query: " . $stmt->error);
        }

        $stmt->close();
    }
}


class Levels {
    public function getLevels() {
        $sql = "SELECT * FROM levels";
        $result = mysqli_query($GLOBALS['link'], $sql);
        return $result;
    }
}

class Departments {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getDepartments() {
        $sql = "SELECT * FROM department";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $level_id = $_POST["level_id"];
    $department_id = $_POST["department_id"];

    // Add staff member
    $staff->addStaff($name, $email, $password, $level_id, $department_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Staff</title>
    <link rel="stylesheet" href="style/upload.css">
</head>
<body>

    <header>
        <h1>Add Staff</h1>
        <?php
            require_once 'includes/nav_director.php';
        ?>
        
    </header>

    <div class="container">
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
                <select name="level_id" id="level_id">
                    <option value="">select level</option>
                    <?php
                        $myinfo = $level->getLevels();
                        while ($myrow = mysqli_fetch_assoc($myinfo)) {
                             $selected = (isset($_POST['level_id']) && $myrow['level_id'] == $_POST['level_id']) ? 'selected' : '';
                                echo "<option value='" . htmlspecialchars($myrow['level_id']) . "' $selected>" . htmlspecialchars($myrow['name']) . "</option>";
                         }
                    ?>
                </select>

                <label for="department">Department:</label>
                <select name="department_id" id="department_id">
                    <option value="">select department</option>
                        <?php
                         $myinfo = $department->getDepartments();
                            while ($myrow = mysqli_fetch_assoc($myinfo)) {
                            $selected = (isset($_POST['department_id']) && $myrow['department_id'] == $_POST['department_id']) ? 'selected' : '';
                            echo "<option value='" . htmlspecialchars($myrow['department_id']) . "' $selected>" . htmlspecialchars($myrow['name']) . "</option>";
                           
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
