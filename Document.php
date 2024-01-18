<?php 
include_once "../connection.php";

class Document{
    public $conn;

    public function __construct(){
        $this->conn = $GLOBALS['link'];
    }
    public function getDoc(){
        $sql = "SELECT * FROM uploaded_docs";
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0){
            return $result;
        } else {
            return false;
        }
    }
    public function getDocument(){
        
        $deps = $this->getDoc();
        $depts = array();
               while($row = $deps->fetch_assoc()){
                     $depts[] = $row;
                 }
                 return $depts;

    }



}
$document = new Document();
$docs = $document->getDocument();

print_r($docs['1']);
?>