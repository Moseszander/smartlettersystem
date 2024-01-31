<?php
// Turn on error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
require_once './connection.php';

// Check if the 'auto_assign' button is clicked
if (isset($_POST['auto_assign'])) {
    // Check if 'doc_id' is set
    if (isset($_POST['doc_id'])) {
        $doc_id = $_POST['doc_id'];

        // Fetch department of the document from 'uploaded_docs' table
        $fetchDepartmentSql = "SELECT department_id FROM uploaded_docs WHERE id = ?";
        $stmtFetchDepartment = $link->prepare($fetchDepartmentSql);
        $stmtFetchDepartment->bind_param("i", $doc_id);

        if ($stmtFetchDepartment->execute()) {
            $stmtFetchDepartment->bind_result($department_id);
            $stmtFetchDepartment->fetch();
            $stmtFetchDepartment->close();

            if (!empty($department_id)) {
                // Find a staff member in the specified department with the least number of work items
                $findStaffSql = "SELECT staff_id
                                FROM uploaded_docs
                                WHERE department_id = ?
                                ORDER BY RAND() -- Randomly select a staff member
                                LIMIT 1";

                $stmtFindStaff = $link->prepare($findStaffSql);
                $stmtFindStaff->bind_param("i", $department_id);

                if ($stmtFindStaff->execute()) {
                    $stmtFindStaff->bind_result($assignedStaffId);
                    $stmtFindStaff->fetch();
                    $stmtFindStaff->close();

                    // Update the document with the assigned staff member
                    $updateDocumentSql = "UPDATE uploaded_docs SET staff_id = ? WHERE id = ?";
                    $stmtUpdateDocument = $link->prepare($updateDocumentSql);
                    $stmtUpdateDocument->bind_param("ii", $assignedStaffId, $doc_id);

                    if ($stmtUpdateDocument->execute()) {
                        echo "Document (ID: $doc_id) auto-assigned to Staff (ID: $assignedStaffId) in Department: $department_id";
                    } else {
                        echo "Error updating document: " . $stmtUpdateDocument->error;
                    }

                    $stmtUpdateDocument->close();
                } else {
                    echo "Error finding staff: " . $stmtFindStaff->error;
                }
            } else {
                echo "Error: Document department not found.";
            }
        } else {
            echo "Error fetching department: " . $stmtFetchDepartment->error;
        }
    } else {
        echo "Error: 'doc_id' not set.";
    }
}
?>
