<?php
require_once('../controller/program.php');
require_once('../controller/program_controller.php');

?>
<html>
<head>
    <title>JPO Programs</title>
    <link rel="stylesheet" type="text/css" href="styles.css"/> 
</head>

<body>
    <h1>JPO Programs</h1>
    <table>
        <tr>
            <th>Program Name</th>
            <th>Program Address</th>
            <th>Available Treatments</th>
            <th>Beds Available</th>
        </tr>
        <?php foreach (ProgramController::getAllPrograms() as $program) : ?>
        <tr>
            <td><?php echo $program->getName(); ?></td>
            <td><?php echo $program->getAddress(); ?></td>
            <td><?php echo $program->getTreatments(); ?></td>
            <td><?php echo $program->getBeds(); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h3><a href="../index.php">Sign Out</a></h3>
    <h3><a href="users_view.php">Home</a></h3>
</body>
</html>