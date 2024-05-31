<?php
session_start();
if (!isset($_SESSION['email'])) {
    // If session is not set, redirect back to login page
    header(": processlog.php");
    exit();
}
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html>
<headdddd>
    <title>Welcome</title>
</head>
<body>
    <h2>Welcome</h2>
   <?php echo "Welcome, ".$_SESSION['fullname']."!";?><br>
    <a href="processlog.php">Logout</a>
</body>
</html>
