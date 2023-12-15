<?php
 session_start();
 $_GET = ""
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
    <header>
        <h1>Letter Tracking System</h1>
        <nav>
             <a href="index.php">Back</a>
        </nav>
    </header>
    <div class="login-container">
        <h1>Login</h1>
        <form id="login-form" method="post" action="loginauthenitication.php">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="example@gmail.com" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="******" required><br>
            <button type="submit">Login</button>
        </form>
        <p id="login-message"></p>
    </div>
    <br>
    <?php require_once "footer.php"  ?>
</body>
</html>
