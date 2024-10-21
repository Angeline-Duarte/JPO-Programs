<?php
require_once('../controller/students.php');
require_once('../controller/student_controller.php');

?>
<html>
<head>
    <title>JPO Programs</title>
    <link rel="stylesheet" type="text/css" href="styles.css"/> 
</head>

<body>
    <h1>JPO Programs</h1>
    <h1>Students</h1>
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
        </tr>
        <?php endforeach; ?>
    </table>
    <h3><a href="../index.php">Sign Out</a></h3>
    <h3><a href="users_view.php">Home</a></h3>
</body>
</html>