<?php
require_once "../smartlettersystem/Staff.php";





class Student{
    public $conn;
    

    public function __construct(){
        $this->conn = $GLOBALS['link'];
    }
    public function getStaffFromDepartment($departments, $staffs, $department_id){
        foreach ($departments as $department) {
            if ($department["department_id"] == $department_id) {
                echo "Department: " . $department["name"] . "\n";
                echo "=============================\n";
                foreach ($staffs as $staff_member) {
                    if ($staff_member["department_id"] == $department["department_id"]) {
                        echo $staff_member["name"] . " \n";
                         }
                    }
                    echo "\n";
            }
        }
    }
    public function getStaff(){
        $staff = new Staff();
        $workers = $staff->getStaffs();
        $works = array();
               while($row = $workers->fetch_assoc()){
                     $works[] = $row;
                 }
                 return $works;
    }
    public function getDepartments(){
        $staff = new Staff();
        $deps = $staff->getDepartments();
        $depts = array();
               while($row = $deps->fetch_assoc()){
                     $depts[] = $row;
                 }
                 return $depts;

    }
}
$student = new Student();
$staff = $student->getStaff();
$department = $student->getDepartments();
print_r ($student->getStaffFromDepartment($department, $staff, 2));


