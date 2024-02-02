<?php
include_once "../connection.php";

session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

class Document {
    public $conn;

    public function __construct(){
        $this->conn = $GLOBALS['link'];
    }

    public function getUnassignedDocs(){
        $sql = "SELECT * FROM uploaded_docs WHERE staff_id IS NULL";
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0){
            return $result;
        } else {
            return false;
        }
    }

    public function assignDocumentToStaff($departmentId) {
        // Find the staff with the least number of assigned documents in the given department
        $sql = "SELECT id
                FROM staffs
                WHERE department_id = ?
                ORDER BY RAND() -- Randomly select a staff member
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $departmentId);
        $stmt->execute();
        $stmt->bind_result($assignedStaffId);
        $stmt->fetch();
        $stmt->close();

        return $assignedStaffId;
    }

    public function assignAllUnassignedDocuments() {
        // Get all unassigned documents
        $unassignedDocs = $this->getUnassignedDocs();

        if ($unassignedDocs !== false) {
            while ($row = mysqli_fetch_assoc($unassignedDocs)) {
                $documentId = $row['id'];
                $departmentId = $row['department_id'];

                // Assign document to staff in the relevant department
                $assignedStaffId = $this->assignDocumentToStaff($departmentId);

                if ($assignedStaffId !== null) {
                    // Update the document with the assigned staff member
                    $updateDocumentSql = "UPDATE uploaded_docs SET staff_id = ? WHERE id = ?";
                    $stmtUpdateDocument = $this->conn->prepare($updateDocumentSql);
                    $stmtUpdateDocument->bind_param("ii", $assignedStaffId, $documentId);

                    if ($stmtUpdateDocument->execute()) {
                        echo "Documents successfully assigned!<br>";
                    } else {
                        echo "Error updating document: " . $stmtUpdateDocument->error . "<br>";
                    }

                    $stmtUpdateDocument->close();
                } else {
                    echo "No staff found in the department for Document (ID: $documentId)<br>";
                }
            }

            // Redirect to view.php
            header("Location: view.php");
            exit();
        } else {
            echo "No unassigned documents found.";
        }
    }
}

$document = new Document();

// Example: Assign all unassigned documents
$document->assignAllUnassignedDocuments();
?>
