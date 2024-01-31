<?php
// session_start();
require_once "./Uploaddocs.php";
require_once "./Staff.php";
require_once "./Note.php";

$uploaddocs = new Uploaddocs();
$staff = new Staff();

$note = new Note();

// $notes = $note->getNoteReceivedByUser($_SESSION['id']);


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Content Display</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style/view.css">

</head>
<body>
    <header>
        <h1>Uploaded Files</h1>
        
        <!-- <?php
            require_once 'includes/nav_clerk.php';
        ?> -->
    </header>

       
    <div id="table-container">
        <table id="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Received from</th>
                    <th>Date Received</th>
                    <th>File</th>
                    <th>Comments</th>
                    <th>Status</th>
                </tr>

                
            </thead>
            <tbody>
                    <?php
                        $info = $uploaddocs->getUploadDocsDetailsByUser($_SESSION['id']);

                        while ($row = mysqli_fetch_assoc($info)){
                    ?>
                        <tr>

                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['title'] ?></td>
                            <td><?php echo $row['source_person'] ?></td>
                            <td><?php echo $row['received_at'] ?></td>
                            <td><a href="<?php echo $row['file_path'] ?>" download>Download here</td>
                            <td>
                                <?php
                                $notes = $note->getNoteByUploaded_docs_id($row['id']);
                                if ($notes == false){
                                    echo "No comment ".$row['id'];
                                } else {
                                    echo $notes['message'];
                                }
                                    // while ($row = mysqli_fetch_assoc($info)){
                                ?>
                            </td>
                            <td>
                                <a href="completebutton.php?id=<?php echo $row['id']; ?>">
                                    <button type="button" name="button" class="btn btn-danger">Completed</button>
                                </a>
                            </td>

                        </tr>

                        <?php                           
                        }
                        ?>
            </tbody>
        </table>

    </div>

</body>
</html>
