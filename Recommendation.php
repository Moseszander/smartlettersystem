<?php


class Recommendation{
    public $documents;
    public $levels;
    public $department_members;

    public static function getAllDocuments($documents){
        for ($i = 0; $i < count($documents); $i++){
            echo $documents[$i]."<br>";
        }
    }

    public static function getAllStaff($staff){
        for ($i = 0; $i < count($staff); $i++){
            echo $staff[$i]."<br>";
        }
    }
}

// $recommendation = new Recommendation();

$documents = array("doc1", "doc2", "doc3", "docs4", "doc5");
$staff = array("elisha", "moses", "wizzy", "theo");

echo "<b>Docs</b><br>";
$r = Recommendation::getAllDocuments($documents);

echo "<b>Staffs</b><br>";
$s = Recommendation::getAllStaff($staff);


?>