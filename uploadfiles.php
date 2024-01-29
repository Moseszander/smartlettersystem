<?php
    session_start();
    include_once "./connection.php";
    require_once "../smartlettersystem/Staff.php";
    $staff = new Staff();

    // Check if user is logged in
    if (!isset($_SESSION['email'])) {
        header("Location: loginpage.php");
        exit();
    }

    function uploadImage($file){
        $image_name = $file['name'];
        $image_tmp_name = $file['tmp_name'];
        $image_size = $file['size'];
        $image_error = $file['error'];
        // $image_type = $file['type'];

        $image_ext = explode('.', $image_name);
        $image_actual_ext = strtolower(end($image_ext));

        $allowed = array('pdf', 'docx', 'doc');

        if(in_array($image_actual_ext, $allowed)){
            if($image_error === 0){
                if($image_size < 1000000){
                    $image_name_new = uniqid('', true).".".$image_actual_ext;
                    $image_destination = 'uploads/'.$image_name_new;
                    move_uploaded_file($image_tmp_name, $image_destination);
                    
                    return $image_destination;
                }else{
                    die("Your file is too big");
                    return "Your file is too big";
                }
            }else{
                die("There was an error uploading your file");
                return "There was an error uploading your file";
            }
        }else{
            die("You cannot upload files of this type");
            return "You cannot upload files of this type";
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload PDF Document</title>
    <link rel="stylesheet" href="style/upload.css">
    <header>
        <h1>Letter Tracking System</h1>
        <?php
            require_once 'includes/nav_clerk.php';
        ?>
        
    </header>
</head>
<body>


    <div class="container">
        <?php
            require_once 'includes/nav_clerk.php';
        ?>
        <form action="uploadfiles.php" method="post" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br>

            <label for="source">Source Person:</label>
            <input type="text" id="source" name="source" required><br>
            <div class="container1">
                <label for="department">Department:</label>
                <select name="department" id="">
                    <option value="">select department</option>
                        <?php
                         $myinfo = $staff->getDepartments();
                 while ($myrow = mysqli_fetch_assoc($myinfo)){
                         echo "<option value=".$myrow['department_id'].">".$myrow['name']."</option>";
                  }
                ?>
                </select>
            </div>

            <label for="datereceived">Date Received:</label>
            <input type="datetime-local" id="datereceived" name="datereceived" required><br>

            <label for="file">Upload PDF File:</label>
            <input type="file" id="file" name="file" accept=".pdf" required><br>

            <button type="submit" name="upload">Upload</button>



        </form>
    </div>
    <br>
    <?php require_once "footer.php"  ?>
</body>
</html>

<?php
    if (isset($_POST['upload'])) {
        $title = $_POST['title'];
        $source_person = $_POST['source'];
        $department = $_POST['department'];
        $received_at = $_POST['datereceived'];
        $file = $_FILES['file'];

        $file_destination = uploadImage($file);

        if ($file_destination != "Your file is too big" && $file_destination != "There was an error uploading your file" && $file_destination != "You cannot upload files of this type") {
            $sql = "INSERT INTO uploaded_docs (`title`, `source_person`, `department_id`, `received_at`, `file_path`) VALUES (?, ?, ?, ?, ?)";

            if ($stmt = $link -> prepare($sql)){
                $stmt -> bind_param('sssss', $title, $source_person, $department, $received_at, $file_destination);
                $stmt -> execute();
    
                echo "<script>alert('File uploaded successfully')</script>";
    
            } else {
                return  "Error: " . $sql . "<br>" . $link->error;
            }

        } else {
            echo "<script>alert('File not uploaded')</script>";
        }


    }



?>

