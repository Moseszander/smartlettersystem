<?php

session_start();

include_once "./connection.php";


if (!isset($_SESSION['email'])) {
    header("Location: loginpage.php");
    exit();
}



class Uploaddocs{
    public $conn;

    public function __construct(){
        $this->conn = $GLOBALS['link'];
    }

    public function getUploadDocsDetails(){
        $sql = "SELECT * FROM uploaded_docs"; // Replace with your actual table name
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0){
            return $result;
        } else {
            return false;
        }
    }

    public function getUploadDocsDetailsByUser($staff_id){
        $sql = "SELECT * FROM uploaded_docs where `staff_id` = '$staff_id'"; // Replace with your actual table name
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0){
            return $result;
        } else {
            echo "kitu";
            return false;
        }
    }

    // get uploads when staffid is null
    public function getUploadDocsDetailsByUserNull(){
        $sql = "SELECT * FROM uploaded_docs where `staff_id` is null"; // Replace with your actual table name
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0){
            return $result;
        } else {
            return false;
        }
    }

    // update stuff id
    public function updateStaffId($staff_id, $id){
        $sql = "UPDATE `uploaded_docs` SET `staff_id` = '$staff_id' WHERE `id` = '$id'"; // Replace with your actual table name
        $result = mysqli_query($this->conn, $sql);

        if ($result){
            return true;
        } else {
            return false;
        }
    }



    // files for a given user

}

?>