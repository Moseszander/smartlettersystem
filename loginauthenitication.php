<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include('connection.php');

function get_user_id_by_email($email){

    global $link;

    $sql = "SELECT `id` FROM `staffs` WHERE `email` = ?";

    if($stmt = $link -> prepare($sql)){
        $stmt -> bind_param('s', $email);
        $stmt -> execute();
        $stmt -> store_result();

        if($stmt -> num_rows > 0){
            $stmt -> bind_result($id);
            $stmt -> fetch();

            return $id;
        }else{
            return false;
        }
    }
}



if($stmt = $link -> prepare('SELECT `name`, `password`,`level_id` FROM `staffs` WHERE `email` = ?')){
    $stmt -> bind_param('s', $_POST['email']);
    $stmt -> execute();
    $stmt -> store_result();

    if($stmt -> num_rows > 0){
      $stmt -> bind_result($name, $password,$level_id);
      $stmt -> fetch();

      // echo $firstname.$id_number.$password;

      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      if(password_verify($_POST['password'], $password)){
        session_regenerate_id();

        $_SESSION['loggedin'] = TRUE;
        $_SESSION['level_id'] = $level_id;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['id'] = get_user_id_by_email($_POST['email']);

        echo " logged in".$name;
        echo "<br><br>";
        echo $_POST['password']."<br><br>".$password;

    
        if ($level_id == "2") {
            header('Location: director_dashboard.php');
        } elseif ($level_id == "1") {
             header('Location: clerical_dashboard.php');
            // echo "IT";
        } elseif ($level_id == "3") {
            header('Location: staff_dashboard.php');
        } else {
        echo "<h1>Login failed. Invalid username or password.</h1>";
    }

      }
    }
}

?>
