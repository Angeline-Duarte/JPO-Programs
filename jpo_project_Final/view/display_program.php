<?php
require_once('../controller/program.php');
require_once('../controller/program_controller.php');

if (isset($_POST['update'])) {
    //update button pressed for a user
    if (isset($_POST['pNoUpd'])) {
        header('Location: ./add_update_program.php?uNo=' . $_POST['pNoUpd']);
    }
    unset($_POST['update']);
    unset($_POST['pNoUpd']);
}

if (isset($_POST['delete'])) {
    //delte button pressed for a user
    if (isset($_POST['pNoDel'])) {
        ProgramController::deleteProgram($_POST['pNoDel']);
    }
    unset($_POST['delete']); 
    unset($_POST['pNoDel']);
}
?>
<html>
<head>
    <title>JPO Programs</title>
    <link rel="stylesheet" type="text/css" href="styles.css"/> 
</head>

<body>
    <h1>Programs</h1>
    <h2><a href="add_update_program.php">Add program</a></h2> 
    <table>
        <tr>
            <th>Program Name</th>
            <th>Program Address</th>
            <th>Available Treatment</th>
            <th>Beds Available</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach (ProgramController::getAllPrograms() as $program) : ?>
        <tr>
            <td><?php echo $program->getName(); ?></td>
            <td><?php echo $program->getAddress(); ?></td>
            <td><?php echo $program->getTreatments(); ?></td>
            <td><?php echo $program->getBeds(); ?></td>
            <td><form method="POST">
                <input type="hidden" name="pNoUpd"
                    value="<?php echo $program->getProgramNo(); ?>"/> 
                <input type="submit" value="Update" name="update" /> 
            </form></td>
            <td><form method="POST">
                <input type="hidden" name="pNoDel"
                    value="<?php echo $program->getProgramNo(); ?>"/>
                <input type="submit" value="Delete" name="delete" />
            </form></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h3><a href="../index.php">Sign Out</a></h3>
    <h3><a href="admin.php">Home</a></h3>
</body>
</html>