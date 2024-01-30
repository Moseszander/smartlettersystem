<?php
    session_start();
    include_once "./connection.php";

    // Check if user is logged in
    if (!isset($_SESSION['email'])) {
        header("Location: loginpage.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Letter Tracking System</title>
    <link rel="stylesheet" href="style/index.css">
    
</head>
<body>
    <header>
        <h1>Letter Tracking System</h1>
        
       
    </header>
    <div class="container">
        <div class="intro">
            <p>
               <b> Streamline your letter management process with our digital tracking and retrieval system.</b>
            </p>
            <h2><?php   echo "Welcome, " . $_SESSION['name'] . "!";  ?></h2>
        </div>    
        <div class="features">
                <div class="feature">
                    <h2>Digital Storage</h2>
                    <p style="color: #636363;">
                        Efficiently store and organize letters digitally, reducing paper consumption and clutter.
                    </p>
                </div>
                <div class="feature">
                    <h2>Automated Assignment</h2>
                    <p style="color: #636363;">
                        Assign letters to the appropriate departments or individuals based on content analysis.
                    </p>
                </div>
                <div class="feature">
                    <h2>Real-time Notifications</h2>
                    <p style="color: #636363;">
                        Receive automatic notifications for letter assignments, actions, and rejections.
                    </p>
                </div>
                
            </div>      <div class="login-button">
            
                <button>
                    <a href="view_staff.php">Your Files</a>
                </button>
                <button><a href="logout.php">Logout</a></button>
                
            
            </div>
        </div>
            
        </div>
        </div>
    </div>
    <?php require_once "footer.php"  ?>
</body>
</html>
