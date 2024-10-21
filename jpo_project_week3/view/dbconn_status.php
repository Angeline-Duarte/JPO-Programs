
<?php
require_once('../model/database.php');
//set error reporting to errors only 
error_reporting(E_ERROR);

//create an instance of the Database class 
$db = new Database();
?>

<html>
<head>
    <title>Angeline Ortiz Final Practical</title>
</head>

<body>
    <h1>Angeline Ortiz Final Practical</h1>
    <h1>Database Connection Status</h1>
    <?php if (strlen($db->getDbError())): ?>  
        <ul>
            <li><?php echo "Database Name: "
                .$db->getDbName(); ?></li>
            <li><?php echo "Database User: "
                .$db->getDbUser(); ?></li>
            <li><?php echo "Database User Password: "
                .$db->getDbUserPw(); ?></li><il>
        </ul>
        <h2><?php echo "Connection Unsuccessfull. Failed to connect to DB." ?></h2>
    <?php else : ?>
        <ul>
            <li><?php echo "Database Name: "
                .$db->getDbName(); ?></li>
            <li><?php echo "Database User: "
                .$db->getDbUser(); ?></li>
            <li><?php echo "Database User Password: "
                .$db->getDbUserPw(); ?></li><il>
        </ul>
        <h2><?php echo "Connection Successful" ?></h2>
    <?php endif; ?>
    <h3><a href="../index.php">Home</a></h3>
</body>
</html>