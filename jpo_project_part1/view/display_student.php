<?php
require_once('../controller/students.php');
require_once('../controller/student_controller.php');

if (isset($_POST['update'])) {
    //update button pressed for a user
    if (isset($_POST['sNoUpd'])) {
        header('Location: ./add_update_student.php?uNo=' . $_POST['sNoUpd']);
    }
    unset($_POST['update']);
    unset($_POST['sNoUpd']);
}

if (isset($_POST['delete'])) {
    //delte button pressed for a user
    if (isset($_POST['sNoDel'])) {
        StudentController::deleteStudent($_POST['sNoDel']);
    }
    unset($_POST['delete']); 
    unset($_POST['sNoDel']);
}
?>
<html>
<head>
    <title>JPO Programs</title>
    <link rel="stylesheet" type="text/css" href="styles.css"/> 
</head>

<body>
    <h1>JPO Programs</h1>
    <h1>Users</h1>
    <h2><a href="add_update_student.php">Add Student</a></h2> 
    <table>
        <tr>
            <th>Student ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Program Number</th>
            <th>Program Name</th>
            <th>Charges</th>
            <th>Grade</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach (StudentController::getAllStudents() as $student) : ?>
        <tr>
            <td><?php echo $student->getStudentId(); ?></td>
            <td><?php echo $student->getStudentFirstName(); ?></td>
            <td><?php echo $student->getStudentLastName(); ?></td>
            <td><?php echo $student->getDOB(); ?></td>
            <td><?php echo $student->getProgramNo(); ?></td>
            <td><?php echo $student->getProgramName(); ?></td>
            <td><?php echo $student->getCharges(); ?></td>
            <td><?php echo $student->getGrade(); ?></td>
            <td><form method="POST">
                <input type="hidden" name="sNoUpd"
                    value="<?php echo $student->getStudentNo(); ?>"/> 
                <input type="submit" value="Update" name="update" /> 
            </form></td>
            <td><form method="POST">
                <input type="hidden" name="sNoDel"
                    value="<?php echo $student->getStudentNo(); ?>"/>
                <input type="submit" value="Delete" name="delete" />
            </form></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h3><a href="../index.php">Sign Out</a></h3>
    <h3><a href="admin.php">Home</a></h3>
</body>
</html>