<?php
require_once "./Uploaddocs.php";
require_once "./Staff.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$uploaddocs = new Uploaddocs();
$staff = new Staff();
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
        <?php
            require_once 'includes/nav_director.php';
        ?>
    </header>

    <div class="files">
        <?php
         $info = $uploaddocs->getUploadDocsDetailsByUserNull();

         if (!empty($info)){
            while ($row = mysqli_fetch_assoc($info)){
                ?>
                <div class="card">
                    <h2>Title: <?php echo $row['title'] ?></h2>
                    <hr>
                    <p><b>Source person:</b> <?php echo $row['source_person'] ?></p>
                    <p><b>Date Received: </b><?php echo $row['received_at'] ?></p>
                    <p><b>File: </b> <a href="/project/<?php echo $row['file_path']?>" download>Download here</a></p>

                    <div class="modal">
                        <div>
                            <form action="submit.php?doc_id=<?php echo $row['id'] ?>&file_path=<?php echo $row['file_path']?>&upload_id=<?php echo $row['id']?>" method="post">
                                <h4>Assign File </h4>
                                <label for="">Add Note</label>
                                <textarea name="message" id="" cols="30" rows="10" placeholder="Add Something"></textarea>
                                
                                <!-- Remove the Select Department dropdown -->
<!-- <label>Select Department</label>
<select name="assign" id="department">
    <?php
        // $departments = $staff->getDepartments();
        // foreach ($departments as $dept) {
        //     echo "<option value=".$dept['id'].">".$dept['name']."</option>";
        // }
    ?>
</select> -->

<!-- Display the department from the uploaded_docs table -->
<label>Department: <?php echo $row['department_id']; ?></label>
<input type="hidden" name="assign" value="<?php echo $row['department_id']; ?>">


                                <label>Select Staff</label>
                                <select name="assign" id="result">
                                <?php
                                    $staffs = $staff->getStaffsWhoAreStaff($row['department_id']);
                                    foreach ($staffs as $staff) {
                                        echo "<option value=".$staff['id'].">".$staff['name']."</option>";
                                    }
                                ?>
                                </select>
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
         } else {
            echo "No data yet";
         }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="departmentstaff.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', ()=>{
            const modals = document.querySelectorAll('.modal');
            const btns = document.querySelectorAll('.my-modal');

            btns.forEach((btn, index) => {
                btn.addEventListener('click', ()=>{
                    modals[index].style.display = 'block';
                    console.log("modal clicked");
                });
            });

            window.addEventListener('click', (e)=>{
                modals.forEach(modal => {
                    if (e.target == modal){
                        modal.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>
