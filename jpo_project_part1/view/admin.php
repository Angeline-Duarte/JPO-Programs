<?php
session_start();
require_once('../util/security.php');

//confirm user is authorized for the page 
Security::checkAuthority('admin');

//user clicked the logout button 
if (isset($_POST['logout'])) {
    Security::logout();
}
?>
<html>
<head>
    <title>JPO Progrmas</title>
</head>
<body>
    <h2>Administrator Options</h2>
    <ul>
    <li><h2><a href="display_user.php"> 
        Manage Users</a></h2></li>
    <li><h2><a href="display_student.php"> 
        Manage Students</a></h2></li>
    <li><h2><a href="display_program.php"> 
        Manage Programs</a></h2></li>
    </ul> 
    <form method='POST'>
        <input type="submit" value="Logout" name="logout">
    </form>
</body>
</html>