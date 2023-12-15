<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('connection.php');

function add_staff($id, $name, $email, $password, $department_id){
    global $link;
    $sql = 'INSERT INTO `staffs`(`id`, `name`, `email`, `password`, `department_id`) VALUES (?, ?, ?, ?, ?)';
    if ($stmt = $link -> prepare($sql)){
        $new_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt -> bind_param('sssss', $id, $name, $email, $new_password, $department_id);
        $stmt -> execute();

        return "$name added successfully";
        
    } else {
        return  "Error: " . $sql . "<br>" . $link->error;
    }
}

$info = add_staff("565657", "jess", "jess@gmail.com", "123", "2");

echo $info;

 ?>