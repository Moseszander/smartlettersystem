<?php
// Include the database connection code (replace with your actual connection code)
require_once './connection.php';

// Fetch existing passwords and update them
$selectSql = "SELECT id, password FROM staffs";
$result = $link->query($selectSql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $oldPassword = $row['password'];

        // Check if the password needs rehashing
        if (password_needs_rehash($oldPassword, PASSWORD_BCRYPT)) {
            // Rehash the password
            $newHashedPassword = password_hash($oldPassword, PASSWORD_BCRYPT);

            // Update the database with the new hashed password
            $updateSql = "UPDATE staffs SET password = ? WHERE id = ?";
            $stmt = $link->prepare($updateSql);
            $stmt->bind_param("si", $newHashedPassword, $id);

            if ($stmt->execute()) {
                echo "Password for user with ID $id has been rehashed successfully.<br>";
            } else {
                echo "Error updating password for user with ID $id: " . $stmt->error . "<br>";
            }

            $stmt->close();
        } else {
            echo "Password for user with ID $id is already hashed and doesn't need rehashing.<br>";
        }
    }

    $result->free();
} else {
    echo "Error fetching passwords: " . $link->error;
}

// Close the database connection
$link->close();
?>
