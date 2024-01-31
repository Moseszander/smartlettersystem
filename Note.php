<?php

require_once './connection.php';

class Note
{
    public $conn;

    public function __construct()
    {
        $this->conn = $GLOBALS['link'];
    }

    public function getNoteDetails()
    {
        $sql = "SELECT * FROM notifications"; // Replace with your actual table name
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function getNoteDetailsSentByUser($sender_id)
    {
        $sql = "SELECT * FROM notifications WHERE `sender_id` = '$sender_id'"; // Replace with your actual table name
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function createNotification($sender_id, $receiver_id, $message, $file_path, $uploaded_docs_id)
    {
        $sql = "INSERT INTO `notifications` (`sender_id`, `receiver_id`, `file_path`, `message`, `uploaded_docs_id`) VALUES ('$sender_id', '$receiver_id', '$message', '$file_path', '$uploaded_docs_id')"; // Replace with your actual table name
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getNoteDetailsByUserNull()
    {
        $sql = "SELECT * FROM notifications WHERE `receiver_id` IS NULL"; // Replace with your actual table name
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function getNoteReceivedByUser($receiver_id)
    {
        $sql = "SELECT * FROM notifications WHERE receiver_id='$receiver_id'";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function getNoteByUploaded_docs_id($uploaded_docs_id)
    {
        $sql = "SELECT * FROM `notifications` WHERE `uploaded_docs_id`='$uploaded_docs_id'";
        $result = mysqli_query($this->conn, $sql);
        // get one
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                return $data[] = $row;
            }
        } else {
            return false;
        }
    }
}

// $note = new Note();

// $info = $note->getNoteByUploaded_docs_id(11);

// print_r($info);

?>
