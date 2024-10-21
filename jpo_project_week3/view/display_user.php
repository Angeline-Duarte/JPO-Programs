<?php
require_once('../controller/user.php');
require_once('../controller/user_controller.php');

if (isset($_POST['update'])) {
    //update button pressed for a user
    if (isset($_POST['uNoUpd'])) {
        header('Location: ./add_update_user.php?uNo=' . $_POST['uNoUpd']);
    }
    unset($_POST['update']);
    unset($_POST['uNoUpd']);
}

if (isset($_POST['delete'])) {
    //delte button pressed for a user
    if (isset($_POST['uNoDel'])) {
        UserController::deleteUser($_POST['uNoDel']);
    }
    unset($_POST['delete']); 
    unset($_POST['uNoDel']);
}
?>
<html>
<head>
    <title>Users</title>
    <link rel="stylesheet" type="text/css" href="styles.css"/> 
</head>

<body>
    <h1>Users</h1>
    <h2><a href="add_update_user.php">Add Users</a></h2> 
    <table>
        <tr>
            <th>User ID</th>
            <th>Password</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Hire Date</th>
            <th>E-Mail Address</th>
            <th>Extension</th>
            <th>Level</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach (UserController::getAllUsers() as $user) : ?>
        <tr>
            <td><?php echo $user->getUserId(); ?></td>
            <td><?php echo $user->getPassword(); ?></td>
            <td><?php echo $user->getFirstName(); ?></td> 
            <td><?php echo $user->getLastName(); ?></td>
            <td><?php echo $user->getHireDate(); ?></td>
            <td><?php echo $user->getEMail(); ?></td>
            <td><?php echo $user->getExtension(); ?></td>
            <td><?php echo $user->getUserLevelNo(); ?></td>
            <td><form method="POST">
                <input type="hidden" name="uNoUpd"
                    value="<?php echo $user->getUserNo(); ?>"/> 
                <input type="submit" value="Update" name="update" /> 
            </form></td>
            <td><form method="POST">
                <input type="hidden" name="uNoDel"
                    value="<?php echo $user->getUserNo(); ?>"/>
                <input type="submit" value="Delete" name="delete" />
            </form></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h3><a href="../index.php">Sign Out</a></h3>
    <h3><a href="admin.php">Home</a></h3>
</body>
</html>