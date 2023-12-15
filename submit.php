<?php
  session_start();

  require_once "Uploaddocs.php";
  require_once "Note.php";

  $doc_id = $_GET['doc_id'];
  $file_path = $_GET['file_path'];
  $upload_id = $_GET['upload_id'];

  $upload = new Uploaddocs();
  $result = $upload->updateStaffId($_POST['assign'], $doc_id);
  if (!empty($_POST['message'])){
    $note = new Note();
    $result = $note->createNotification($_SESSION['id'], $_POST['assign'], $file_path, $_POST['message'], $upload_id);

  }

  if ($result){
    header('Location: view.php');
  } else {
    echo "Error";
  }

?>