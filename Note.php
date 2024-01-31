<?php

    require_once './connection.php';

    // create table if not exists notification(
    //     id INT AUTO_INCREMENT,
    //     sender_id int not null,
    //     receiver_id int not null,
    //     message varchar(255) not null,
    //     file_path varchar(255) not null,
    //     created_at timestamp not null default now(),
    
    //     PRIMARY KEY (id),
    //     FOREIGN KEY (sender_id) references staffs(id),
    //     FOREIGN KEY (receiver_id) references staffs(id)
    // );
    class Note{
        public $conn;

        public function __construct(){
            $this->conn = $GLOBALS['link'];
        }

        public function getNoteDetails(){
            $sql = "SELECT * FROM notification"; // Replace with your actual table name
            $result = mysqli_query($this->conn, $sql);

            if (mysqli_num_rows($result) > 0){
                return $result;
            } else {
                return false;
            }
        }

        public function getNoteDetailsSentByUser($sender_id){
            $sql = "SELECT * FROM notification where `sender_id` = '$sender_id'"; // Replace with your actual table name
            $result = mysqli_query($this->conn, $sql);

            if (mysqli_num_rows($result) > 0){
                return $result;
            } else {
                return false;
            }
        }

        public function createNotification($sender_id, $receiver_id, $message, $file_path, $uploaded_docs_id){
            $sql = "INSERT INTO `notifications` (`sender_id`, `receiver_id`, `file_path`, `message`, `uploaded_docs_id`) VALUES ('$sender_id', '$receiver_id', '$message', '$file_path', '$uploaded_docs_id')"; // Replace with your actual table name
            $result = mysqli_query($this->conn, $sql);

            if ($result){
                return true;
            } else {
                return false;
            }
        }

        public function getNoteDetailsByUserNull(){
            $sql = "SELECT * FROM notification where `receiver_id` is null"; // Replace with your actual table name
            $result = mysqli_query($this->conn, $sql);

            if (mysqli_num_rows($result) > 0){
                return $result;
            } else {
                return false;
            }
        }

        public function getNoteReceivedByUser($receiver_id){
            $sql = "SELECT * FROM notification WHERE receiver_id='$receiver_id'";
            $result = mysqli_query($this->conn, $sql);
            if (mysqli_num_rows($result) > 0){
                return $result;
            } else {
                return false;
            }
        }

        public function getNoteByUploaded_docs_id($uploaded_docs_id){
            $sql = "SELECT * FROM `notifications` WHERE `uploaded_docs_id`='$uploaded_docs_id'";
            $result = mysqli_query($this->conn, $sql);
            // get one
            if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                    return $data[]=$row;
                }
            }else {
                return false;
            }
        }
    }

    // $note = new Note();



    // $info = $note->getNoteByUploaded_docs_id(11);

    // print_r($info);
?>