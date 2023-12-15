
        <?php
        // Connect to the database (replace with your database credentials)
        include('connection.php');

        // Check connection
        if (!$link) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Query to fetch fruits from the database
        $sql = "SELECT staff, name FROM staff";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Output data of each row as dropdown options
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row["staff"] . '">' . $row["name"] . '</option>';
            }
        } else {
            echo "No names";
        }

        // Close the database connection
        mysqli_close($link);
        ?>
    
