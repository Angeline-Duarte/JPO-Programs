<?php
session_start();
require_once('../util/security.php');

//confirm user is authorized for the page 
Security::checkAuthority('user');

//user clicked the logout button 
if (isset($_POST['logout'])) {
    Security::logout();
}
?>
<html>
<head>
    <title>JPO Programs</title>
    <link rel="stylesheet" type="text/css" href="styles.css"/> 
</head>
<body>
    <h1>User Options</h1>
    <ul>
    <li><h2><a href="userView_students.php"> 
        View Students</a></h2></li>
    <li><h2><a href="userView_programs.php"> 
        View Programs</a></h2></li>
    </ul> 
    <form method='POST'>
        <input type="submit" value="Logout" name="logout">
    </form>
</body>
</html>