<?php

include_once "./connection.php";


class Staff{
    public $conn;

    public function __construct(){
        $this->conn = $GLOBALS['link'];
    }

    public function getStaffs(){
        $sql = "SELECT * FROM staffs"; // Replace with your actual table name
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0){
            return $result;
        } else {
            return false;
        }
    }

    public function getStaffsWhoAreStaff(){
        $sql = "SELECT * FROM staffs where `department_id` = '3'"; // Replace with your actual table name
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0){
            return $result;
        } else {
            return false;
        }
    }
    public function getDepartments(){
        $sql = "SELECT * FROM department";
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0){
            return $result;
        } else {
            return false;
        }
    }
}

?>